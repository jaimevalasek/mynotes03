@extends('layouts.main')

@section('content')
<section class="text-gray-600 body-font">
    <form action="/" method="GET">
        <div class="container px-2 py-2 mx-auto">
            <div class="flex flex-wrap md:text-left text-center order-first">
                <div class="lg:w-1/3 md:w-1/2 w-full px-4">
                    <div class="flex xl:flex-nowrap md:flex-nowrap lg:flex-wrap flex-wrap justify-center items-end md:justify-start">
                            <div class="relative w-40 sm:w-auto xl:mr-4 lg:mr-0 sm:mr-4 mr-2">
                                <label for="footer-field" class="leading-7 text-sm text-gray-600">Campo de busca</label>
                                <input type="text" id="search" name="search" value="{{ request()->search }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:bg-transparent focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                            <button type="submit" class="lg:mt-2 xl:mt-0 flex-shrink-0 inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Button</button>
                        </div>        
                    </div>
                </div>
            </div>
        </form>
        <div class="container px-4 py-2.5 mx-auto">
            @forelse ($notes as $note)
                <div class="flex flex-wrap -m-4">
                    <div class="p-4 md:w-full">
                        <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-5 sm:flex-row flex-col  bg-slate-200">
                            <div class="flex-grow">
                                <h2 class="text-gray-900 text-lg title-font font-medium mb-2">{{ $note->name }}</h2>
                                <p class="leading-relaxed text-base">{{ $note->description }}</p>
                                <a class="mt-3 text-indigo-500 inline-flex items-center">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($note->noteItems as $noteItem)
                <div class="p-2">
                    <div class="h-full border border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                        <div class="p-6">
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-1">{{ $noteItem->name }}</h1>
                            <p class="leading-relaxed mb-1"><pre>{{ $noteItem->description }}</pre></p>
                        </div>
                    </div>
                </div>
                @endforeach
            @empty
            <h2>nenhum registro</h2>
            @endforelse
        </div>
    </section>
@endsection
