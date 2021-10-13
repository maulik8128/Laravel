<form action="{{ $route}}" method="POST" class="isautovalid {{ $class ?? null }}" id="{{ $formId }}" enctype="multipart/form-data">
    @csrf

    {{ empty(trim($slot))?'': $slot }}

    <div><input type="submit" value="{{ $submit_name }}" id="{{ $submit_btn_id }}" class="btn btn-primary"></div>
</form>
