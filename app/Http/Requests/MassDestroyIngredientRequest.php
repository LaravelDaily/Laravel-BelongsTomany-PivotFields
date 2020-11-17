<?php

namespace App\Http\Requests;

use App\Models\Ingredient;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyIngredientRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ingredient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:ingredients,id',
        ];
    }
}
