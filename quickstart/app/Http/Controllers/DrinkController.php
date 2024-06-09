<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
        if (Auth::user()->role_id !== 1) {  // Проверка на роль администратора
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'ingredients' => 'required|string',
                'category' => 'required|string|max:255',
                'description' => 'required|string',
                'photo' => 'nullable|image|max:1024', // Например, проверка, что файл - изображение, размером не более 1MB
                'coffeeshop_id' => 'required|exists:coffeeshops,id',
            ]);

            // Проверка на уникальность комбинации названия напитка и идентификатора кофейни
            if (Drink::where('name', $request->name)->where('coffeeshop_id', $request->coffeeshop_id)->exists()) {
                return response()->json(['error' => 'Напиток с таким названием уже существует в этой кофейне'], 422);
            }

            $drink = Drink::create($request->all());
            return response()->json($drink, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Что-то пошло не так'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role_id !== 1) {  // Проверка на роль администратора
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'ingredients' => 'required|string',
                'category' => 'required|string|max:255',
                'description' => 'required|string',
                'photo' => 'nullable|image|max:1024', // Например, проверка, что файл - изображение, размером не более 1MB
                'coffeeshop_id' => 'required|exists:coffeeshops,id',
            ]);

            $drink = Drink::find($id);
            if (!$drink) {
                return response()->json(['error' => 'Напиток не найден'], 404);
            }

            // Проверка на уникальность комбинации названия напитка и идентификатора кофейни
            if (Drink::where('name', $request->name)
                ->where('coffeeshop_id', $request->coffeeshop_id)
                ->where('id', '!=', $id)
                ->exists()) {
                return response()->json(['error' => 'Напиток с таким названием уже существует в этой кофейне'], 422);
            }

            $drink->update($request->all());
            return response()->json($drink, 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Что-то пошло не так'], 500);
        }
    }

    public function destroy($id)
    {
        if (Auth::user()->role_id !== 1) {  // Проверка на роль администратора
            return response()->json(['error' => 'Доступ запрещен'], 403);
        }

        try {
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

