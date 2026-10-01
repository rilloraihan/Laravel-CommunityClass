@extends('layouts.main')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row gap-6 pb-12">

        <div class="w-full md:w-3/4">
            <div class="bg-neutral-900 rounded-lg shadow-sm border border-neutral-150 p-6 flex flex-col gap-4">
                @if(isset($latestAnnouncement) && $latestAnnouncement)
                    <div class="mb-5 bg-emerald-950/20 border border-emerald-900/50 rounded-lg p-3 flex flex-col sm:flex-row sm:items-center justify-between gap-3 shadow-sm">

                        <div class="flex items-center gap-3 overflow-hidden">
                            <!-- Label Kecil -->
                            <span class="flex-shrink-0 bg-emerald-900/50 text-emerald-400 text-[10px] font-bold px-2 py-0.5 rounded border border-emerald-800/50 uppercase tracking-wider">
                Pengumuman
            </span>

                            <!-- Judul & Sedikit Cuplikan Isi -->
                            <div class="flex items-center text-sm text-gray-300 min-w-0 flex-1">
                                <strong class="text-white mr-2 flex-shrink-0">{{ $latestAnnouncement->title }}</strong>
                                <span class="hidden sm:block border-l border-gray-600 pl-2 truncate">
                    {{ $latestAnnouncement->content }}
                </span>
                            </div>
                        </div>

                        <!-- Tautan Aksi -->
                        <a href="{{ route('announcements.index') }}" class="flex-shrink-0 text-xs text-emerald-400 hover:text-emerald-300 font-medium whitespace-nowrap flex items-center gap-1 transition">
                            Lihat semua
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>

                    </div>
                @endif
                <div class="flex justify-between items-center border-b-neutral-150 rounded-lg pb-4">
                    <h3 class="text-lg  font-grobold font-bold text-white">Topik</h3>
                    <a href="{{ route('discussions.create') }}" class="bg-neutral-900 hover:bg-neutral-950 border-2 border-neutral-150 text-white  font-bold font-sans py-2 px-4 rounded-lg text-sm transition shadow-sm ">
                        Buat Diskusi
                    </a>
                </div>


                @forelse ($discussions as $discussion)
                    <a href="{{ route('discussions.show', $discussion->id) }}" class="block border border-neutral-150 rounded-lg p-4 hover:bg-neutral-800 hover:border-neutral-500 transition cursor-pointer">
                        <h3 class="text-lg font-sans font-normal text-white mb-1">
                            {{ $discussion->title }}
                        </h3>
                        <div class="flex flex-wrap items-center text-xs text-gray-500 gap-3">
                        <span class="font-medium text-gray-700 flex items-center gap-2">

                            @php
                                $darkColors = ['1E293B', '312E81', '4C1D95', '701A75', '831843', '7F1D1D', '14532D', '083344'];
                                $colorIndex = abs(crc32($discussion->user->name)) % count($darkColors);
                                $bgColor = $darkColors[$colorIndex];
                            @endphp

                            <img src="https://ui-avatars.com/api/?name={{ urlencode($discussion->user->name) }}&background={{ $bgColor }}&color=fff&size=32"
                            alt="{{ $discussion->user->name }}"
                            class="w-5 h-5 rounded-full object-cover shadow-sm">


                            {{ $discussion->user->name }}
                        </span>
                            <span class="bg-back-200 font-sans text-gray-400 px-2.5 py-0.5 rounded-full border border-neutral-150">{{ $discussion->category->name }}</span>
                            <span>{{ $discussion->created_at->locale('id')->diffForHumans() }}</span>
                            <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            {{ $discussion->replies_count ?? $discussion->replies()->count() }} Balasan
                        </span>
                        </div>
                    </a>
                @empty
                    <div class="text-center py-12 text-gray-500 bg-neutral-900 rounded-lg border  border-neutral-150">
                        <p>Belum ada topik diskusi di kategori ini.</p>
                    </div>
                @endforelse


                <div class="mt-6">
                    {{ $discussions->links() }}
                </div>

            </div>
        </div>


        <div class="w-full md:w-1/4">
            <div class="bg-neutral-900 rounded-lg shadow-sm border border-gray-600 p-6 sticky top-6 ">
                <h3 class=" font-grobold text-white mb-4 pb-2 border-b">Filter Kategori</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('discussions.index') }}" class="text-sm flex items-center justify-between font-sans text-white hover:text-gray-300  transition">
                            Semua Kategori
                        </a>
                    </li>
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('discussions.index', ['category' => $category->slug]) }}" class="text-sm flex items-center justify-between text-white font-sans hover:text-gray-300 transition">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
@endsection
