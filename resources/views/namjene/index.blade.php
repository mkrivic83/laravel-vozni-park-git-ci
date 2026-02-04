@include('layouts.header')
<div class="max-w-6xl mx-auto py-10">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Popis namjena</h1>
    </div>

    @if(session('status'))
        <div class="mb-4 rounded bg-green-50 p-3 text-green-700">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-white shadow rounded p-6">
        <table class="min-w-full border">
            <thead class="bg-gray-50">
            <tr>
                <th class="border px-3 py-2 text-left">ID</th>
                <th class="border px-3 py-2 text-left">Naziv</th>
                <th class="border px-3 py-2 text-left">Kreirana</th>
                <th class="border px-3 py-2 text-left">Ažurirana</th>
            </tr>
            </thead>
            <tbody>
            @foreach($namjene as $n)
                <tr>
                    <td class="border px-3 py-2">{{ $n->id }}</td>
                    <td class="border px-3 py-2">{{ $n->naziv }}</td>
                    <td class="border px-3 py-2">{{ $n->created_at->format('d.m.Y H:i:s') }}</td>
                    <td class="border px-3 py-2">{{ $n->updated_at->format('d.m.Y H:i:s') }}</td>                   
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</div>
@include('layouts.footer')