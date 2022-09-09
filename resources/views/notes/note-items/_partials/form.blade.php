<!-- Validation Errors -->
@include('includes.alerts')

@csrf

<!-- Name -->
<div class="flex items-center border-b border-teal-500 py-2">
    
    <label class="block font-medium text-sm text-gray-700" for="name">Name</label>

    <input
        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
        id="name" type="text" name="name" required="required" autofocus="autofocus" value="{{ $noteItem->name ?? old('name') }}">
</div>

<!-- Description -->
<div class="border-b border-teal-500 py-2">
    <label class="block font-medium text-sm text-gray-700" for="name">Description</label>

    <textarea
        class="block p-2.5 w-full text-sm text-gray-900 border-none bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 h-96"
        id="name" type="text" name="description" required="required">{{ $noteItem->description ?? old('description') }}</textarea>
</div>

<div class="flex items-center justify-end mt-4">
    <a href="{{ route('note-items.index', $note->id) }}" type="button"
        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">
        Cancelar
    </a>
    <button type="submit"
        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">
        Enviar
    </button>
</div>

@push('scripts')
<script>
    
</script>
@endpush