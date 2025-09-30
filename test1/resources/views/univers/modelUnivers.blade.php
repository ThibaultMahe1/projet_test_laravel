@extends('layout.header')
@section('title')
    {{ $type=='edit'? 'edit' : 'add' }}
@endsection
@section('content')
<div class="container">
    <form action="{{ $type=='edit' ? route('univers.update', $univers->id) : route('univers.store')}}" method="post"  enctype="multipart/form-data">
        @csrf
        @if ($type=='edit')
            @method('put')
        @endif
        <x-input.input-text :object="$univers" proprietie="nom" />
        <x-input.input-textearea :object="$univers" proprietie="description" />
        <x-input.input-img :object="$univers" proprietie="img_fond" :type="$type" />
        <x-input.input-img :object="$univers" proprietie="logo" :type="$type" />

        <div class="d-flex">
            <div class="me-2 form-control">
                <label for="color1">couleur primere :</label>
                <input type="color" name="couleur_principal" id="color1" value="{{ $univers->couleur_principal??'#000000' }}" class="form-control">
            </div>
            <div class="form-control">
                <label for="color2">couleur secondaire :</label>
                <input type="color" name="couleur_secondaire" id="color2" value="{{ $univers->couleur_secondaire??'#000000' }}" class="form-control">
            </div>
        </div>

        <input type="submit" value="{{ $type=='edit' ? "modifier" : "ajouter" }}" class="btn btn-primary">

    </form>
</div>
@endsection
