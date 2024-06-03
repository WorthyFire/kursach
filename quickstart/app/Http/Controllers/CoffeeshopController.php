<?php

namespace App\Http\Controllers;

use App\Models\Coffeeshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoffeeshopController extends Controller
{
    public function index()
    {
        try {
            $coffeeshops = Coffeeshop::with('drinks', 'reviews')->get();
            return response()->json($coffeeshops);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Что-то пошло не так'], 500);
        }
    }

    public function show($id)
    {
        try {
            $coffeeshop = Coffeeshop::with('drinks', 'reviews')->find($id);
            if (!$coffeeshop) {
                return response()->json(['error' => 'Кофейня не была найдена'], 404);
            }
            return response()->json($coffeeshop);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Что-то пошло не так'], 500);
        }
    }

    public function store(Request $request)
    {
        if (Auth::user()->role_id !== 1) {  // Проверяем роль пользователя
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }

        try {
            $coffeeshop = Coffeeshop::create($request->all());
            return response()->json($coffeeshop, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Что-то пошло не так'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role_id !== 1) {  // Проверяем роль пользователя
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }

        try {
            $coffeeshop = Coffeeshop::find($id);
            if (!$coffeeshop) {
                return response()->json(['error' => 'Кофейня не была найдена'], 404);
            }
            $coffeeshop->update($request->all());
            return response()->json($coffeeshop, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Что-то пошло не так'], 500);
        }
    }

    public function destroy($id)
    {
        if (Auth::user()->role_id !== 1) {  // Проверяем роль пользователя
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }

        try {
            $coffeeshop = Coffeeshop::find($id);
            if (!$coffeeshop) {
                return response()->json(['error' => 'Кофейня не была найдена'], 404);
            }
            $coffeeshop->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Что-то пошло не так'], 500);
        }
    }
}
