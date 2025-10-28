@extends('layout.header')
@section('title')
    création de compte
@endsection
@section('content')
<div class="contener">
    <form action="/creat" method="post">
        @csrf
        <label for="">name :</label>
        <input type="text" name="name" id="">
        @error('lastname')
            <div style="color:red;">{{ $message }}</div>
        @enderror
        <label for="">e-mail :</label>
        <input type="text" name="email" id="">
        @error('email')
            <div style="color:red;">{{ $message }}</div>
        @enderror
        <label for="">mdp :</label>
        <input type="password" name="password" id="">
        @error('password')
            <div style="color:red;">{{ $message }}</div>
        @enderror
        <input type="submit" value="crée">
    </form>
</div>
<a href="/connection">j'ai deja un compte</a>
<a href="/">retour</a>

@endsection
