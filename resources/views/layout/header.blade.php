<!DOCTYPE html>
<html lang="fr">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<header class="p-3 mb-2 text-white bg-dark row row-cols-lg-auto g-3 align-items-center">
    <h1 class="col-md-6">{{ __('welcome') }} {{ Auth::user()->name??null }}</h1>
    <menu >
        <div class="dropdown col-md-6">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            menu
        </a>

        <ul class="dropdown-menu " aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="/">home</a></li>
            @if (Auth::check())
            @can('creat-Univers')

                <li><a class="dropdown-item" href="{{ route("univers.create") }}">crée un univers</a></li>
            @endcan
            @endif
            <li><hr class="dropdown-divider"></li>
            @if (Auth::check())
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Modifier mon compte</a></li>
                <li><a class="dropdown-item" href="/logout">déconnection</a></li>
            @else
                <li><a class="dropdown-item" href="/login">Connection</a></li>
                <li><a class="dropdown-item" href="/register">Crée un compte</a></li>
            @endif
        </ul>
    </menu>
    <menu>
</div>
        <div class="dropdown col-md-6">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            langue
        </a>

        <ul class="dropdown-menu " aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="/lang/fr">francais</a></li>
            <li><a class="dropdown-item" href="/lang/en">anglais</a></li>
        </ul>

</div>
    </menu>
    <form action="{{ route('send.mail') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-primary">mail</button>
    </form>
</header>
<body>
    @if(session('status'))
        <div class="container mt-3"><div class="alert alert-success">{{ session('status') }}</div></div>
    @endif
    @if(session('error'))
        <div class="container mt-3"><div class="alert alert-danger">{{ session('error') }}</div></div>
    @endif
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
