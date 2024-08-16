<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coffee_id' => 'required',
            'user_id' => 'required',
            'rating' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $insert = Rating::create([
            'coffee_id' => $request->coffee_id,
            'user_id' => $request->user_id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return response()->json($insert, 200);
    }
}
