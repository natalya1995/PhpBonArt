<?php

namespace App\Http\Controllers;

use App\Models\Comittent;
use Illuminate\Http\Request;
use App\Http\Requests\CreateComittentRequest;

class ComittentController extends Controller
{
    public function index()
    {

        return Comittent::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validated();
        $comittent=Comittent::create('validatedData');
        return response()->json($comittent, 201);
    }
    public function show($id)
    {
        return Comittent::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $comittent = Comittent::findOrFail($id);
        $comittent->update($request->all());
        return $comittent;
    }
    public function destroy($id)
    {
        $comittent->delete();
        return response(null,204);
    }
}
