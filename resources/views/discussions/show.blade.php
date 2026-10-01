@extends('layouts.main')

@section('content')
    <div class="bg-neutral-900 min-h-screen text-gray-100 font-sans -mt-8 pt-8 pb-0">
        <div class="max-w-3xl mx-auto border border-neutral-150 min-h-screen relative flex flex-col">


            <div class="sticky top-0 z-50 bg-neutral-900 backdrop-blur-md px-6 py-4 border border-neutral-150 flex items-center gap-4">
                <a href="{{ route('discussions.index') }}" class="p-2 -ml-2 rounded-full hover:bg-neutral-800 transition text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h1 class="text-xl font-bold font-grobold">Topik Diskusi</h1>
            </div>


            <div class="p-6 border-b border-neutral-150  transition-colors">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        @php
                            $darkColors = ['1E293B', '312E81', '4C1D95', '701A75', '831843', '7F1D1D', '14532D', '083344'];
                            $colorIndex = abs(crc32($discussion->user->name)) % count($darkColors);
                            $bgColor = $darkColors[$colorIndex];
                        @endphp
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($discussion->user->name) }}&background={{ $bgColor }}&color=fff&size=48"
                             alt="{{ $discussion->user->name }}" class="w-12 h-12 rounded-full">
                        <div>
                            <div class="font-bold text-white text-lg">{{ $discussion->user->name }}</div>
                            <div class="text-gray-500 text-sm">{{ $discussion->created_at->format('d M Y, H:i') }}</div>
                        </div>
                    </div>
                    <span class="bg-neutral-900 text-gray-300 px-3 py-1 rounded-full border border-neutral-150 text-sm font-medium">
                        {{ $discussion->category->name }}
                    </span>
                </div>

                <h2 class="text-2xl font-bold text-white mb-4 leading-snug">{{ $discussion->title }}</h2>
                <div class="text-[17px] text-gray-300 mb-6">
                    {{ $discussion->content }}
                </div>

                @auth
                    <div class="flex items-center justify-end gap-3 mb-4">
                    @if(auth()->id() === $discussion->user_id  )

                            <!-- Tombol Edit: Hanya muncul jika umur diskusi belum melewati 15 menit -->
                            @if($discussion->created_at->diffInMinutes(now()) <= 15)
                                <a href="{{ route('discussions.edit', $discussion->id) }}"
                                   class="text-sm bg-neutral-900 hover:bg-neutral-950 border border-neutral-150 text-white font-medium py-1.5 px-5 rounded-full transition shadow-sm">
                                    Edit
                                </a>
                            @endif
                    @endif

                           @if(auth()->id() === $discussion->user_id || auth()->user()->role === 'admin')
                                <form action="{{ route('discussions.destroy', $discussion->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus diskusi ini secara permanen?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-sm bg-neutral-900 hover:bg-red-950 border border-neutral-150 text-white hover:text-red-400 font-medium py-1.5 px-5 rounded-full transition shadow-sm">
                                        Hapus
                                    </button>
                                </form>

                          @endif
                    </div>
                @endauth

                <!-- Statistik Bar -->
                <div class="flex items-center gap-6 text-gray-500 text-sm py-4 border-t border-neutral-900">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        <span class="font-medium text-gray-300">{{ $discussion->views_count }}</span> Tayangan
                    </span>
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        <span class="font-medium text-gray-300">{{ $replies->total() }}</span> Balasan
                    </span>
                </div>
            </div>

            <!-- Daftar Balasan -->
            <div class="flex-1 pb-4">
                @forelse ($replies as $reply)
                    <div class="p-6 border-b border-neutral-150 hover:bg-neutral-800 transition">
                        <div class="flex gap-4">
                            @php
                                $replyColorIndex = abs(crc32($reply->user->name)) % count($darkColors);
                                $replyBg = $darkColors[$replyColorIndex];
                            @endphp
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($reply->user->name) }}&background={{ $replyBg }}&color=fff&size=40"
                                 alt="{{ $reply->user->name }}" class="w-10 h-10 rounded-full shrink-0">

                            <div class="w-full">
                                <!-- Bagian Header Balasan (Disertai tombol hapus) -->
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-2 text-[15px]">
                                        <span class="font-bold text-white">{{ $reply->user->name }}</span>
                                        <span class="text-gray-500 text-sm">• {{ $reply->created_at->locale('id')->diffForHumans() }}</span>
                                    </div>

                                    <!-- Tombol Hapus Balasan -->
                                    @auth
                                        @if(auth()->id() === $reply->user_id)
                                            <form action="{{ route('replies.destroy', $reply->id) }}" method="POST" onsubmit="return confirm('Hapus balasan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs text-neutral-500 hover:text-red-500 transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>

                                <div class="text-gray-300 whitespace-pre-line leading-snug text-[15px]">{{ $reply->content }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16 text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        <p>Belum ada balasan.</p>
                    </div>
                @endforelse

                <div class="p-6">
                    {{ $replies->links() }}
                </div>
            </div>

            <!-- Form Balasan (Sticky Bawah) -->
            <div class="p-4 border-t border-neutral-150 bg-neutral-900 backdrop-blur-md sticky bottom-0 z-40">
                <form action="{{ route('replies.store', $discussion->id) }}" method="POST">
                    @csrf
                    <div class="flex items-end gap-3">
                        <textarea name="content" rows="1"
                                  class="w-full bg-neutral-900 border border-neutral-150 rounded-2xl py-3 px-4 text-white placeholder-gray-500 focus:outline-none focus:border-neutral-800 focus:ring-1 focus:ring-neutral-800 resize-none transition overflow-hidden [scrollbar-width:none] [&::-webkit-scrollbar]:hidden"
                                  placeholder="Tulis balasan..." required
                                  oninvalid="this.setCustomValidity('gabisa kosong!')"
                                  oninput="this.style.height = ''; this.style.height = Math.min(this.scrollHeight, 120) + 'px' ; this.style.overflow = this.scrollHeight > 120 ? 'auto' : 'hidden';"></textarea>

                        <button type="submit" class="bg-white hover:bg-gray-300 text-black p-3 rounded-full transition shrink-0 flex items-center justify-center shadow-md">
                            <svg class="w-6 h-6 transform rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
