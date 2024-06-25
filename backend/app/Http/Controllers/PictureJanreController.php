<?php

namespace App\Http\Controllers;

use App\Models\PictureJanre;
use App\Http\Requests\PictureJanreRequest;
use Illuminate\Http\Request;

class PictureJanreController extends Controller
{
    public function index()
    {
        $pictureJanres = PictureJanre::with(['picture', 'janre'])->get();
        return response()->json($pictureJanres);
    }

    public function store(PictureJanreRequest $request)
    {
        $pictureJanre = PictureJanre::create($request->validated());
        return response()->json($pictureJanre, 201);
    }

    public function show(PictureJanre $pictureJanre)
    {
        return response()->json($pictureJanre->load(['picture', 'janre']));
    }

    public function update(PictureJanreRequest $request, PictureJanre $pictureJanre)
    {
        $pictureJanre->update($request->validated());
        return response()->json($pictureJanre);
    }

    public function destroy(PictureJanre $pictureJanre)
    {
        $pictureJanre->delete();
        return response()->json(null, 204);
    }
}
