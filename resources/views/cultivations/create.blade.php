@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-center">
        <h2 class="text-2xl font-bold mb-6">CREAR NUEVA PUBLICACIÓN</h2>
    </div>
    <form method="POST" action="{{ route('cultivations.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Título</label>
            <input type="text" name="cropTitle" class="w-full px-4 py-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Contenido</label>
            <textarea name="cropContent" id="editor" class="w-full px-4 py-2 border rounded" rows="6"></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Categoría</label>
            <select name="idCategory" class="w-full px-4 py-2 border rounded">
                <option value="">-- Sin categoría --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->categoryName }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex justify-center">
           <button type="submit" class="text-2xl font-bold mb-6">
              GUARDAR
           </button>
        </div> 
    </form>
</div>
@endsection

@section('scripts')
<!-- Incluye TinyMCE desde CDN -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#editor',
        plugins: 'image link lists',
        toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright | image link | bullist numlist',
        height: 300
    });
</script>
@endsection

