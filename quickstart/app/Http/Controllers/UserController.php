<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        try {
            // Проверка на роль администратора
            if (Auth::user()->role->name !== 'admin') {
                return response()->json(['message' => 'У вас нет прав для выполнения этого действия.'], 403);
            }

            $users = User::all();
            return response()->json($users);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Что-то пошло не так'], 500);
        }
    }

    public function show($id)
    {
        try {
            // Проверка на роль администратора
            if (Auth::user()->role->name !== 'admin') {
                return response()->json(['message' => 'У вас нет прав для выполнения этого действия.'], 403);
            }

            $user = User::find($id);
            if (!$user) {
                return response()->json(['error' => 'Пользователь не найден'], 404);
            }
            return response()->json($user);
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

            $user = User::find($id);
            if (!$user) {
                return response()->json(['error' => 'Пользователь не найден'], 404);
            }

            // Обновление информации о пользователе
            $user->name = $request->input('name', $user->name);
            $user->email = $request->input('email', $user->email);

            // Обновление пароля, если он указан
            if ($request->has('password')) {
                $user->password = Hash::make($request->input('password'));
            }

            // Обновление роли пользователя
            if ($request->has('role_id')) {
                $user->role_id = $request->input('role_id');
            }

            $user->save();

            return response()->json($user, 200);
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

            $user = User::find($id);
            if (!$user) {
                return response()->json(['error' => 'Пользователь не найден'], 404);
            }
            $user->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Что-то пошло не так'], 500);
        }
    }
}
