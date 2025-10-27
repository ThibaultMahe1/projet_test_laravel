@extends('layout.header')

@section('title')
    show
@endsection


@section('content')
    <div class="baniere" style="height: 200Px">
        <img src="{{ asset('storage/'.$univers->img_fond) }}" alt="" style="width:100%;max-height:100%">
        <div style="position: relative;top:-65%;right:-40%;width:200px;text-align:center;padding:4px;background-color:rgba(255, 255, 255, 0.5);border-radius:25px;box-shadow:
  3px 3px {{ $univers->couleur_principal }},
  -1em 0 0.4em {{ $univers->couleur_secondaire }};">
            <H2 style="opacity: 1;">{{ $univers->nom }}</H2>
        </div>
    </div>
    <div class="container">
        <div class="description" style="float: left;max-width: 50%;width:100%   ">
            <p style="max-width: 100%">{{ $univers->description }}</p>
            <p style="color: #2d3034;margin:0px">principal :</p>
            <div style="width: 100%;height:30px;background-color:{{ $univers->couleur_principal }};margin-bottom:4px;border-radius:10px">{{ $univers->couleur_principal }}</div>
            <p style="color: #2d3034;margin:0px">secondaire :</p>
            <div style="width: 100%;height:30px;background-color:{{ $univers->couleur_secondaire }};border-radius:10px">{{ $univers->couleur_secondaire }}</div>
        </div>
        <div class="droite" style="float: right;max-width: 50%" >
            <img src="{{ asset('storage/'.$univers->logo) }}" alt="" style="max-width: 100%">
        </div>

    </div>



@endsection
