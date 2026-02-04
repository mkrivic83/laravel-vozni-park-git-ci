@include('layouts.header')
<div class="max-w-6xl mx-auto py-10">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Početna</h1>
    </div>
    <div class="text-sm text-gray-500">
        Okolina: {{ app()->environment() }} |
        DB: {{ config('database.connections.mysql.database') }}
    </div>

    <div class="text-sm text-gray-500">
        Dobro došao na početnu stranicu i opet pokrenuo CI CD
    </div>

   
</div>
@include('layouts.footer')