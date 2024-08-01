<?php

namespace App\Http\Controllers;

use App\Models\Coffee;
use App\Http\Requests\StoreCoffeeRequest;
use App\Http\Requests\UpdateCoffeeRequest;
use App\Http\Resources\CoffeeResource;

class CoffeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCoffeeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coffee $coffee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCoffeeRequest $request, Coffee $coffee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coffee $coffee)
    {
        //
    }
}
