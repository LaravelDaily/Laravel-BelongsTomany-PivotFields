<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRecipeRequest;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Models\Ingredient;
use App\Models\Recipe;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecipesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('recipe_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recipes = Recipe::all();

        return view('admin.recipes.index', compact('recipes'));
    }

    public function create()
    {
        abort_if(Gate::denies('recipe_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ingredients = Ingredient::all()->pluck('name', 'id');

        return view('admin.recipes.create', compact('ingredients'));
    }

    public function store(StoreRecipeRequest $request)
    {
        $recipe = Recipe::create($request->all());
        $recipe->ingredients()->sync($request->input('ingredients', []));

        return redirect()->route('admin.recipes.index');
    }

    public function edit(Recipe $recipe)
    {
        abort_if(Gate::denies('recipe_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ingredients = Ingredient::all()->pluck('name', 'id');

        $recipe->load('ingredients');

        return view('admin.recipes.edit', compact('ingredients', 'recipe'));
    }

    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        $recipe->update($request->all());
        $recipe->ingredients()->sync($request->input('ingredients', []));

        return redirect()->route('admin.recipes.index');
    }

    public function show(Recipe $recipe)
    {
        abort_if(Gate::denies('recipe_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recipe->load('ingredients');

        return view('admin.recipes.show', compact('recipe'));
    }

    public function destroy(Recipe $recipe)
    {
        abort_if(Gate::denies('recipe_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recipe->delete();

        return back();
    }

    public function massDestroy(MassDestroyRecipeRequest $request)
    {
        Recipe::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
