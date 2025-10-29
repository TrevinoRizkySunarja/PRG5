<x-layout title="Rarities">
    <div class="table-wrap">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th><th>Naam</th><th>Rank</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rarities as $r)
                <tr>
                    <td>#{{ $r->id }}</td>
                    <td class="font-semibold">{{ $r->name }}</td>
                    <td>{{ $r->rank }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
