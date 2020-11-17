<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Http\Resources\Admin\RecipeResource;
use App\Models\Recipe;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecipesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('recipe_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RecipeResource(Recipe::with(['ingredients'])->get());
    }

    public function store(StoreRecipeRequest $request)
    {
        $recipe = Recipe::create($request->all());
        $recipe->ingredients()->sync($request->input('ingredients', []));

        return (new RecipeResource($recipe))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Recipe $recipe)
    {
        abort_if(Gate::denies('recipe_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new RecipeResource($recipe->load(['ingredients']));
    }

    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        $recipe->update($request->all());
        $recipe->ingredients()->sync($request->input('ingredients', []));

        return (new RecipeResource($recipe))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Recipe $recipe)
    {
        abort_if(Gate::denies('recipe_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recipe->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
