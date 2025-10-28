@props([
    'proprietie',
    'object',
])

<div class="form-floating mb-3">
    <input type="text" name="{{ $proprietie }}" id="{{ $proprietie }}" value="{{ $object->nom??null }}" class="form-control" placeholder="{{ $proprietie }}">
    <label for="{{ $proprietie }}">{{ $proprietie }} :</label>
</div>
