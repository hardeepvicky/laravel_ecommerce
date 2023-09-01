<label class="form-label">{{ $label }}</label>
<input class="form-control {{ $cssClassName }}" type="{{ $type }}" value="{{ old($name, $value) }}" name="{{ $name }}" placeholder="{{ $placeholder }}" />
@error($name)
    <div class="pristine-error text-help">{{ $message }}</div>
@enderror
