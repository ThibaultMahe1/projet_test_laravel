@extends('layout.header')

@section('title')
    index
@endsection


@section('content')
    <div class="container">
        <table class="table " style=" text-align:center;align-item:center">
            <tr style="background-color:#2d3034; ">
                <th scope="col" style='background:none;color:white;'>#</th>
                <th scope="col" style='background:none;color:white;'>{{ __('Name') }} :</th>
                <th scope="col" style='background:none;color:white;'>{{ __('color') }} :</th>
                <th scope="col" style='background:none;color:white;'>{{ __('description') }} :</th>
                <th scope="col" style='background:none;color:white;'>{{ __('logo') }} :</th>
                @if (Auth::check())
                    <th scope="col" style='background:none;color:white;'>{{ __('action') }} :</th>
                @endif
            </tr>
            @forelse ( $list as $univers )
            <tr>
                <td style='background:none;font-size:30px' scope="row">
                    <button class="favorite-btn" data-id="{{ $univers->id }}" style="background-color:none; border:none;">
                        <img src="{{ asset('storage/image/'.'favorite.svg') }}" alt="" style="width: 40px">

                    </button>
                    {{ $univers->id }}

                </td>
                <td style='background:none;font-size:30px'>
                <p>{{ $univers->nom }}</p>
                </td>
                <td style='background:none; color:white'>
                    <p style="color: #2d3034;margin:0px">{{ __('First') }} :</p>
                    <div style="width: 100%;height:30px;background-color:{{ $univers->couleur_principal }};margin-bottom:4px;border-radius:10px">{{ $univers->couleur_principal }}</div>
                    <p style="color: #2d3034;margin:0px">{{ __('Secondary') }} :</p>
                    <div style="width: 100%;height:30px;background-color:{{ $univers->couleur_secondaire }};border-radius:10px">{{ $univers->couleur_secondaire }}</div>
                </td>
                <td style='background:none'>
                    <p>{{ $univers->description }}</p>
                </td>
                <td style='background:none'>
                <img src="{{ asset('storage/'.$univers->logo) }}" alt="logo" title="logo" style="width: 100px; border-radius:25px">
                </td>
                @if (Auth::check())
                    <td>
                        <a type="button" class="btn btn-outline-info" href="{{ route('univers.show', compact('univers')) }}">{{ __('info') }}</a><br>
                        @can('modif-Univers')
                            <a type="button" class="btn btn-outline-success" href="{{ route('univers.edit', compact('univers')) }}">{{ __('modify') }}</a><br>
                        @endcan
                        @can('del-Univers')
                            <form action="{{ route('univers.destroy', compact('univers')) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-outline-danger" type="submit" value="{{ __('delete') }}">
                            </form>
                        @endcan
                    </td>
                @endif
            </tr>
            @empty
                        <tr>
                <td style='background:none;font-size:30px' scope="row"></td>
                <td style='background:none;font-size:30px'>
                <p>aucun univers a afficher</p>
                </td>
                <td style='background:none; color:white'>
                </td>
                <td style='background:none'>
                </td>
                <td style='background:none'>
                </td>
                <td>
                </td>
            </tr>
            @endforelse
        </table>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('.favorite-btn').click(function(){
        let universId = $(this).data('id');
        let button = $(this);
        let image = button.find('img');

        $.ajax({
            url: "{{ route('favorites.toggle') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                univers_id: universId
            },
            success: function(response){
                if(response.status === 'added'){
                    image.attr('src', "{{ asset('storage/image/favorite_toggle.svg') }}");
                } else {
                    image.attr('src', "{{ asset('storage/image/favorite.svg') }}");
                }
            }
        });
    });
});
</script>
