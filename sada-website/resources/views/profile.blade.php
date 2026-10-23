@extends('Layout.app')

@section('title', 'الملف الشخصي — '.$user->name)
@section('content')
<div class="mx-auto max-w-5xl space-y-8 px-4 py-10">
    @if(session('status'))<p class="notice" role="status">{{ session('status') }}</p>@endif
    <section class="profile-cover" style="--profile-cover-image: url('{{ asset('images/profile-cover.svg') }}')">
        <div class="flex flex-wrap items-start justify-between gap-5"><div class="flex items-center gap-4"><span class="grid h-16 w-16 place-items-center rounded-2xl bg-white/15 text-3xl font-black">{{ mb_substr($user->name, 0, 1) }}</span><div><p class="eyebrow">ملف الكاتب</p><h1 class="mt-1 text-3xl font-black">{{ $user->name }}</h1><p class="mt-1 text-sm text-white/55">انضم {{ $user->created_at->translatedFormat('F Y') }}</p></div></div>
        @auth @if(auth()->id() === $user->id)<button class="btn-ghost" type="button" data-open-profile-edit>تعديل الملف</button>@else<form method="POST" action="{{ route('profile.follow', $user) }}">@csrf<button class="btn-primary">{{ $isFollowing ? 'إلغاء المتابعة' : 'متابعة' }}</button></form>@endif @endauth
        </div>
        @if($user->bio)<p class="mt-5 max-w-2xl leading-7 text-white/75">{{ $user->bio }}</p>@else<p class="mt-5 text-sm text-white/45">لم يضف نبذة بعد.</p>@endif
        <div class="mt-6 flex flex-wrap gap-5 text-sm"><span><b>{{ $user->quotes_count }}</b> اقتباس</span><span><b>{{ $user->followers_count }}</b> متابع</span><span><b>{{ $user->following_count }}</b> يتابع</span></div>
    </section>
    @if($user->id === auth()->id())
    <dialog id="profile-dialog" class="site-dialog"><form method="POST" action="{{ route('profile.update') }}" class="space-y-4">@csrf @method('PUT')<div class="flex justify-between"><h2 class="text-xl font-bold">تعديل ملفك</h2><button type="button" class="dialog-close" data-close-dialog>×</button></div><label class="field-label">الاسم<input class="input mt-2" name="name" value="{{ $user->name }}" required maxlength="60"></label><label class="field-label">نبذة<textarea class="input mt-2" name="bio" rows="4" maxlength="300">{{ $user->bio }}</textarea></label><button class="btn-primary w-full">حفظ</button></form></dialog>
    @endif
    <section><div class="mb-5"><p class="eyebrow">مساهمات المجتمع</p><h2 class="mt-1 text-2xl font-bold">اقتباسات {{ $user->name }}</h2></div><div class="space-y-5">@forelse($quotes as $quote)<x-quote-card :quote="$quote" :collections="$collections" />@empty<div class="panel text-center text-white/55">لا توجد اقتباسات حتى الآن.</div>@endforelse</div><div class="mt-6">{{ $quotes->links() }}</div></section>
</div>
@endsection
