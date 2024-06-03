<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DrinkController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Получение параметра сортировки
            $sort = $request->query('sort', 'asc'); // по умолчанию сортировка по возрастанию

            // Получение параметра поиска
            $search = $request->query('search');

            // Создание запроса на получение напитков
            $query = Drink::orderBy('name', $sort);

            // Добавление условия поиска по названию, если параметр поиска указан
            if ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            }

            // Выполнение запроса
            $drinks = $query->get();
            return response()->json($drinks);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Что-то пошло не так'], 500);
        }
    }

    public function show($id)
    {
        try {
            $drink = Drink::find($id);
            if (!$drink) {
                return response()->json(['error' => 'Напиток не найден'], 404);
            }
            return response()->json($drink);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Что-то пошло не так'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            // Проверка на роль администратора
            if (Auth::user()->role->name !== 'admin') {
                return response()->json(['message' => 'У вас нет прав для выполнения этого действия.'], 403);
            }

            $drink = Drink::create($request->all());
            return response()->json($drink, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Что-то пошло не так'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Проверка на роль администратора
            if (Auth::user()->role->name !== 'admin') {
                return response()->json(['message' => 'У вас нет прав для выполнения этого действия.'], 403);
            }

            $drink = Drink::find($id);
            if (!$drink) {
                return response()->json(['error' => 'Напиток не найден'], 404);
            }
            $drink->update($request->all());
            return response()->json($drink, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Что-то пошло не так'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Проверка на роль администратора
            if (Auth::user()->role->name !== 'admin') {
                return response()->json(['message' => 'У вас нет прав для выполнения этого действия.'], 403);
            }

            $drink = Drink::find($id);
            if (!$drink) {
                return response()->json(['error' => 'Напиток не найден'], 404);
            }
            $drink->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Что-то пошло не так'], 500);
        }
    }
}
