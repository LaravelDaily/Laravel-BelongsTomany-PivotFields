<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIngredientRequest;
use App\Http\Requests\StoreIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;
use App\Models\Ingredient;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IngredientsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ingredient_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ingredients = Ingredient::all();

        return view('admin.ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        abort_if(Gate::denies('ingredient_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ingredients.create');
    }

    public function store(StoreIngredientRequest $request)
    {
        $ingredient = Ingredient::create($request->all());

        return redirect()->route('admin.ingredients.index');
    }

    public function edit(Ingredient $ingredient)
    {
        abort_if(Gate::denies('ingredient_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ingredients.edit', compact('ingredient'));
    }

    public function update(UpdateIngredientRequest $request, Ingredient $ingredient)
    {
        $ingredient->update($request->all());

        return redirect()->route('admin.ingredients.index');
    }

    public function show(Ingredient $ingredient)
    {
        abort_if(Gate::denies('ingredient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ingredients.show', compact('ingredient'));
    }

    public function destroy(Ingredient $ingredient)
    {
        abort_if(Gate::denies('ingredient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ingredient->delete();

        return back();
    }

    public function massDestroy(MassDestroyIngredientRequest $request)
    {
        Ingredient::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
