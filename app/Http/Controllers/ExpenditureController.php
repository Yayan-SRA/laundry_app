<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Store;
use App\Models\Finance;
use App\Models\Expenditure;
use Illuminate\Http\Request;

class ExpenditureController extends Controller
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
        // $y = Customer::where('name', 'LIKE', '%' . $request->search . '%')->first();
        // $x = Transaction::where([['customer_id', $y->id], ['is_paid', false]])->latest()->first();
        // dd($x);
        return view('dashboard.expenditure.create', [
            'title' => 'Expenditure',
            'units' => Unit::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'total' => 'required'
        ]);
        if ($request->store) {
            $store_id = Store::where('name', $request->store)->first()->id;
        } else {
            $store_id = auth()->user()->store_id;
        }
        $validatedData['store_id'] = $store_id;
        $validatedData['staff_name'] = auth()->user()->name;
        $validatedData['unit'] = Unit::where('id', $request->unit_id)->first()->name;

        $save = Expenditure::create($validatedData);
        if ($save) {
            $saldo = Finance::latest()->first()->final_finance;
            // return $saldo;
            $be_final_finance = $saldo;
            // if ($saldo) {
            // } else {
            //     $be_final_finance = 0;
            // }
            Finance::create([
                'store_id' => $store_id,
                'type' => 'Expenditure',
                'nominal' => $request->total,
                'final_finance' => ($be_final_finance - $request->total)
            ]);
        }

        return redirect("/dashboard/super?store=$request->store")->with('success', 'Expenditure has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expenditure $expenditure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expenditure $expenditure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expenditure $expenditure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expenditure $expenditure)
    {
        //
    }
}
