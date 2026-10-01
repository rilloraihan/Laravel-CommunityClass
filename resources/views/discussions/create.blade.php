@extends('layouts.main')

@section('content')
    <div class="w-full max-w-3xl mx-auto mt-6">
        <div class="bg-neutral-900 border border-neutral-800 rounded-2xl p-6 shadow-sm">
            <h2 class="text-2xl font-bold text-white mb-6 font-grobold">Buat Topik Baru</h2>


            <form action="{{ route('discussions.store') }}" method="POST">
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-950/50 border border-red-900 text-red-400 rounded-xl text-sm">
                        <strong class="font-bold mb-2 block">Terjadi kesalahan:</strong>
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @csrf


                <div class="mb-5">
                    <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Judul Diskusi</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required autofocus
                           class="w-full bg-black border border-neutral-150  rounded-xl py-3 px-4 text-white placeholder-gray-600 focus:outline-none focus:border-neutral-800 focus:ring-2 focus:ring-neutral-800 transition"
                           placeholder="Apa yang ingin Anda diskusikan?">
                </div>

                <div class="mb-5">
                    <label for="category_id" class="block text-sm font-medium text-gray-300 mb-2">Kategori</label>
                    <select id="category_id" name="category_id" required
                            class="w-full bg-black border border-neutral-150 rounded-xl py-3 px-4 text-white focus:outline-none focus:ring-2 focus:border-neutral-800 focus:ring-neutral-800">
                        <option value="">Pilih Kategori</option>
                        <option value="1">Umum</option>
                        <option value="2">Materi Kuliah</option>
                        <option value="3">Info Malam</option>
                    </select>
                </div>


                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-300 mb-2">Isi Pesan</label>
                    <textarea id="content" name="content" rows="8" required
                              class="w-full bg-black border border-neutral-150 rounded-xl py-3 px-4 text-white placeholder-gray-600 focus:outline-none focus:border-neutral-800 focus:ring-2 focus:ring-neutral-800 transition resize-y"
                              placeholder="Tuliskan detail topik Anda di sini..."></textarea>
                </div>


                <div class="flex items-center justify-end gap-4 border-t border-neutral-800 pt-5">
                    <a href="{{ route('discussions.index') }}" class="bg-neutral-900 hover:bg-neutral-950 border-neutral-150 border-2 text-white font-bold text-sm px-3 rounded-full transition shadow-md">
                        Batal
                    </a>
                    <button type="submit" class="bg-neutral-900 hover:bg-neutral-950 border-neutral-150 border-2 text-white font-bold py-2.5 px-6 rounded-full transition shadow-md">
                        Tayangkan Diskusi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
