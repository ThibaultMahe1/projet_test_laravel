@extends('layout.header')
@section('title')
    création d'univers
@endsection
@section('content')
<div class="contener">
    <form action="{{ route('univers.store') }}" method="post"  enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">nom :</label>
            <input type="text" name="nom" id="" class="form-control">
        </div>
        <div class="form-group">
            <label for="">description :</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="">image de fond :</label>
            <input type="file" name="img_fond" id="" class="form-control-file form-control">
        </div>
        <div class="form-group ">
            <label for="">logo :</label>
            <input type="file" name="logo" id="" class="form-control-file form-control">
        </div>
        <div class="d-flex">
            <div class="me-2 form-group form-control">
                <label for="">couleur primere :</label>
                <input type="color" name="couleur_principal" id="" class="form-control">
            </div>
            <div class="form-group form-control">
                <label for="">couleur secondaire :</label>
                <input type="color" name="couleur_secondaire" id="" class="form-control">
            </div>
        </div>
        <input type="submit" value="crée" class="btn btn-primary">
    </form>
</div>


@endsection
