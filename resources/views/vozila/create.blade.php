<!doctype html>
<html lang="hr">
<head>
    <meta charset="utf-8">
    <title>Dodaj vozilo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
@include('layouts.navigation')
<div class="max-w-xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">Dodaj novo vozilo</h1>

    <div class="bg-white shadow rounded p-6">
        <form method="POST" action="{{ route('vozila.store') }}">
            @csrf

            {{-- Naziv --}}
            <div class="mb-4">
                <label class="block font-medium">Naziv</label>
                <input type="text" name="naziv"
                       class="mt-1 w-full border rounded px-3 py-2"
                       value="{{ old('naziv') }}">
                @error('naziv') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Tip --}}
            <div class="mb-4">
                <label class="block font-medium">Tip</label>
                <input type="text" name="tip"
                       class="mt-1 w-full border rounded px-3 py-2"
                       value="{{ old('tip') }}">
                @error('tip') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Motor --}}
            <div class="mb-4">
                <label class="block font-medium">Motor</label>
                <input type="text" name="motor"
                       class="mt-1 w-full border rounded px-3 py-2"
                       value="{{ old('motor') }}">
                @error('motor') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Registracija --}}
            <div class="mb-4">
                <label class="block font-medium">Registracija</label>
                <input type="text" name="registracija"
                       class="mt-1 w-full border rounded px-3 py-2"
                       value="{{ old('registracija') }}">
                @error('registracija') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Istek --}}
            <div class="mb-4">
                <label class="block font-medium">Istek registracije</label>
                <input type="date" name="istek_registracije"
                       class="mt-1 w-full border rounded px-3 py-2"
                       value="{{ old('istek_registracije') }}">
                @error('istek_registracije') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Namjena --}}
            <div class="mb-6">
                <label class="block font-medium">Namjena</label>
                <select name="namjenaid"
                        class="mt-1 w-full border rounded px-3 py-2">
                    <option value="">-- Odaberi --</option>
                    @foreach($namjene as $n)
                        <option value="{{ $n->id }}"
                            @selected(old('namjenaid') == $n->id)>
                            {{ $n->naziv }}
                        </option>
                    @endforeach
                </select>
                @error('namjenaid') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('vozila.index') }}"
                   class="px-4 py-2 border rounded hover:bg-gray-100">
                    Odustani
                </a>

                <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Spremi
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>