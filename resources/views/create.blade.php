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
            <label class="form-label">Titel</label>
            <input type="text" name="title" class="form-control" value="{{ $house->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Beschrijving</label>
            <textarea name="description" class="form-control" required>{{ $house->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="form-label">Oppervlakte in m²</label>
            <input type="text" name="surface_area" class="form-control" value="{{ $house->surface_area }}"required>
        </div>

        <div class="mb-3">
            <label for="form-label">Prijs per week in</label>
            €<input type="number" name="day_price" class="form-control" value="{{ $house->day_price }}"required>
        </div>

        @if ($house->id)
            <div class="mb-3">
                <label for="image">Afbeelding toevoegen</label>
                <input type="file"  class="form-control" id="image" name="afbeelding" />
            </div>
        @endif
        
        <div>
            @foreach ($photos as $photo)
                <div style="width:100px;height:100px;display:inline-block;">
                    <img width="100%" src="/images/{{ $house->id }}/{{ $photo->id  }}-{{ $photo->file_name  }}">
                    <a class="btn btn-secondary" style="margin-bottom:50px;background-color:red;" href="{{ route('destroy-image', ['house' => $house->id,'photo' => $photo->id]) }}"
                    >verwijderen</a>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Opslaan</button>       
    </form>
    <a href="{{ route('houses.index') }}" class="btn btn-secondary">Terug naar overzicht</a>

</div>
@endsection
<!-- INSERT INTO `houses` (`id`, `user_id`, `title`, `surface_area`, `day_price`, `description`,`) -->

