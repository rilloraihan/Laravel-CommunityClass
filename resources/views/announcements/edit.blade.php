@extends('layouts.main')

@section('content')
    <div class="bg-neutral-900 min-h-screen text-gray-100 font-sans -mt-8 pt-8 pb-12">
        <div class="max-w-2xl mx-auto border border-neutral-150 rounded-2xl p-8 relative flex flex-col bg-neutral-900 shadow-sm">

            <!-- Header -->
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-neutral-800">
                <div>
                    <h1 class="text-2xl font-bold font-grobold text-white">Buat Pengumuman</h1>
                    <p class="text-gray-400 text-sm mt-1">Terbitkan informasi resmi untuk seluruh anggota komunitas.</p>
                </div>
                <a href="{{ route('announcements.index') }}" class="text-sm bg-neutral-800 hover:bg-neutral-700 text-white py-2 px-4 rounded-full transition border border-neutral-150">
                    Batal
                </a>
            </div>

            <!-- Formulir -->
            <form action="{{ route('announcements.update',$announcement->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Judul Pengumuman -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Judul Pengumuman</label>
                    <input type="text" id="title" name="title" value="{{ old('title',$announcement->title) }}" required autofocus placeholder="Contoh: Jadwal Ujian Tengah Semester..."
                           class="w-full bg-black border border-neutral-150 rounded-xl py-3 px-4 text-white placeholder-gray-600 focus:outline-none focus:border-neutral-800 focus:ring-2 focus:ring-neutral-800 transition">
                    @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <label for="content" class="block text-sm font-medium text-gray-300 mb-2">Isi Pengumuman</label>
                    <textarea id="content" name="content" rows="6" required placeholder="Tulis rincian informasi di sini..."
                              class="w-full bg-black border border-neutral-150 rounded-xl py-3 px-4 text-white placeholder-gray-600 focus:outline-none focus:border-neutral-800 focus:ring-2 focus:ring-neutral-800 transition resize-y">{{ old('content',$announcement->content) }}</textarea>
                    @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Opsi Sematkan (Pin) -->
                <div class="flex items-center gap-3 p-4 bg-black border border-neutral-150 rounded-xl">
                    <input type="checkbox" id="pinned" name="pinned" value="1" {{ old('pinned',$announcement->pinned) ? 'checked' : '' }}
                    class="w-5 h-5 text-neutral-800 bg-neutral-900 border-neutral-150 rounded focus:ring-neutral-800 focus:ring-2 cursor-pointer transition">
                    <label for="pinned" class="text-sm text-gray-300 cursor-pointer select-none">
                        <span class="font-bold text-white block">Sematkan Pengumuman (Pin)</span>
                        Tampilkan pengumuman ini di posisi paling atas halaman.
                    </label>
                </div>

                <!-- Tombol Submit -->
                <div class="flex items-center justify-end pt-4 border-t border-neutral-800">
                    <button type="submit" class="bg-white hover:bg-gray-200 text-black font-bold py-2.5 px-6 rounded-full transition shadow-md text-sm">
                        Terbitkan Pengumuman
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
