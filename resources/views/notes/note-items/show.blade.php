@extends('layouts.main')

@section('content')
<div class="container h-screen w-screen mx-auto flex items-center justify-center">
    <div class="flex flex-col bg-gray-700 shadow-lg shadow-gray-800 py-4 px-6 mx-4 rounded-md">
        <a href="{{ route('note-items.index', $noteItem->note_id) }}" type="button"
            class="bg-gray-800 inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 active:bg-gray-800 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-0 mb-12">
            Voltar
        </a>
        <div class="flex flex-row items-center">
            <div class="ml-4">
                <h3 class="text-indigo-100 font-semibold text-xl">{{ $noteItem->name }}</h3>
                <h4 class="text-indigo-300 pt-1">{{ $noteItem->description }}</h4>
            </div>
        </div>
    </div>
</div>
@endsection