<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Services\YandexStorageService;
use Illuminate\Http\Request;

class AppController extends Controller
{


    public function index()
    {
        return App::all();
    }

    public function show($id)
    {
        return App::findOrFail($id);
    }

    public function showBySlug($slug)
    {
        return App::where('slug', $slug)->firstOrFail();
    }

    public function store(Request $request, YandexStorageService $storageService)
    {
        // Валидация входных данных
        $validatedData = $request->validate([
            'id' => 'string|unique:apps',
            'slug' => 'required|string|unique:apps',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'partnerLinkText' => 'nullable|string',
            'partnerLinkUrl' => 'nullable|string',
            'partnerId' => 'required|string',
            'icon' => 'required|string',
            'screenshots' => 'nullable|string',
            'size' => 'nullable|integer',
            'publicationDate' => 'nullable|date',
            'categoryId' => 'required|string',
            'version' => 'nullable|string',
            'solutionId' => 'nullable|string',
            'language' => 'nullable|string',
            'policyLink' => 'nullable|string',
            'licenseLink' => 'nullable|string',
            'displayOption' => 'required|integer'
        ]);


        $content = $request->file('content');

        if ($content && $content->isValid()) {
            $content = $request->file('content');
            $contentPath = $storageService->uploadFile($content);
            $validatedData['content'] = $contentPath;
        } else if ($content) {
            // Обработка ошибки загрузки файла
            echo "Файл не загружен или не валиден.\n";
        }

        // Создание нового приложения
        $app = App::create($validatedData);

        // Возвращаем созданное приложение с кодом ответа 201 (Created)
        return response()->json($validatedData, 201);
    }

    public function update(Request $request, YandexStorageService $storageService, $id)
    {
        // Поиск приложения по ID и выброс исключения, если не найдено
        $app = App::findOrFail($id);

        // Валидация входных данных
        $validatedData = $request->validate([
            'slug' => 'string|unique:apps,slug,' . $app->id,
            'name' => 'string',
            'description' => 'nullable|string',
            'partnerLinkText' => 'nullable|string',
            'partnerLinkUrl' => 'nullable|string',
            'partnerId' => 'string',
            'icon' => 'string',
            'screenshots' => 'nullable|string',
            'size' => 'nullable|integer',
            'publicationDate' => 'nullable|date',
            'categoryId' => 'string',
            'version' => 'nullable|string',
            'solutionId' => 'nullable|string',
            'language' => 'nullable|string',
            'policyLink' => 'nullable|string',
            'licenseLink' => 'nullable|string',
            'displayOption' => 'integer'
        ]);

        
        $content = $request->file('content');
        $validatedData['content'] = $storageService->uploadFile($content);

        // Обновление приложения
        $app->update($validatedData);

        // Возвращаем обновленное приложение
        return response()->json($app);
    }

    public function destroy($id)
    {
        $partner = App::findOrFail($id);
        $partner->delete();
        return response()->json(null, 204);
    }
}
