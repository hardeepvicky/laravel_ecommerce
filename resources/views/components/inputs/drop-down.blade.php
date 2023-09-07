<label class="form-label">{{ $label }}</label>
@php
   $v = old($name, $value);
@endphp
<select name="{{ $name }}" {{ $attributes->merge(['class' => 'form-control']) }}>
    <option value="">Please Select</option>
    @foreach($list as $k => $t)
        <option value="{{ $k }}" {{ $v == $k ? 'selected="true"' : '' }} >{{$t}}</option>
    @endforeach
</select>

@error($name)
    <div class="pristine-error text-help">{{ $message }}</div>
@enderror
