<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Coffee;
use Illuminate\Http\Request;
use App\Http\Resources\CoffeeResource;
use App\Http\Resources\ReviewResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CoffeeCollection;
use App\Http\Requests\StoreCoffeeRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateCoffeeRequest;

class CoffeeController extends Controller
{

    public function show(Coffee $coffee)
    {
        $coffee = Coffee::with('prices')->get();
        return new CoffeeCollection($coffee);
    }

    public function detail(Coffee $coffee, $id)
    {
        $coffee = Coffee::with('ratings')->findOrFail($id);
        return new ReviewResource($coffee);
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required',
            'S' => 'required',
            'M' => 'required',
            'L' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('image', 'public');
        } else {
            $path = null;
        }

        $insert = Coffee::create([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'image' => $path,
            'price' => $request->price,
        ]);

        $latest = Coffee::orderBy('id', 'desc')->pluck('id')->first();
        $size = ['S','M','L'];

        foreach ($size as $v) { 
            $price = Price::create([
                'coffee_id' => $latest,
                'size' => $v,
                'price' => $request->$v,
            ]);
            $show[] = $price;
        }

        return response()->json([$insert, $show], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $coffee = Coffee::findOrFail($id);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($coffee->image);
            //$imageName = time().'.'.$request->image->extension();
            $path = $request->file('image')->store('image', 'public');
            //$request->image->move(public_path('image'), $imageName);
        } else {
            $path = $coffee->image;
        }

        $coffee->update([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'image' => $path,//'image/'.$imageName,
            'price' => $request->price,
        ]);

        return response()->json($coffee, 200);
    }

    public function delete($id)
    {
        $coffee = Coffee::findOrFail($id);
        Storage::disk('public')->delete($coffee->image);
        $coffee->delete();

        if ($coffee) {
            return response()->json([
                'message' => 'Successfully deleted coffee',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not Found!',
            ], 200);
        }
    }
}
