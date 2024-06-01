<?php

namespace App\Http\Controllers;

use App\Models\Coffeeshop;
use Illuminate\Http\Request;

class CoffeeshopController extends Controller
{
    public function index()
    {
        return Coffeeshop::with('drinks', 'reviews')->get();
    }

    public function show($id)
    {
        return Coffeeshop::with('drinks', 'reviews')->find($id);
    }

    public function store(Request $request)
    {
        $coffeeshop = Coffeeshop::create($request->all());
        return response()->json($coffeeshop, 201);
    }

    public function update(Request $request, $id)
    {
        $coffeeshop = Coffeeshop::find($id);
        $coffeeshop->update($request->all());
        return response()->json($coffeeshop, 200);
    }

    public function destroy($id)
    {
        Coffeeshop::destroy($id);
        return response()->json(null, 204);
    }
}
