<label class="form-label">{{ $label }}</label>
<input value="{{ old($name, $value) }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'form-control']) }}  />
@error($name)
    <div class="pristine-error text-help">{{ $message }}</div>
@enderror
