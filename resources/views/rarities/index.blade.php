<x-app-layout>
@extends('layouts.app')
@section('content')
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold">Rarities</h1>

        @if(session('status'))<div class="mt-2 text-green-700">{{ session('status') }}</div>@endif

        <ul class="mt-4 space-y-2">
            @foreach($rarities as $r)
                <li class="border rounded p-3 flex justify-between">
                    <span>{{ $r->name }} @if(!is_null($r->rank))<span class="text-gray-500">(rank {{ $r->rank }})</span>@endif</span>
                </li>
            @endforeach
        </ul>

        @if(auth()->user()->role)
            <form method="POST" action="{{ route('rarities.store') }}" class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-3">
                @csrf
                <input name="name" class="border rounded p-2" placeholder="Naam" required>
                <input name="rank" class="border rounded p-2" type="number" min="0" placeholder="Rank (optioneel)">
                <button class="btn btn-primary">Toevoegen</button>
            </form>
        @endif
    </div>
@endsection
</x-app-layout>
