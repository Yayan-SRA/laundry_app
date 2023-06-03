<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Cashier;
use App\Models\Finance;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // return view('dashboard.cashiers.index',[

        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $y = Customer::where('name', 'LIKE', '%' . $request->search . '%')->first();
        if (!$y) {
            $result = Transaction::where([['key', 'LIKE', '%' . $request->search . '%'], ['is_paid', false]])->latest()->first();
        } else {
            $result = Transaction::where([['customer_id', $y->id], ['is_paid', false]])->latest()->first();
        }
        // dd($x);
        return view('dashboard.cashiers.create', [
            'title' => 'Cashier',
            'transaction' => $result
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // return $request;
        $rules = ([
            // 'key' => 'required',
            'customer_money' => 'required',
            'change' => 'required',
            'income' => 'required',
            'transaction_id' => 'required',
        ]);

        $validatedData = $request->validate($rules);
        if ($request->store) {
            $store_id = Store::where('name', $request->store)->first()->id;
        } else {
            $store_id = auth()->user()->store_id;
        }

        $validatedData['store_id'] = $store_id;
        $validatedData['staff_name'] = auth()->user()->name;

        $save = Cashier::create($validatedData);
        if ($save) {
            $update = Transaction::where('id', $request->transaction_id)->update([
                'is_paid' => true,
            ]);

            if ($update) {
                $saldo = Finance::latest()->first();
                if (!$saldo) {
                    $final_finance = (0 + $request->income);
                } else {
                    $final_finance = ($saldo->final_finance + $request->income);
                }

                Finance::create([
                    'store_id' => $store_id,
                    'type' => 'Income',
                    'nominal' => $request->income,
                    'final_finance' => $final_finance
                ]);
            }
        }
        if ($request->store) {
            return redirect("/dashboard/super/transactions?store=$request->store")->with('success', "The order has been paid");
        }
        return redirect("/dashboard/transactions")->with('success', "The order has been paid");
    }

    /**
     * Display the specified resource.
     */
    public function show(Cashier $cashier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cashier $cashier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cashier $cashier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cashier $cashier)
    {
        //
    }
}
