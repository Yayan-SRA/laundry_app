<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreAdminMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.superAdmin.master.stores.index', [
            'title' => 'Store List',
            'stores' => Store::all()
        ]);
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
    public function store(Request $request)
    {
        // return $request;
        $rules = ([
            'name' => 'required|min:5',
            'address' => 'required:min:10'
        ]);
        $validatedData = $request->validate($rules);
        if ($validatedData) {
            return redirect('/dashboard/super/master/store')->with('success', 'Store has been added');
        }
        // return $validatedData;

        Store::create($validatedData);
        return redirect('/dashboard/super/master/store')->with('success', 'Store has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        //
    }
}
