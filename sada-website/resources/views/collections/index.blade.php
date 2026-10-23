@extends('Layout.app')

@section('title', 'مجموعاتي — صدى')

@section('content')
<div class="quotes-library-page mx-auto max-w-[1100px] px-4 pb-24 pt-10 md:px-8">
    <header class="quotes-library-heading">
        <p class="eyebrow">مساحتك الخاصة</p>
        <h1 class="mt-2 text-4xl font-black md:text-5xl">مجموعاتي</h1>
        <p class="mt-3 max-w-2xl text-sm leading-7 text-white/60 md:text-base">رتّب الاقتباسات التي تحفظها في مجموعات تناسب اهتماماتك.</p>
        <form method="POST" action="{{ route('collections.store') }}" class="mt-6 flex flex-wrap gap-2">@csrf
            <label class="sr-only" for="new-collection-name">اسم المجموعة</label>
            <input id="new-collection-name" class="input min-w-0 flex-1" name="name" required minlength="2" maxlength="80" placeholder="اسم مجموعة جديدة">
            <button class="btn-primary" type="submit">إنشاء مجموعة</button>
        </form>
    </header>

    <div class="mt-8 flex items-center justify-between gap-3">
        <h2 class="text-2xl font-black">مجموعاتك المحفوظة</h2>
        <a class="action-button" href="{{ route('favorites') }}">الاقتباسات المفضلة ←</a>
    </div>
    <div class="mt-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($collections as $collection)
            <a class="category-quote-tile block" href="{{ route('collections.show', $collection) }}">
                <span class="eyebrow">مجموعة اقتباسات</span>
                <h3 class="mt-3 text-xl font-bold">{{ $collection->name }}</h3>
                <p class="mt-2 text-sm text-white/55">{{ $collection->quotes_count }} اقتباس</p>
                <span class="mt-5 inline-flex text-sm font-bold text-violet-200">فتح المجموعة ←</span>
            </a>
        @empty
            <div class="panel col-span-full py-12 text-center">
                <p class="text-lg font-bold">ما أنشأت أي مجموعة بعد</p>
                <p class="mt-2 text-sm text-white/55">ابدأ مجموعة جديدة واحفظ فيها اقتباساتك المفضلة.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
