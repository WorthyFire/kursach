<?php

namespace App\Http\Controllers;

use App\Models\Coffeeshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CoffeeshopController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Получение параметра сортировки
            $sort = $request->query('sort', 'asc'); // по умолчанию сортировка по возрастанию

            // Получение параметра поиска
            $search = $request->query('search');

            // Создание запроса на получение кофеен
            $query = Coffeeshop::orderBy('name', $sort);

            // Добавление условия поиска по названию, если параметр поиска указан
            if ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            }

            // Выполнение запроса
            $coffeeshops = $query->get();
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
            $request->validate([
                'name' => 'required|string|max:255|unique:coffeeshops,name',
                'description' => 'required|string',
                'address' => 'required|string|max:255',
                'contact' => 'required|string|regex:/^\+?[0-9\-]{7,15}$/', // Валидация номера телефона
                'photo' => 'nullable|image|max:1024', // Например, проверка, что файл - изображение, размером не более 1MB
            ]);

            $coffeeshop = Coffeeshop::create($request->all());
            return response()->json($coffeeshop, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
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
            $request->validate([
                'name' => 'required|string|max:255|unique:coffeeshops,name,' . $id,
                'description' => 'required|string',
                'address' => 'required|string|max:255',
                'contact' => 'required|string|regex:/^\+?[0-9\-]{7,15}$/', // Валидация номера телефона
                'photo' => 'nullable|image|max:1024', // Например, проверка, что файл - изображение, размером не более 1MB
            ]);

            $coffeeshop = Coffeeshop::find($id);
            if (!$coffeeshop) {
                return response()->json(['error' => 'Кофейня не была найдена'], 404);
            }
            $coffeeshop->update($request->all());
            return response()->json($coffeeshop, 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
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
