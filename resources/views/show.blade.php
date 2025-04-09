<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@extends('layouts.app') 

@section('content')
<div class="container">

    @if ($house->id)
        <h1>Wijzig {{ $house->title }}</h1>
    @else
        <h1>Nieuw huis aanmaken</h1>
    @endif

    <form action="{{ route('store-house') }}" enctype="multipart/form-data" method="POST">
        @csrf

        <input type="hidden" name="id" value="{{ $house->id }}" />
        <div class="mb-3">
            <label class="form-label">Titel:</label>
            {{ $house->title }}
        
        </div>

        <div class="mb-3">
            <label class="form-label">Beschrijving:</label>
            {{ $house->description }}
        </div>

        <div class="mb-3">
            <label for="form-label">Oppervlakte:</label>
            {{ $house->surface_area }}  m²
        </div>

        <div class="mb-3">
            <label for="form-label">Prijs per week:</label>
            € {{ $house->day_price }}
        </div>

        <!-- @if ($house->id)
            <div class="mb-3">
                <label for="image">Afbeelding toevoegen</label>
                <input type="file"  class="form-control" id="image" name="afbeelding" />
            </div>
        @endif -->
        
        <div>
        <label class="form-label">Afbeeldingen:</label>
        <br>
            @foreach ($photos as $photo)
                <div style="width:100px;height:100px;display:inline-block;">
                    <img width="100%" src="/images/{{ $house->id }}/{{ $photo->id  }}-{{ $photo->file_name  }}">
                    <!-- <a href="{{ route('destroy-image', ['house' => $house->id,'photo' => $photo->id]) }}"
                    >verwijderen</a> -->
                </div>
            @endforeach
        </div>
        <a href="{{ route('houses.index') }}" class="btn btn-secondary">Terug naar overzicht</a>      
    </form>
    

</div>
@endsection
<!-- INSERT INTO `houses` (`id`, `user_id`, `title`, `surface_area`, `day_price`, `description`,`) -->

