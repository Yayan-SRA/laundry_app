<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Unit;
use App\Models\Price;
use App\Models\Store;
use App\Models\Product;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Duration;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index(Request $request)
    {
        // return $request->store;
        // $store = Store::with('products')->where('id', 1)->first();
        // return $store;
        if ($request->store) {
            if ($request->store === 'master') {
                return redirect('/dashboard/super');
            } else {
                $validation = Store::where('name', $request->store)->first();
                if (!$validation) {
                    return redirect('/dashboard/super');
                }
            }
        }
        return view('dashboard.superAdmin.index', [
            'title' => 'super',
            'stores' => Store::all(),
            'selected' => Store::where('name', $request->store)->first(),
            'products' => Product::all(),
        ]);
    }

    public function attr(Request $request)
    {
        // return $request;
        if ($request->attr === "Services") {
            $items = Service::all();
        } else if ($request->attr === "Durations") {
            $items = Duration::all();
        } else if ($request->attr === "Products") {
            $items = Product::all();
        } else if ($request->attr === "Types") {
            $items = Type::all();
        }
        $store = Store::where('name', $request->store)->first();
        return view('dashboard.superAdmin.stores.attributes.index', [
            'title' => "$request->attr",
            'items' => $items,
            'selected' => $store,
            'stores' => Store::all(),
        ]);
    }

    public function store(Request $request)
    {
        $attr = Str::lower($request->attr);
        $validatedData = $request->validate([
            'store_id' => 'required',
            'attr' => 'required',
            $attr . '_id' => 'required',
            'checkbox' => 'required|string',
        ]);
        $id = $validatedData[$attr . '_id'];
        // return $attr === 'services';
        // if ($attr === 'services') {
        $find = Store::with("$attr")->where('id', $request->store_id)->first()->$attr->where('id', $id);
        // if ($request->checkbox === 'active') {
        if ($request->checkbox === 'active' && !$find->count()) {
            // return 'akan ditambah';
            $store = Store::with("$attr")->where('id', $request->store_id)->first();
            $store->$attr()->attach($id);
            return redirect("/dashboard/super/attributes?store=$store->name&attr=$request->attr");
        } else if ($request->checkbox === 'active' && $find->count()) {
            return 'akan direload';
        } else if ($request->checkbox === 'inactive' && !$find->count()) {
            return 'akan direload';
        } else if ($request->checkbox === 'inactive' && $find->count()) {
            // return 'akan dikurang';
            $store = Store::with("$attr")->where('id', $request->store_id)->first();
            $store->$attr()->detach($id);
            // $store->$attr()->detach($request->service_id);
            return redirect("/dashboard/super/attributes?store=$store->name&attr=$request->attr");
        } else {
            abort(403);
        }
    }

    public function trans(Request $request)
    {
        // return Transaction::with('store')->where('id', 1)->get();
        $store = Store::where('name', $request->store)->first();
        // $coba = 
        // return $store;
        return view('dashboard.transactions.index', [
            'title' => 'Transactions',
            'transactions' => Transaction::where('store_id', $store->id)->latest()->get(),
        ]);
    }

    public function find(Request $request)
    {
        // return $request;

        $attr = $request->attr;
        $id = $request->attr_id;
        $result = Store::with("$attr")->where('id', $request->store_id)->first()->$attr->where('id', $id);
        return response()->json($result);
    }

    public function choice(Request $request)
    {
        $store = $request->store;
        $types = Store::with('types')->where('name', $store)->first()->types;
        // return $types;
        return view('dashboard.transactions.transAddTransaction', [
            'title' => 'Pre-Order',
            'types' => $types
        ]);
    }

    public function create(Request $request)
    {
        $store = $request->store;
        $store_id = Store::where('name', $store)->first()->id;
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
        $products = Store::with('products')->where('name', $store)->first()->products->where('type_id', $choosenType->id);
        // return $products;
        $services = Store::with('services')->where('name', $store)->first()->services->where('type_id', $choosenType->id);
        $durations = Store::with('durations')->where('name', $store)->first()->durations->where('type_id', $choosenType->id);

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
}
