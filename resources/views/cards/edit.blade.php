@extends('layouts.app')
@section('content')
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold">Bewerk: {{ $card->name }}</h1>
        <form class="mt-6 space-y-4" method="POST" action="{{ route('cards.update',$card) }}">
            @csrf @method('PUT')
            @include('cards.partials.form', ['card' => $card])
            <button class="btn btn-primary">Bijwerken</button>
        </form>
    </div>
@endsection
