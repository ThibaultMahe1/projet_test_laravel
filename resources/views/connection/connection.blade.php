@extends('layout.header')
@section('title')
    connection
@endsection
@section('content')
    <form action="/login" method="post">
        @csrf
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
        <input type="submit" value="connection">
    </form>
    @if(session('error'))
        <div style="color:red">{{ session('error') }}</div>
    @endif
    <a href="/cree">pas encore de compte</a>
    <a href="/">retour</a>
@endsection
