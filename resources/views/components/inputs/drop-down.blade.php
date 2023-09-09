<label class="form-label">{{ $label }}</label>
@php
   $value_list = [];

   $v = old($name, $value);

   $value_list = explode(",", $v);
@endphp
<select name="{{ $name }}" {{ $attributes->merge(['class' => 'form-control']) }}>
    @if (!$attributes->has('multiple'))    
        <option value="">Please Select</option>
    @endif
    @foreach($list as $k => $t)
        @php 
            $attr = in_array($k, $value_list) ? 'selected="selected"' : "";
        @endphp
        <option value="{{ $k }}" {!! $attr !!} >{{$t}}</option>
    @endforeach
</select>

@error($name)
    <div class="pristine-error text-help">{{ $message }}</div>
@enderror
