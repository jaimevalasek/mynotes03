@extends('layouts.main')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <form method="POST" action="{{ route('note-items.update', [$note->id, $noteItem->id]) }}">
                    @method('PUT')
                    @include('notes.note-items._partials.form')
                </form>
            </div>
        </div>
    </div>
@endsection
