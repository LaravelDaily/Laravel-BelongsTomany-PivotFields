<?php

namespace App\Http\Requests;

use App\Models\Recipe;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRecipeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('recipe_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:recipes,id',
        ];
    }
}
