<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;
use App\Http\Resources\Admin\IngredientResource;
use App\Models\Ingredient;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IngredientsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ingredient_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IngredientResource(Ingredient::all());
    }

    public function store(StoreIngredientRequest $request)
    {
        $ingredient = Ingredient::create($request->all());

        return (new IngredientResource($ingredient))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Ingredient $ingredient)
    {
        abort_if(Gate::denies('ingredient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IngredientResource($ingredient);
    }

    public function update(UpdateIngredientRequest $request, Ingredient $ingredient)
    {
        $ingredient->update($request->all());

        return (new IngredientResource($ingredient))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Ingredient $ingredient)
    {
        abort_if(Gate::denies('ingredient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ingredient->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
