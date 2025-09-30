@extends('layout.header')

@section('title')
    index
@endsection


@section('content')
    <div>
        <table class="table ">
            <tr style="background-color:#2d3034; ">
                <th scope="col" style='background:none;color:white;'>#</th>
                <th scope="col" style='background:none;color:white;'>nom :</th>
                <th scope="col" style='background:none;color:white;'>description :</th>
                <th scope="col" style='background:none;color:white;'>logo :</th>
                <th scope="col" style='background:none;color:white;'>action :</th>
            </tr>
            @foreach ( $list as $univers )
            <tr style='background-image:url({{ asset('storage/'.$univers->img_fond) }});background-size: contain;background-repeat: no-repeat;opacity:0.6;'>
                <td style='background:none;font-size:30px' scope="row">{{ $univers->id }}</td>
                <td style='background:none;font-size:30px'>
                <p style='color:{!! $univers->couleur_principal !!};-webkit-text-stroke: 1px {!! $univers->couleur_secondaire !!};'>{{ $univers->nom }}</p>
                </td>
                <td style='background:none'>
                    <p>{{ $univers->description }}</p>
                </td>
                <td style='background:none'>
                <img src="{{ asset('storage/'.$univers->logo) }}" alt="logo" title="logo" style="width: 100px; border-radius:25px">
                </td>
                <td>
                    <a type="button" class="btn btn-outline-success" href="{{ route('univers.edit', compact('univers')) }}">modifier</a><br>
                    <form action="{{ route('univers.destroy', compact('univers')) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-outline-danger" type="submit" value="supprimer">
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection

