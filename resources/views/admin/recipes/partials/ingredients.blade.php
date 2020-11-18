<table>
    @foreach($ingredients as $ingredient)
        <tr x-data="{enabled: {{ $ingredient->value ? 'true' : 'false' }}, value: {{ $ingredient->value ?? 'null' }}}">
            <td>
                <input x-model="enabled" @change="value = null" type="checkbox">
            </td>
            <td @click="enabled = !enabled" style="cursor:pointer;">
                {{ $ingredient->name }}
            </td>
            <td>
                <input x-model="value" :disabled="!enabled" name="ingredients[{{ $ingredient->id }}]" type="text" class="form-control" placeholder="Amount">
            </td>
        </tr>
    @endforeach
</table>
