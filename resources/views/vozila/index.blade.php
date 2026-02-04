@include('layouts.header')
<div class="max-w-6xl mx-auto py-10">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Popis vozila</h1>
        <a href="{{ route('vozila.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + Novo vozilo
        </a>
    </div>

    @if(session('status'))
        <div class="mb-4 rounded bg-green-50 p-3 text-green-700">
            {{ session('status') }}
        </div>
    @endif

    <div class="bg-white shadow rounded p-6">
        <table class="min-w-full border">
            <thead class="bg-blue-600 text-white px-4 py-2 text-left">
            <tr>
                <th class="border px-3 py-2 text-left">ID</th>
                <th class="border px-3 py-2 text-left">Naziv</th>
                <th class="border px-3 py-2 text-left">Tip</th>
                <th class="border px-3 py-2 text-left">Motor</th>
                <th class="border px-3 py-2 text-left">Registracija</th>
                <th class="border px-3 py-2 text-left">Istek</th>
                <th class="border px-3 py-2 text-left">Ostalo</th>
                <th class="border px-3 py-2 text-left">Namjena</th>
                <th class="border px-3 py-2 text-left">Kreirano</th>
                <th class="border px-3 py-2 text-left">Ažurirano</th>
                <th class="border px-3 py-2 text-left">Akcije</th>
            </tr>
            </thead>
            <tbody>
            @foreach($vozila as $v)
                <tr>
                    <td class="border px-3 py-2">{{ $v->id }}</td>
                    <td class="border px-3 py-2">{{ $v->naziv }}</td>
                    <td class="border px-3 py-2">{{ $v->tip }}</td>
                    <td class="border px-3 py-2">{{ $v->motor }}</td>
                    <td class="border px-3 py-2">{{ $v->registracija }}</td>
                    <td class="border px-3 py-2">{{ $v->istek_registracije->format('d.m.Y') }}</td>
                    <td class="border px-3 py-2">
                        {{ ceil(now()->diffInDays($v->istek_registracije, false)) }} dana
                    </td>
                    <td class="border px-3 py-2">{{ $v->namjena?->naziv ?? '—' }}</td>
                    <td class="border px-3 py-2">{{ $v->created_at->format('d.m.Y H:i:s') }}</td>
                    <td class="border px-3 py-2">{{ $v->updated_at->format('d.m.Y H:i:s') }}</td>
                    <td class="border px-3 py-2">
                        <a class="text-blue-600 hover:underline mr-3"
                           href="{{ route('vozila.edit', $v) }}">Uredi</a>

                        <form method="POST" action="{{ route('vozila.destroy', $v) }}"
                              class="inline"
                              onsubmit="return confirm('Obrisati vozilo?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Briši</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-6 flex justify-center">
                    {{ $vozila->links() }}
        </div>
    </div>

</div>
@include('layouts.footer')