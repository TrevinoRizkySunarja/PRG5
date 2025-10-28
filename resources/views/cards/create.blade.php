@extends('layouts.app')
@section('content')
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold">Nieuwe Pokémonkaart</h1>
        <form class="mt-6 space-y-4" method="POST" action="{{ route('cards.store') }}">
            @csrf
            @include('cards.partials.form', ['card' => null])
            <button class="btn btn-primary">Opslaan</button>
        </form>
    </div>
@endsection
