<?php

namespace App\Http\Requests;

use App\Models\Ingredient;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreIngredientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ingredient_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
