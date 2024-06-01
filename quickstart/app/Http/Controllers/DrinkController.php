<?php
namespace App\Http\Controllers;

use App\Models\Drink;
use Illuminate\Http\Request;

class DrinkController extends Controller
{
    public function index()
    {
        return Drink::all();
    }

    public function show($id)
    {
        return Drink::find($id);
    }

    public function store(Request $request)
    {
        $drink = Drink::create($request->all());
        return response()->json($drink, 201);
    }

    public function update(Request $request, $id)
    {
        $drink = Drink::find($id);
        $drink->update($request->all());
        return response()->json($drink, 200);
    }

    public function destroy($id)
    {
        Drink::destroy($id);
        return response()->json(null, 204);
    }
}

