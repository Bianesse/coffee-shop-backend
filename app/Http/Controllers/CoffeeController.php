<?php

namespace App\Http\Controllers;

use App\Models\Coffee;
use Illuminate\Http\Request;
use App\Http\Resources\CoffeeResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCoffeeRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateCoffeeRequest;

class CoffeeController extends Controller
{

    public function show(Coffee $coffee)
    {
        $coffee = Coffee::get();
        return CoffeeResource::collection($coffee);
    }

    public function detail(Coffee $coffee, $id)
    {
        $coffee = Coffee::findOrFail($id);
        return new CoffeeResource($coffee);
    }

    public function insert(Request $request)
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

        return response()->json($insert, 200);
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
            $path = $request->file('image')->store('image', 'public');
        } else {
            $path = $coffee->image;
        }

        $coffee->update([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'image' => $path,
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
