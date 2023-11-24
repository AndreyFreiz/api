<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function show($id)
    {
        return Category::findOrFail($id);
    }

    public function showBySlug($slug)
    {
        return Category::where('slug', $slug)->firstOrFail();
    }

    public function store(Request $request)
    {
        // Валидация данных запроса
        $validatedData = $request->validate([
            'slug' => 'required|string|unique:categories',
            'name' => 'required|string',
            'displayOption' => 'required|integer'
        ]);

        // Создание новой категории
        $category = Category::create($validatedData);

        // Возвращаем созданного партнера с кодом ответа 201 (Created)
        return response()->json($category, 201);
    }

    public function update(Request $request, $id)
    {
        // Поиск категории по ID и выброс исключения, если не найдено
        $category = Category::findOrFail($id);

        // Валидация входных данных
        $validatedData = $request->validate([
            'slug' => 'string|unique:categories,slug,' . $category->id,
            'name' => 'string',
            'displayOption' => 'integer'
        ]);

        // Обновление категории
        $category->update($validatedData);

        // Возвращаем обновленную категорию
        return response()->json($category);
    }

    public function destroy($id)
    {
        $partner = Category::findOrFail($id);
        $partner->delete();
        return response()->json(null, 204);
    }
}
