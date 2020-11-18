@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.recipe.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.recipes.update", [$recipe->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.recipe.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $recipe->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.recipe.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ingredients">{{ trans('cruds.recipe.fields.ingredients') }}</label>

                @include('admin.recipes.partials.ingredients')

                @if($errors->has('ingredients'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ingredients') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.recipe.fields.ingredients_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
