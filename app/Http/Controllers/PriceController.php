<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Http\Requests\StorePriceRequest;
use App\Http\Requests\UpdatePriceRequest;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function find(Request $request)
    {
        $type_id = $request->type;
        $product_id = $request->product;
        $service_id = $request->service;
        $duration_id = $request->duration;
        $price = Price::where([['type_id', $type_id], ['product_id', $product_id], ['service_id', $service_id], ['duration_id', $duration_id]])->first();
        if ($price === null && $type_id && $product_id && $service_id && $duration_id) {
            return response()->json("Price not yet determined");
        } else if ($price === null) {
            return response()->json("");
        }
        return response()->json($price);
        // return response()->json(['price' => $price->price]);
    }

    public function index(Request $request)
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
    public function store(StorePriceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Price $price)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePriceRequest $request, Price $price)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Price $price)
    {
        //
    }
}
