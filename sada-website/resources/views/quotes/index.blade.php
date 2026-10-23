@extends('Layout.app')

@section('title', 'الاقتباسات — صدى')

@section('content')
<div class="quotes-library-page mx-auto max-w-[1320px] px-4 pb-24 pt-10 md:px-8">
    <header class="quotes-library-heading">
        <p class="eyebrow">مكتبة صدى</p>
        <h1 class="mt-2 text-4xl font-black md:text-5xl">{{ request('sort') === 'trending' ? 'الأكثر تداولًا' : 'كل الاقتباسات' }}</h1>
        <p class="mt-3 max-w-2xl text-sm leading-7 text-white/60 md:text-base">تصفّح الكلمات الملهمة وابحث حسب العبارة أو تصنيفها.</p>
        @if($isTrending)<p class="trending-demo-note" role="note">الأرقام في هذه الصفحة تجريبية للعرض، ولا تمثل إعجابات أو تعليقات حقيقية.</p>@endif
    </header>

    <form id="quote-filters" method="GET" action="{{ route('quotes.index') }}" class="quotes-library-filters mt-7">
        <label class="sr-only" for="library-search">ابحث في الاقتباسات</label>
        <input class="input min-w-0 flex-1" id="library-search" type="search" name="q" value="{{ request('q') }}" placeholder="ابحث عن اقتباس أو كلمة…">
        @if(request('sort'))<input type="hidden" name="sort" value="{{ request('sort') }}">@endif
        <label class="sr-only" for="library-category">تصنيف الاقتباس</label>
        <select class="input md:max-w-48" id="library-category" name="category">
            <option value="">كل التصنيفات</option>
            @foreach($categories as $category)<option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>@endforeach
        </select>
        <button class="btn-primary" type="submit">بحث</button>
        @if(request()->hasAny(['q', 'category']))<a class="action-button" href="{{ route('quotes.index') }}">مسح الفلاتر</a>@endif
    </form>

    <div class="mt-7 flex flex-wrap items-center justify-between gap-3 text-sm text-white/55">
        <p>عرض {{ $isTrending ? $quotes->count() : $quotes->total() }} اقتباس @if($isTrending)<span class="text-violet-200">بترتيب تجريبي</span>@endif</p>
        <a class="text-violet-200 hover:text-amber-200" href="{{ route('home') }}">العودة للرئيسية ←</a>
    </div>

    <div class="mt-5 grid gap-5 lg:grid-cols-2">
        @forelse($quotes as $quote)
            <x-quote-card :quote="$quote" :collections="$collections" />
        @empty
            <div class="panel col-span-full py-16 text-center">
                <p class="text-xl font-bold">ما لقينا اقتباسات تطابق بحثك</p>
                <p class="mt-2 text-sm text-white/55">غيّر كلمة البحث أو اختر تصنيفًا آخر.</p>
                <a class="mt-5 inline-flex text-violet-200 underline" href="{{ route('quotes.index') }}">عرض كل الاقتباسات</a>
            </div>
        @endforelse
    </div>

    @unless($isTrending)<div class="mt-10">{{ $quotes->links() }}</div>@endunless
</div>
@endsection
