<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Store;
use App\Models\Product;
use App\Models\Service;
use App\Models\Duration;
use Illuminate\Http\Request;

class SuperAdminAttributesController extends Controller
{
    public function index(Request $request)
    {
        // return $request;
        $store = $request->store;
        return view(
            'dashboard.superAdmin.stores.attributes.index',
            [
                'title' => $store . ' || Attributes',
                'selected' => Store::where('name', $store)->first(),
            ]
        );
    }
}
