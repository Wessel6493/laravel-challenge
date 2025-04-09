<style>
    .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

form {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.form-label {
    font-weight: bold;
}

input[type="text"],
input[type="number"],
textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ced4da;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 10px;
    margin-top: 15px;
    border: none;
    border-radius: 5px;
    background: #007bff;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
}

button:hover {
    background: #0056b3;
}

.btn-secondary {
    display: block;
    text-align: center;
    padding: 10px;
    background: #6c757d;
    color: white;
    text-decoration: none;
    margin-top: 10px;
    border-radius: 5px;
    transition: background 0.3s;
}

.btn-secondary:hover {
    background: #5a6268;
}

div[style*="display: flex"] {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    padding: 10px;
    border: 1px solid red;
    border-radius: 5px;
    margin-top: 10px;
}

div[style*="width:100px"] {
    position: relative;
    overflow: hidden;
}

img {
    width: 100%;
    height: auto;
    border-radius: 5px;
}

a {
    display: block;
    margin-top: 5px;
    text-align: center;
    color: red;
    font-weight: bold;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

a[href*="edit"] {
    display: inline-block;
    padding: 2px 5px;
    background-color:rgb(255, 217, 0); 
    color: black;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    text-align: center;
    transition: background-color 0.3s;
}

a[href*="edit"]:hover {
    background-color: #0056b3; 
}

a#destroy {
    display: inline-block;
    padding: 2px 5px;
    background-color: #dc3545; 
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    text-align: center;
    transition: background-color 0.3s ease;
}


a#destroy:hover {
    background-color:rgb(115, 115, 115); 
     
}

</style>
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Huizen Overzicht</h2>

    @if(isset($houses) && $houses->count() > 0)        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titel</th>
                    <th>Oppervlakte (m²)</th>
                    <th>Prijs per week (€)</th>
                    <th>Beschrijving</th>
                    <th>wijzigen</th>
                    <th>verwijderen</th>
                    <th>afbeeldingen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($houses as $house)
                    <tr>
                        <td>{{ $house->id }}</td>
                        <td>
                            <a href="{{ route('houses.show', [ 'id' => $house->id]) }}">
                            {{ $house->title }}
                            </a>
                        </td>
                        </td>
                        <td>{{ $house->surface_area }} m²</td>
                        <td>€ {{ number_format($house->day_price, 2, ',', '.') }}</td>
                        <td>{{ $house->description }}</td>
                        <td><a href="{{ route('houses.edit', [ 'id' => $house->id]) }}">wijzigen</></td>
                        <td><a id="destroy" href="{{ route('destroy-house', [ 'id' => $house->id]) }} ">verwijderen</></td>
                        <td> 
                            <div style="max-width: 300px;">
                            @foreach ($house->getPhotos() as $photo)
                                <img style="width:100px" src="/images/{{ $house->id }}/{{ $photo->id  }}-{{ $photo->file_name  }}">
                            @endforeach
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Er zijn geen huizen om weer te geven.</p>
    @endif
</div>
@endsection