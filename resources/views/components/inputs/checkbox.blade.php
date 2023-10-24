<label class="form-check">
    @php
        $check = old($name, $value) ? 'checked="checked"' : '';
    @endphp
    <input type="hidden" name="{{ $name }}" value="0">
    <input type="checkbox" {{ $check }} name="{{ $name }}" value="1" {{ $attributes->merge(['class' => 'form-check-input']) }}>
    {{ $label }}
</label>