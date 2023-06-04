<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Type;
use App\Models\Unit;
use App\Models\Store;
use App\Models\Product;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Duration;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Exports\TransactionExport;
use Maatwebsite\Excel\Facades\Excel;

// class p
// {
//     // buat property untuk post
//     var $id;
//     var $user_id;
//     var $category_id;
//     var $title;
//     var $slug;
//     var $body;
//     var $image;
// }

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.transactions.index', [
            'title' => 'Transaction',
            'transactions' => Transaction::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // $p = Type::where('name', $request->type)->first();
        // dd($p);
        // return $p;
        $store_id = auth()->user()->store_id;
        // $product = Store::with('products')->where('id', $store_id)->first()->products->where('type_id', $p->id);
        // $type = Store::with('types')->where('id', $store_id)->first()->types;
        // $service = Store::with('services')->where('id', $store_id)->first()->services;
        // $duration = Store::with('durations')->where('id', $store_id)->first()->durations;
        // // return $product;
        // $y = Customer::where([['name', 'LIKE', '%' . $request->search . '%'], ['store_id', auth()->user()->store_id]])->first();
        // $x = new p();
        $choosenType = Type::where('name', $request->type)->first();
        if ($choosenType->name === 'Kiloan') {
            $unit = Unit::where('name', 'Kg')->first();
            // return $unit;
        } else if ($choosenType->name === 'Satuan') {
            $unit = Unit::where('name', 'Pcs')->first();
        } else {
            $unit = Unit::all();
        }
        // return 
        $products = Store::with('products')->where('id', $store_id)->first()->products->where('type_id', $choosenType->id);
        // return $products;
        $services = Store::with('services')->where('id', $store_id)->first()->services->where('type_id', $choosenType->id);
        $durations = Store::with('durations')->where('id', $store_id)->first()->durations->where('type_id', $choosenType->id);

        $customer = Customer::where([['name', 'LIKE', '%' . $request->search . '%'], ['store_id', $store_id]])->orWhere([['key', 'LIKE', '%' . $request->search . '%'], ['store_id', $store_id]])->first();
        return view('dashboard.transactions.addTransaction', [
            'title' => 'Add New Order',
            'type' => $choosenType,
            'products' => $products,
            'services' => $services,
            'durations' => $durations,
            'pre' => $choosenType,
            'result' => $customer,
            'units' => $unit
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function keyExists($res)
    {
        return Transaction::where('key', $res)->exists();
    }

    public function generateKey()
    {
        $res = 'INV' . mt_rand(1000000, 9999999);

        if ($this->keyExists($res)) {
            return $this->generatekey();
        }

        return $res;
    }
    public function store(Request $request)
    {
        // return gettype($request->date_complete);
        // return $request;
        $rules = ([
            'customer_id' => 'required',
            'type' => 'required',
            'product_id' => 'required',
            'service_id' => 'required',
            'duration_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'unit_id' => 'required',
            'cod' => 'required',
            'total_price' => 'required',
            'target_date_complete' => 'required',
            'note' => 'max:255',
        ]);

        $validatedData = $request->validate($rules);
        if ($request->store) {
            $validatedData['store_id'] = Store::where('name', $request->store)->first()->id;
        } else {
            $validatedData['store_id'] = auth()->user()->store_id;
        }
        if ($request->cod == 0) {
            $validatedData['cod'] = false;
        } else if ($request->cod == 1) {
            $validatedData['cod'] = true;
        }
        $validatedData['staff_name'] = auth()->user()->name;
        // $validatedData['customer_id'] = $request->customer_id;
        $validatedData['key'] = $this->generateKey();

        // return $validatedData;
        $duration = Duration::where('id', $validatedData['duration_id'])->first();

        Transaction::create([
            'key' => $validatedData['key'],
            'store_id' => $validatedData['store_id'],
            'staff_name' => $validatedData['staff_name'],
            'customer_id' => $validatedData['customer_id'],
            'type' => $validatedData['type'],
            'product' => Product::where('id', $validatedData['product_id'])->first()->name,
            'service' => Service::where('id', $validatedData['service_id'])->first()->name,
            'duration' => ($duration->time_period . ' ' .  $duration->unit->name),
            'price' => $validatedData['price'],
            'quantity' => $validatedData['quantity'],
            'unit' => Unit::where('id', $validatedData['unit_id'])->first()->name,
            'total_price' => $validatedData['total_price'],
            'target_date_complete' => $validatedData['target_date_complete'],
            'cod' => $validatedData['cod'],
            'note' => $validatedData['note'],
        ]);
        if ($request->store) {
            return redirect("/dashboard/super/transactions?store=$request->store")->with('success', "New transaction has been added");
        }
        return redirect("/dashboard/transactions")->with('success', "New transaction has been added");
    }

    public function choice(Request $request)
    {
        return view('dashboard.transactions.transAddTransaction', [
            'title' => 'Pre Order',
            'types' => Type::all()
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        // return gettype($request->is_done);
        // return $request;
        // $id = $request->id;
        $store = $request->store;
        $rules = ([
            'is_done' => 'required',
        ]);
        $validatedData = $request->validate($rules);
        $is_done = filter_var($request->is_done, FILTER_VALIDATE_BOOLEAN);
        // if ($request->is_done == "true") {
        //     $validatedData['is_done'] = 1;
        // }
        $validatedData['is_done'] = $is_done;
        $validatedData['date_complete'] = Carbon::now()->format('Y-m-d');
        // $validatedData['date_complete'] = Carbon::now();
        // return $validatedData;
        $transaction->update($validatedData);
        // return $is_done;
        if ($request->store) {
            return redirect("/dashboard/super/transactions?store=$store")->with('success', "Success updated");
        }
        return redirect("/dashboard/transactions")->with('success', "Success updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function export(Request $request){
        $start = strtotime($request->start);
        $end = strtotime($request->end);
        $startDate =  date('d F Y', $start);
        $endDate =  date('d F Y', $end);

        // return ([
        //     $save = Excel::download(new TransactionExport, 'data_transaction.xlsx'),
        //     $save->awal=$request->awal,
        //     $save->akhir=$request->akhir,
        // ]);
        $export = new TransactionExport([
            [$request->start],
            [$request->end]
        ]);
    
        return Excel::download($export, "Transaction data from $startDate to $endDate.xlsx");
    }
}
