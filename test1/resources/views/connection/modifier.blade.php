@extends('layout.header')
@section('title')
    modification de compte
@endsection
@section('content')
<div class="contener">
    <form action="/Modification" method="post">
        @csrf
        <label for="">name :</label>
        <input type="text" name="name" id="" value="{{ Auth::user()->name }}">
        @error('lastname')
            <div style="color:red;">{{ $message }}</div>
        @enderror
        <label for="">e-mail :</label>
        <input type="text" name="email" id="" value="{{ Auth::user()->email }}">
        @error('email')
            <div style="color:red;">{{ $message }}</div>
        @enderror
        <label for="">mdp :</label>
        <input type="password" name="password" id="">
        @error('password')
            <div style="color:red;">{{ $message }}</div>
        @enderror
        <input type="submit" value="Modifier">
    </form>
</div>
<a href="/">retour</a>

@endsection
