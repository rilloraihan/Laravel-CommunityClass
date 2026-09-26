@extends('layouts.main')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row gap-6 pb-12">

        <div class="w-full md:w-3/4">
            <div class="bg-neutral-900 rounded-lg shadow-sm border border-neutral-150 p-6 flex flex-col gap-4">

                <div class="flex justify-between items-center border-b-neutral-150 rounded-lg pb-4">
                    <h3 class="text-lg  font-grobold font-bold text-white">Topik</h3>
                    <a href="{{ route('discussions.create') }}" class="bg-neutral-900 hover:bg-neutral-950 border-2 border-neutral-150 text-white  font-bold font-sans py-2 px-4 rounded-lg text-sm transition shadow-sm ">
                        Buat Diskusi
                    </a>
                </div>


                @forelse ($discussions as $discussion)
                    <div class="border border-neutral-150 rounded-lg p-4 hover:bg-neutral-800 hover:border-back-200 transition">
                        <a href="{{ route('discussions.show', $discussion->id) }}" class="text-l  font-sans font-normal text-white hover:text-gray-300  mb-1">
                            {{ $discussion->title }}
                        </a>

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
                            <span>{{ $discussion->created_at->diffForHumans() }}</span>
                            <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            {{ $discussion->views_count }} tayangan
                        </span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 text-gray-500 bg-gray-50 rounded-lg border border-dashed border-gray-300">
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
