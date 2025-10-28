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
        <x-input.input-text :object="$univers??null" proprietie="nom" />
        <x-input.input-textearea :object="$univers??null" proprietie="description" />
        <x-input.input-img :object="$univers??null" proprietie="img_fond" :type="$type" />
        <x-input.input-img :object="$univers??null" proprietie="logo" :type="$type" />

        <div class="d-flex">
            <x-input.input-color :object="$univers??null" proprietie="couleur_principal" :type="$type" />
            <x-input.input-color :object="$univers??null" proprietie="couleur_secondaire" :type="$type" />
        </div>

        <input type="submit" value="{{ $type=='edit' ? "modifier" : "ajouter" }}" class="btn btn-primary">

    </form>
</div>
@endsection
    