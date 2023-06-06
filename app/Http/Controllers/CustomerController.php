<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->store) {
            $store_id = Store::where('name', $request->store)->first()->id;
        } else {
            $store_id = auth()->user()->store_id;
        }
        return view('dashboard.customers.index', [
            'title' => 'Customer Data',
            // 'stores' => Store::all(),
            // 'selected' => Store::where('name', $request->store)->first(),
            'customers' => Customer::where('store_id', $store_id)->latest()->get()
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
    public function keyExists($res)
    {
        return Customer::where('key', $res)->exists();
    }

    public function generateKey()
    {
        $res = 'CST' . mt_rand(10000, 99999);

        if ($this->keyExists($res)) {
            return $this->generatekey();
        }

        return $res;
    }


    public function store(Request $request)
    {

        $number = $request->phone_number;
        if(Str::substr($number, 0, 1) == 0 || Str::substr($number, 0, 2) != 62){
            if ($request->store && $request->type) {
                return redirect("dashboard/super/order/create?store=$request->store&type=$request->type")->with('numberFail', "Use 62 format");
            }
            return redirect("/dashboard/transactions/create")->with('numberFail', "Use 62 format");
            // $result = Str::substrReplace($number, "62", 0,1);
        };
        $validatedData = $request->validate([
            'name' => 'required|unique:customers|min:3|max:50',
            'phone_number' => 'required|max:15|min:10|unique:customers',
            'address' => 'nullable|min:4|max:255',
        ]);
        $number = $request->phone_number;
        if($request->phone_number)
        if ($request->store && $request->type) {
            $validatedData['store_id'] = Store::where('name', $request->store)->first()->id;
        } else {
            $validatedData['store_id'] = auth()->user()->store_id;
        }
        $check = $this->generateKey();
        // dd($check);
        $validatedData['key'] = $check;

        Customer::create($validatedData);
        if ($request->store && $request->type) {
            return redirect("dashboard/super/order/create?store=$request->store&type=$request->type&search=$request->name")->with('success', "New customer : $request->name has been added");
        }
        return redirect("/dashboard/transactions/create?search=$request->name")->with('success', "New customer : $request->name has been added");
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $number = $request->phone_number;
        if(Str::substr($number, 0, 1) == 0 || Str::substr($number, 0, 2) != 62){
            if ($request->store && $request->type) {
                return redirect("/dashboard/customers?store=$request->store")->with('numberFail', "Use 62 format");
            }
            return redirect("/dashboard/customers/")->with('numberFail', "Use 62 format");
            // $result = Str::substrReplace($number, "62", 0,1);
        };
        $rules = ([
            'address' => 'nullable|min:4|max:255',
        ]);
        if ($customer->name != $request->name) {
            $rules['name'] = 'required|unique:customers|min:3|max:50';
            if($customer->where('name', $request->name)->first()){
                if ($request->store && $request->type) {
                    return redirect("/dashboard/customers?store=$request->store")->with('numberFail', "Name has been taken");
                }
                return redirect("/dashboard/customers/")->with('numberFail', "Name has been taken");
            }
        }
        if($customer->phone_number != $request->phone_number){
            $rules['phone_number'] = 'required|max:15|min:10|unique:customers';
            // return $customer->where('phone_number', $customer->phone_number)->first();
            if($customer->where('phone_number', $request->phone_number)->first()){
                if ($request->store && $request->type) {
                    return redirect("/dashboard/customers?store=$request->store")->with('numberFail', "Phone number has been taken");
                }
                return redirect("/dashboard/customers/")->with('numberFail', "Phone number has been taken");
            }
        }
        $validatedData = $request->validate($rules);
        $customer->update($validatedData);
        if($request->store){
            return redirect("/dashboard/customers?store=$request->store")->with('success', "Customer data has been updated");
        }
        return redirect('/dashboard/customers/')->with('success', "Customer data has been updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
