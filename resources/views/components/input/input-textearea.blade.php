@props([
    'proprietie',
    'object',
])

<div class="form-floating mb-3">
    <textarea name="{{ $proprietie }}" class="form-control" id="{{ $proprietie }}" placeholder="{{ $proprietie }}" style="height: 100px">{{ $object->description??null }}</textarea>
    <label for="{{ $proprietie }}">{{ $proprietie }} :</label>
</div>
