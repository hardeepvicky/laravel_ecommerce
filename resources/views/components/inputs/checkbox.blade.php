<label class="form-check">
    @php
        $check = old($name, $value) ? 'checked="checked"' : '';
    @endphp
    <input type="checkbox" {{ $check }} name="{{ $name }}" value="1" {{ $attributes->merge(['class' => 'form-check-input']) }}>
    {{ $label }}
</label>