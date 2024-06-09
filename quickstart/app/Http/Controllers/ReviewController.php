<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{
    public function index()
    {
        try {
            $reviews = Review::all();
            return response()->json($reviews);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Что-то пошло не так'], 500);
        }
    }

    public function show($id)
    {
        try {
            $review = Review::find($id);
            if (!$review) {
                return response()->json(['error' => 'Отзыв не был найден'], 404);
            }
            return response()->json($review);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Что-то пошло не так'], 500);
        }
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Необходимо авторизоваться'], 401);
        }

        try {
            $request->validate([
                'rating' => 'required|integer|between:1,5',
                'comment' => 'required|string|max:500',
                'coffeeshop_id' => 'required|exists:coffeeshops,id',
            ]);

            $review = Review::create([
                'user_id' => Auth::id(),
                'coffeeshop_id' => $request->coffeeshop_id,
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);

            return response()->json($review, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Что-то пошло не так'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Необходимо авторизоваться'], 401);
        }

        try {
            $request->validate([
                'rating' => 'required|integer|between:1,5',
                'comment' => 'required|string|max:500',
            ]);

            $review = Review::find($id);
            if (!$review) {
                return response()->json(['error' => 'Отзыв не был найден'], 404);
            }

            if ($review->user_id !== Auth::id() && Auth::user()->role_id !== 1) {
                return response()->json(['error' => 'Доступ запрещен'], 403);
            }

            $review->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);

            return response()->json($review, 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Что-то пошло не так'], 500);
        }
    }

    public function destroy($id)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Необходимо авторизоваться'], 401);
        }

        try {
            $review = Review::find($id);
            if (!$review) {
                return response()->json(['error' => 'Отзыв не был найден'], 404);
            }

            if ($review->user_id !== Auth::id() && Auth::user()->role_id !== 1) {
                return response()->json(['error' => 'Доступ запрещен'], 403);
            }

            $review->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Что-то пошло не так'], 500);
        }
    }
}

