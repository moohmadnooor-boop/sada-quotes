@extends('Layout.app')

@section('title', 'مصادر الاقتباسات')
@section('content')
<main class="relative mx-auto min-h-[70vh] max-w-[1500px] px-4 py-10 md:px-8">
    <section class="hero-section source-hero mb-8">
        <div class="max-w-3xl">
            <p class="eyebrow">مراجع صدى</p>
            <h1 class="mt-3 text-4xl font-black md:text-5xl">الكتب التي نعود إليها</h1>
            <p class="mt-4 max-w-2xl leading-8 text-white/65">تعرّف على الكتب التي نعود إليها، واقرأ نبذة مختصرة عن كل كتاب ومؤلفه، ثم افتح مصدره الأصلي.</p>
        </div>
        <div class="hero-art" aria-hidden="true"><div class="hero-glass"><span class="hero-star">⌘</span><p>كل عبارة لها حكاية ومصدر.</p><small>اقرأ النص من مرجعه</small></div></div>
    </section>

    @if ($sources->isEmpty())
        <section class="panel py-16 text-center">
            <h2 class="text-xl font-bold">لا توجد مصادر موثقة بعد</h2>
            <p class="mt-3 text-white/55">ستظهر هنا الكتب التي نضيف منها اقتباسات موثقة.</p>
        </section>
    @else
        <section class="source-shelf" aria-label="كتب الاقتباسات">
            @foreach ($sources as $source)
                <article class="panel source-book-card">
                    <img class="source-cover" src="{{ asset($source['cover']) }}" alt="غلاف {{ $source['title'] }} — {{ $source['author'] }}" loading="lazy">
                    <div class="source-book-copy">
                        <p class="eyebrow">كتاب موثق</p>
                        <h2 class="mt-2 text-xl font-black">{{ $source['title'] }}</h2>
                        <p class="mt-1 text-sm text-white/60">تأليف {{ $source['author'] }}</p>
                        <div class="mt-4 border-t border-white/10 pt-3">
                            <h3 class="text-sm font-bold text-emerald-100">نبذة عن الكتاب</h3>
                            <p class="mt-2 text-sm leading-7 text-white/75">{{ $source['synopsis'] }}</p>
                        </div>
                        <a class="btn-primary mt-4 inline-flex w-fit items-center gap-2 px-3 py-2 text-sm" href="{{ $source['url'] }}" target="_blank" rel="noopener noreferrer">افتح الكتاب الأصلي <span aria-hidden="true">↗</span></a>
                    </div>
                </article>
            @endforeach
        </section>
    @endif

    <p class="mt-5 text-xs leading-6 text-white/40">النصوص المعروضة محفوظة بلغتها الأصلية دون ترجمة أو تعديل.</p>
</main>
@endsection
