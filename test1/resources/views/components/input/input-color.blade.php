@props([
    'proprietie',
    'object',
    'type',
])

<div class="mb-3 me-2 form-control">
    <label for="{{ $proprietie }}">{{ $proprietie }} :</label>
    <input type="color" name="{{ $proprietie }}" id="{{ $proprietie }}" value="{{ $object->$proprietie ??'#000000' }}" class="form-control">
</div>
