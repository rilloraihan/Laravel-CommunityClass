@extends('layouts.main')

@section('content')
    <div class="w-full max-w-3xl mx-auto mt-6">
        <div class="bg-neutral-900 border border-neutral-800 rounded-2xl p-6 shadow-sm">
            <h2 class="text-2xl font-bold text-white mb-6 font-grobold">Edit Topik</h2>

            <form action="{{ route('discussions.update', $discussion->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Judul Diskusi</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $discussion->title) }}" required autofocus
                           class="w-full bg-black border border-neutral-150 rounded-xl py-3 px-4 text-white placeholder-gray-600 focus:outline-none focus:border-neutral-800 focus:ring-2 focus:ring-neutral-800 transition"
                           placeholder="Apa yang ingin Anda diskusikan?">
                </div>

                <div class="mb-5">
                    <label for="category_id" class="block text-sm font-medium text-gray-300 mb-2">Kategori</label>
                    <select id="category_id" name="category_id" required
                            class="w-full bg-black border border-neutral-150 rounded-xl py-3 px-4 text-white focus:outline-none focus:ring-2 focus:border-neutral-800 focus:ring-neutral-800">
                        <option value="">Pilih Kategori</option>
                        <option value="1" {{ old('category_id', $discussion->category_id) == 1 ? 'selected' : '' }}>Info Malam</option>
                        <option value="2" {{ old('category_id', $discussion->category_id) == 2 ? 'selected' : '' }}>Info Matkul</option>
                        <option value="3" {{ old('category_id', $discussion->category_id) == 3 ? 'selected' : '' }}>BBB Sehat</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-300 mb-2">Isi Pesan</label>
                    <textarea id="content" name="content" rows="8" required
                              class="w-full bg-black border border-neutral-150 rounded-xl py-3 px-4 text-white placeholder-gray-600 focus:outline-none focus:border-neutral-800 focus:ring-2 focus:ring-neutral-800 transition resize-y"
                              placeholder="Tuliskan detail topik Anda di sini...">{{ old('content', $discussion->content) }}</textarea>
                </div>

                <div class="flex items-center justify-end gap-4 border-t border-neutral-800 pt-5">
                    <a href="{{ route('discussions.show', $discussion->id) }}" class="bg-neutral-900 hover:bg-neutral-950 border-neutral-150 border-2 text-white font-bold text-sm py-2.5 px-6 rounded-full transition shadow-md">
                        Batal
                    </a>
                    <button type="submit" class="bg-neutral-900 hover:bg-neutral-950 border-neutral-150 border-2 text-white font-bold py-2.5 px-6 rounded-full transition shadow-md">
                        Perbarui Diskusi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
