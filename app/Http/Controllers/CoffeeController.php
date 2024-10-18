<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Coffee;
use Illuminate\Http\Request;
use App\Models\CoffeeFavorite;
use App\Http\Resources\CoffeeResource;
use App\Http\Resources\ReviewResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CoffeeCollection;
use App\Http\Resources\FavoriteResource;
use App\Http\Requests\StoreCoffeeRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateCoffeeRequest;
use Illuminate\Database\Eloquent\Collection;

class CoffeeController extends Controller
{

    public function show(Coffee $coffee)
    {
        $coffee = Coffee::with('prices')->get();
        return new CoffeeCollection($coffee);
    }

    public function detail(Coffee $coffee, $id)
    {
        $coffee = Coffee::with('ratings')->find($id);
        return new ReviewResource($coffee);
    }

    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
        ]);

        $latest = Coffee::orderBy('id', 'desc')->pluck('id')->first();
        $size = ['S', 'M', 'L'];

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
            'S' => 'required',
            'M' => 'required',
            'L' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $coffee = Coffee::with('prices')->findOrFail($id);

        if ($request->hasFile('image')) {
            if (!empty($coffee->image)) {
                Storage::disk('public')->delete($coffee->image);
            }
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
            'image' => $path, //'image/'.$imageName,
        ]);

        foreach ($coffee->prices as $v) {
            $size = $v->size;
            $v->price = $request->$size;
            $v->save();
        }

        return response()->json($coffee, 200);
    }

    public function delete($id)
    {
        $coffee = Coffee::findOrFail($id);
        if (!empty($coffee->image)) {
            Storage::disk('public')->delete($coffee->image);
        }
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

    public function favorite($id)
    {
        try {
            $user = auth()->user()->id;
        
            // Check if the coffee exists before proceeding
            $coffee = Coffee::find($id); // Assuming there's a Coffee model
            if (!$coffee) {
                return response()->json([
                    'success' => false,
                    'message' => 'Coffee not found',
                ], 404);
            }
        
            // Proceed with favorite logic if coffee exists
            $favorite = CoffeeFavorite::where('user_id', $user)->where('coffee_id', $id)->first();
        
            if (!$favorite) {
                $favorite = new CoffeeFavorite();
                $favorite->user_id = $user;
                $favorite->coffee_id = $id;
                $favorite->save();
                return response()->json([
                    'success' => true,
                    'message' => $favorite,
                ], 200);
            } else {
                $favorite->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Unfavorited',
                ], 200);
            }
        } catch (\Exception $e) {
            // Catch any other unexpected errors
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
        
        
    }

    public function getFavorite()
    {
        $user = auth()->user()->id;

        $favorite = CoffeeFavorite::with('coffees.prices', 'users.roles')->where('user_id', $user)->get();
        if(!$favorite){
            return response()->json([
                'message' => 'Favorite Empty!',
            ], 200);
        }

        return FavoriteResource::collection($favorite);
    }
}
