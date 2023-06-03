<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Unit;
use App\Models\Price;
use App\Models\Product;
use App\Models\Service;
use App\Models\Duration;
use Illuminate\Http\Request;

class SuperAdminMasterController extends Controller
{
    public function m_attr(Request $request)
    {
        // Type::class
        if ($request->attr) {
            $units = [];
            $attr = $request->attr;
            if ($attr === 'Types') {
                $results = Type::all();
            } elseif ($attr === 'Products') {
                $results = Product::all();
                // return $results;
            } elseif ($attr === 'Services') {
                $results = Service::all();
            } elseif ($attr === 'Durations') {
                $results = Duration::with('unit', 'type')->get();
                $units = Unit::all();
                // return $results;
            } else if ($request->attr === "Units") {
                // return Unit::all();
                return view('dashboard.superAdmin.master.index', [
                    'title' => $attr,
                    'results' => Unit::all(),
                    // 'types' => Type::all(),
                    // 'units' => $units,
                ]);
            } else if ($request->attr === "Prices") {
                $types = Type::all();
                $products = Product::all();
                $services = Service::all();
                $durations = Duration::with('unit')->get();
                $prices = Price::with('type', 'product', 'service', 'duration')->get();
                // return $prices;
                return view('dashboard.superAdmin.master.index', [
                    'title' => $attr,
                    'results' => $prices,
                    'types' => $types,
                    'products' => $products,
                    'services' => $services,
                    'durations' => $durations,
                    'units' => $units,
                ]);
            } else {
                abort(404);
            }

            return view('dashboard.superAdmin.master.index', [
                'title' => $attr,
                'results' => $results,
                'types' => Type::all(),
                'units' => $units,
            ]);
        } else {
            abort(404);
        }
    }

    public function delete(Request $request)
    {

        if ($request->attr && $request->id) {
            $attr = $request->attr;
            $id = $request->id;
            if ($attr === 'Types') {
                Type::destroy($id);
            } else if ($attr === 'Products') {
                Product::destroy($id);
            } else if ($attr === 'Services') {
                Service::destroy($id);
            } else if ($attr === 'Durations') {
                Duration::destroy($id);
                // return $results;
            } else if ($attr === 'Prices') {
                Price::destroy($id);
            } else if ($attr === 'Units') {
                Unit::destroy($id);
            } else {
                abort(404);
            }
            return redirect("/dashboard/super/master/attributes?attr=$attr")->with('success', "The $attr has been deleted");
        } else {
            abort(404);
        }
    }

    public function update(Request $request)
    {
        // return $request;
        if ($request->attr) {
            $attr = $request->attr;
            $id = $request->id;
            if ($attr === 'Durations') {
                $rules = ([
                    'time_period' => 'required',
                    'unit_id' => 'required',
                    'type_id' => 'required',
                ]);
                $validatedData = $request->validate($rules);
                Duration::where('id', $id)->update($validatedData);
            } else if ($attr === 'Types' || $attr === 'Units') {
                $rules = ([
                    'name' => 'required|min:2',
                ]);
                $validatedData = $request->validate($rules);
                if ($attr === 'Types') {
                    Type::where('id', $id)
                        ->update($validatedData);
                } else {
                    Unit::where('id', $id)
                        ->update($validatedData);
                }
            } else if ($attr === 'Prices') {
                $rules = ([
                    'type_id' => 'required',
                    'product_id' => 'required',
                    'service_id' => 'required',
                    'duration_id' => 'required',
                    'price' => 'required',
                ]);
                $validatedData = $request->validate($rules);
                Price::where('id', $id)
                    ->update($validatedData);
            } else {
                $rules = ([
                    'name' => 'required|min:3',
                    'type_id' => 'required'
                ]);
                $validatedData = $request->validate($rules);
                if ($attr === 'Products') {
                    Product::where('id', $id)
                        ->update($validatedData);
                } elseif ($attr === 'Services') {
                    Service::where('id', $id)
                        ->update($validatedData);
                } else {
                    abort(404);
                }
            }
            return redirect("/dashboard/super/master/attributes?attr=$attr")->with('success', "The $attr has been updated");
        } else {
            abort(404);
        }
    }

    public function store(Request $request)
    {
        // return $request;
        if ($request->attr) {
            $attr = $request->attr;
            if ($attr === 'Durations') {
                $rules = ([
                    'time_period' => 'required',
                    'unit_id' => 'required',
                    'type_id' => 'required',
                ]);
                $validatedData = $request->validate($rules);
                Duration::create($validatedData);
            } else if ($attr === 'Types' || $attr === 'Units') {
                $rules = ([
                    'name' => 'required|min:2',
                ]);
                $validatedData = $request->validate($rules);
                if ($attr === 'Types') {
                    Type::create($validatedData);
                } else {
                    Unit::create($validatedData);
                }
            } else if ($attr === 'Prices') {
                $rules = ([
                    'type_id' => 'required',
                    'product_id' => 'required',
                    'service_id' => 'required',
                    'duration_id' => 'required',
                    'price' => 'required',
                ]);
                $validatedData = $request->validate($rules);
                Price::create($validatedData);
            } else {
                $rules = ([
                    'name' => 'required',
                    'type_id' => 'required'
                ]);
                $validatedData = $request->validate($rules);
                if ($attr === 'Products') {
                    Product::create($validatedData);
                } else if ($attr === 'Services') {
                    Service::create($validatedData);
                } else {
                    abort(404);
                }
            }
            return redirect("/dashboard/super/master/attributes?attr=$attr")->with('success', "The $attr has been created");
        } else {
            abort(404);
        }
    }
}
