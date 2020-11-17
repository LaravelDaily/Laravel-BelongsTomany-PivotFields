<?php

namespace App\Http\Requests;

use App\Models\Recipe;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRecipeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('recipe_edit');
    }

    public function rules()
    {
        return [
            'name'          => [
                'string',
                'required',
            ],
            'ingredients.*' => [
                'integer',
            ],
            'ingredients'   => [
                'required',
                'array',
            ],
        ];
    }
}
