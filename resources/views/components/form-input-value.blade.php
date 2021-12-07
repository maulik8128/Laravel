<div class="form-group">
    <label for="{{ $input_name }}">{{ $lable }}@if($required ?? null) <span class="required">*</span> @endif  </label>
    <input id="{{ $input_name }}" type="text" name="{{ $input_name }}" class="form-control @if($required ?? null) required @endif"
     value="{{ old("$input_name", $input_name_value ?? null) }}" {{$validation ?? null }}>
    <span class="text-danger error-text  {{ $input_name }}_error"></span>
</div>
@error('{{ $input_name}}')
<div class="alert alert-danger">{{ $message }}</div>
@enderror

