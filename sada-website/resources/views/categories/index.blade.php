@extends('Layout.app')

@section('title', 'التصنيفات — صدى')

@section('content')
<div class="categories-page mx-auto max-w-[1320px] px-4 pb-24 pt-10 md:px-8">
    <header class="categories-heading">
        <p class="eyebrow">مكتبة صدى</p>
        <h1 class="mt-2 text-4xl font-black md:text-5xl">كلماتٌ لكل فكرة</h1>
        <p class="mt-4 max-w-2xl text-sm leading-8 text-white/65 md:text-base">تصفّح الاقتباسات حسب موضوعها، وابحث عن العبارة الأقرب إلى ما يشغل بالك.</p>
    </header>

    <nav class="category-jump-list" aria-label="انتقل إلى تصنيف">
        @foreach($categories as $index => $category)
            <a href="#category-{{ $index }}">{{ $category['name'] }} <span>({{ $quotesByCategory->get($category['name'], collect())->count() }})</span></a>
        @endforeach
    </nav>

    <div class="category-stories">
        @foreach($categories as $index => $category)
            @php($categoryQuotes = $quotesByCategory->get($category['name'], collect()))
            <section class="category-story" id="category-{{ $index }}" aria-labelledby="category-title-{{ $index }}">
                <div class="category-story-intro">
                    <figure class="category-story-art">
                        <img src="{{ asset($category['image']) }}" alt="{{ $category['alt'] }}" loading="lazy" width="720" height="420">
                    </figure>
                    <div class="category-story-copy">
                        <p class="eyebrow">التصنيف {{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</p>
                        <div class="category-story-title-row">
                            <h2 id="category-title-{{ $index }}">{{ $category['name'] }}</h2>
                            <span class="category-story-count">{{ $categoryQuotes->count() }} اقتباس</span>
                        </div>
                        <p class="category-story-description">{{ $category['description'] }}</p>
                        <blockquote class="category-story-message">«{{ $category['message'] }}»</blockquote>
                    </div>
                </div>

                <div class="category-story-quotes">
                    @forelse($categoryQuotes as $quote)
                        <article class="category-story-quote" id="quote-{{ $quote->id }}">
                            <span class="category-story-quote-mark" aria-hidden="true">“</span>
                            <blockquote dir="auto">{{ $quote->content }}</blockquote>
                            <p>— {{ $quote->author_name ?? $quote->user?->name ?? 'من المجتمع' }}</p>
                        </article>
                    @empty
                        <p class="category-story-empty">لا توجد اقتباسات في هذا التصنيف حتى الآن.</p>
                    @endforelse
                </div>

                <a class="category-story-link" href="{{ route('quotes.index', ['category' => $category['name']]) }}">تصفّح اقتباسات تصنيف {{ $category['name'] }} <span aria-hidden="true">←</span></a>
            </section>
        @endforeach
    </div>
</div>
@endsection
