<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        return Partner::all();
    }

    public function show($id)
    {
        return Partner::findOrFail($id);
    }

    public function showBySlug($slug)
    {
        return Partner::where('slug', $slug)->firstOrFail();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'slug' => 'required|string|unique:partners',
            'name' => 'required|string',
            'logo' => 'nullable|string',
            'description' => 'nullable|string',
            'link' => 'nullable|string',
            'displayOption' => 'required|integer'
        ]);

        

        // Создание нового партнера
        $partner = Partner::create($validatedData);

        // Возвращаем созданного партнера с кодом ответа 201 (Created)
        return response()->json($partner, 201);
    }

    public function update(Request $request, $id)
    {
        // Находим партнера в базе данных
        $partner = Partner::findOrFail($id);

        // Валидация данных запроса
        $validatedData = $request->validate([
            'slug' => 'string|unique:partners,slug,' . $partner->id,
            'name' => 'string',
            'logo' => 'nullable|string',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'link' => 'nullable|string',
            'displayOption' => 'integer'
        ]);

        // Обновление партнера
        $partner->update($validatedData);

        // Возвращаем обновленного партнера
        return response()->json($partner);
    }

    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->delete();
        return response()->json(null, 204);
    }
}
