<table>
    @foreach($ingredients as $ingredient)
        <tr>
            <td><input {{ $ingredient->value ? 'checked' : null }} data-id="{{ $ingredient->id }}" type="checkbox" class="ingredient-enable"></td>
            <td>{{ $ingredient->name }}</td>
            <td><input value="{{ $ingredient->value ?? null }}" {{ $ingredient->value ? null : 'disabled' }} data-id="{{ $ingredient->id }}" name="ingredients[{{ $ingredient->id }}]" type="text" class="ingredient-amount form-control" placeholder="Amount"></td>
        </tr>
    @endforeach
</table>

@section('scripts')
    @parent
    <script>
        $('document').ready(function () {
            $('.ingredient-enable').on('click', function () {
                let id = $(this).attr('data-id')
                let enabled = $(this).is(":checked")
                $('.ingredient-amount[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.ingredient-amount[data-id="' + id + '"]').val(null)
            })
        });
    </script>
@endsection
