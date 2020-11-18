<?php

namespace App\Http\Requests;

use App\Models\Recipe;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRecipeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('recipe_create');
    }

    public function rules()
    {
        return [
            'name'          => [
                'string',
                'required',
            ],
            'ingredients.*' => [
                'string',
            ],
            'ingredients'   => [
                'required',
                'array',
            ],
        ];
    }
}
