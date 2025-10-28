@props([
    'proprietie',
    'object',
    'type',
])

<div class="form-group row mb-3">
    <div class="col">
        <label for="">{{ $proprietie }} :</label>
        <input type="file" name="{{ $proprietie }}" id="{{ $proprietie }}" class="form-control-file form-control">
    </div>
    <div class="col">
        @if ($type=='edit')
        <img src="{{ asset('storage/'.$object->$proprietie) }}" alt="{{ $proprietie }}" style="width: 200px">
        @endif

    </div>

</div>
