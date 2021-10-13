<div class="form-group">
    <label for="{{ $input_name }}">{{ $lable }}@if($required ?? null) <span class="required">*</span> @endif  </label>
    <select id="{{ $input_name }}" name="{{ $input_name }}"
     class="form-control {{ $class ?? null }} @if($required ?? null) required @endif" {{ $event ?? null }}>
    <option value="">Please Select</option>
    @if(empty($items))
    @else
        @foreach ($items as $item )
         <option value="{{ $item->id }}">{{ $item->$item_name }}</option>
        @endforeach
    @endif
    </select>
    <span class="text-danger error-text  {{ $input_name }}_error"></span>
</div>
@error('{{ $input_name}}')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
