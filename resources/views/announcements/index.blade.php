@extends('layouts.main')

@section('content')
    <div class="bg-neutral-900 min-h-screen text-gray-100 font-sans -mt-8 pt-8 pb-0">
        <div class="max-w-3xl mx-auto border border-neutral-150 min-h-screen relative flex flex-col">


            <div class="sticky top-0 z-50 bg-neutral-900 backdrop-blur-md px-6 py-4 border-b border-neutral-150 flex items-center justify-between">
                <h1 class="text-xl font-bold font-grobold text-white">Pengumuman Resmi</h1>


                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('announcements.create') }}" class="text-sm bg-white text-black font-bold py-1.5 px-4 rounded-full hover:bg-gray-200 transition">
                            + Buat Baru
                        </a>
                    @endif
                @endauth
                @if (session('success'))
                    <div class="m-6 mb-0 p-4 bg-emerald-950/50 border border-emerald-800 text-emerald-300 rounded-xl text-sm">
                        {{ session('success') }}
                    </div>
                @endif
            </div>


            <div class="flex-1">
                @forelse ($announcements as $announcement)

                    <div class="p-6 border-b border-neutral-150 {{ $announcement->pinned ? 'bg-neutral-800/30' : '' }}">


                        <div class="flex items-center gap-3 mb-4">

                            <div class="w-10 h-10 rounded-full bg-neutral-800 border border-neutral-150 flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr($announcement->user->name, 0, 2)) }}
                            </div>

                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <h3 class="font-bold text-white text-sm">{{ $announcement->user->name }}</h3>

                                    @if($announcement->user->role === 'admin')
                                        <span class="bg-emerald-900/30 text-emerald-400 text-[10px] px-2 py-0.5 rounded-lg border border-emerald-800">Admin</span>
                                    @endif
                                </div>
                                <span class="text-gray-500 text-xs">{{ $announcement->created_at->diffForHumans() }}</span>
                            </div>


                            @if($announcement->pinned)
                                <div class="text-emerald-400 flex items-center gap-1.5 bg-emerald-950/20 px-3 py-1 rounded-full border border-emerald-900/50">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path></svg>
                                    <span class="text-xs font-medium">Disematkan</span>
                                </div>
                            @endif
                        </div>


                        <h2 class="text-xl font-bold text-white mb-3 leading-snug">{{ $announcement->title }}</h2>
                        <div class="text-gray-300 text-sm whitespace-pre-line leading-relaxed">
                            {{ $announcement->content }}


                        </div>
                        @auth
                            @if(auth()->user()->role === 'admin')

                                <div class="mt-4 pt-4 border-t border-neutral-800 flex items-center justify-end gap-3">


                                    <a href="{{ route('announcements.edit', $announcement->id) }}"
                                       class="inline-block text-sm bg-neutral-900 hover:bg-neutral-950 border border-neutral-150 text-white font-medium py-1.5 px-5 rounded-full transition shadow-sm text-center">
                                        Edit
                                    </a>


                                    <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini secara permanen?');" class="m-0 p-0 inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-block text-sm bg-neutral-900 hover:bg-red-950 border border-neutral-150 text-white hover:text-red-400 font-medium py-1.5 px-5 rounded-full transition shadow-sm text-center">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            @endif
                        @endauth

                    </div>
                @empty

                    <div class="text-center py-24 text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                        <p class="text-base font-medium">Belum ada pengumuman resmi saat ini.</p>
                    </div>
                @endforelse


                @if($announcements->hasPages())
                    <div class="p-6 border-t border-neutral-150">
                        {{ $announcements->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
