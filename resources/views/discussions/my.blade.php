@extends('layouts.main')

@section('content')
<div class="bg-neutral-900 min-h-screen text-gray-100 font-sans -mt-8 pt-8 pb-0">
    <div class="max-w-3xl mx-auto border border-neutral-150 min-h-screen relative flex flex-col">

        <!-- Navbar Atas -->
        <div class="sticky top-0 z-50 bg-neutral-900 backdrop-blur-md px-6 py-4 border border-neutral-150 flex items-center gap-4">
            <a href="{{ route('discussions.index') }}" class="p-2 -ml-2 rounded-full hover:bg-neutral-800 transition text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-xl font-bold font-grobold">Topik Saya</h1>
        </div>

        <!-- Daftar Diskusi Pengguna -->
        <div class="flex-1">
            @forelse ($discussions as $discussion)
            <a href="{{ route('discussions.show', $discussion->id) }}" class="block p-6 border-b border-neutral-150 hover:bg-neutral-800 transition">
                <div class="flex items-center justify-between mb-2">
                        <span class="bg-neutral-900 text-gray-300 px-3 py-0.5 rounded-full border border-neutral-150 text-xs font-medium">
                            {{ $discussion->category->name }}
                        </span>
                    <span class="text-gray-500 text-xs">{{ $discussion->created_at->diffForHumans() }}</span>
                </div>

                <h2 class="text-lg font-bold text-white mb-2 leading-snug">{{ $discussion->title }}</h2>
                <p class="text-gray-400 text-sm line-clamp-2 mb-4">{{ $discussion->content }}</p>

                <div class="flex items-center gap-4 text-gray-500 text-xs">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            {{ $discussion->views_count }} Tayangan
                        </span>
                    <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            {{ $discussion->replies_count ?? $discussion->replies()->count() }} Balasan
                        </span>
                </div>
            </a>
            @empty
            <div class="text-center py-20 text-gray-500">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                <p class="text-base font-medium">Anda belum pernah membuat topik diskusi.</p>
                <a href="{{ route('discussions.create') }}" class="inline-block mt-4 text-sm text-white bg-neutral-800 hover:bg-neutral-700 border border-neutral-150 px-4 py-2 rounded-full transition">
                    Buat Diskusi Pertama
                </a>
            </div>
            @endforelse

            <div class="p-6">
                {{ $discussions->links() }}
            </div>
        </div>

    </div>
</div>
@endsection
