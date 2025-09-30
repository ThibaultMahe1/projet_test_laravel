@extends('layout.header')
@section('title')
    modification d'univers
@endsection
@section('content')
<div class="contener">
    <form action="{{ route('univers.update', $univers->id) }}" method="post"  enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="">nom :</label>
            <input type="text" name="nom" id="" value="{{ $univers->nom }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="">description :</label>
            <textarea name="description" class="form-control">{{ $univers->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="">image de fon :</label>
            <input type="file" name="img_fond" id="" class="form-control-file form-control">
            <img src="{{ asset('storage/'.$univers->img_fond) }}" alt="" style="width: 200px">
        </div>
        <div class="form-group">
            <label for="">logo :</label>
            <input type="file" name="logo" id="" class="form-control-file form-control">
            <img src="{{ asset('storage/'.$univers->logo) }}" alt="" style="width: 100px">
        </div>
        <div class="d-flex">
            <div class="me-2 form-control">
                <label for="color1">couleur primere :</label>
                <input type="color" name="couleur_principal" id="color1" value="{{ $univers->couleur_principal }}" class="form-control">
            </div>
            <div class="form-control">
                <label for="color2">couleur secondaire :</label>
                <input type="color" name="couleur_secondaire" id="color2" value="{{ $univers->couleur_secondaire }}" class="form-control">
            </div>
        </div>

        <input type="submit" value="modifier" class="btn btn-primary">

    </form>
</div>


@endsection
