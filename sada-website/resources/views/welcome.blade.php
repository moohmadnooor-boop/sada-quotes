@extends('Layout.app')

@section('title', 'اقتباسات تلهم يومك')
@section('content')
<div class="ambient-orb ambient-one" aria-hidden="true"></div><div class="ambient-orb ambient-two" aria-hidden="true"></div>
<div class="home-page relative mx-auto max-w-[1320px] px-4 pb-24 pt-10 md:px-8">
    @if (session('status'))<p class="notice mt-6" role="status">{{ session('status') }}</p>@endif
    @if ($errors->any())<div class="notice notice-error mt-6" role="alert">{{ $errors->first() }}</div>@endif

    <section class="home-hero-panel" data-parallax aria-labelledby="home-title">
        <div class="home-hero-copy">
            <p class="eyebrow">صدى · مساحة للكلمات التي تلهم</p>
            <h1 id="home-title">كلمة واحدة<br><span>قد تغيّر يومك.</span></h1>
            <p>اكتشف اقتباسات من الكتب والأدب، واحفظ ما يلامس قلبك أو شاركه مع الآخرين.</p>
            <div class="home-hero-actions"><a class="btn-primary" href="#discover">اكتشف اقتباسات اليوم <span aria-hidden="true">←</span></a>@auth<button class="btn-ghost" type="button" data-open-quote>شارك كلمة تلهمك</button>@else<a class="btn-ghost" href="{{ route('signup') }}">شارك كلمة تلهمك</a>@endauth</div>
        </div>
        <div class="home-hero-art" aria-hidden="true">
            <svg class="storybook-art" viewBox="0 0 420 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="215" cy="154" r="122" fill="#A5F0D7" fill-opacity=".08"/>
                <path d="M210 104C177 70 150 67 126 77V184C154 174 181 180 210 208V104Z" fill="#FFD77A" stroke="#FFF0BE" stroke-width="4" stroke-linejoin="round"/>
                <path d="M210 104C243 70 270 67 294 77V184C266 174 239 180 210 208V104Z" fill="#FFE8A2" stroke="#FFF0BE" stroke-width="4" stroke-linejoin="round"/>
                <path d="M210 105V209" stroke="#DBA94E" stroke-width="4"/>
                <path d="M143 101C163 98 181 104 194 117M143 122C164 119 181 125 194 138M143 143C163 141 180 147 194 159M277 101C257 98 239 104 226 117M277 122C256 119 239 125 226 138M277 143C257 141 240 147 226 159" stroke="#D8A94C" stroke-width="3" stroke-linecap="round"/>
                <path class="storybook-sprout" d="M210 98C205 72 211 48 230 31M217 66C196 58 184 46 181 32C198 33 211 41 220 55M222 49C227 31 241 22 258 22C256 39 245 51 226 57" stroke="#A5F0D7" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M319 65C321 83 333 94 351 96C333 98 321 109 319 127C317 109 305 98 287 96C305 94 317 83 319 65Z" fill="#FF9A78"/>
                <path d="M102 91C104 103 112 111 124 113C112 115 104 123 102 135C100 123 92 115 80 113C92 111 100 103 102 91Z" fill="#FFC77A"/>
                <circle cx="299" cy="174" r="20" fill="#FFC77A"/><circle cx="308" cy="166" r="20" fill="#24574E"/>
                <circle cx="145" cy="45" r="3" fill="#FFE8A2"/><circle cx="337" cy="145" r="3" fill="#A5F0D7"/><circle cx="75" cy="156" r="3" fill="#FF9A78"/>
            </svg>
            <div class="storybook-note"><span>ابدأ من هنا</span><b>اكتشف كلمة تلهمك</b></div>
        </div>
    </section>

    <section class="quote-film" aria-labelledby="quote-film-title">
        <div class="quote-film-copy">
            <p class="eyebrow">حبرٌ عربي، وأثرٌ يبقى</p>
            <h2 id="quote-film-title">حين تتحوّل الكلمات إلى فن.</h2>
            <p>شاهد فن الخط العربي وهو يرسم الحروف، واستلهم عبارةً تترك أثرًا في يومك.</p>
            <a class="quote-film-link" href="{{ route('quotes.index') }}">اكتشف الكلمات التي تستحق أن تبقى <span aria-hidden="true">←</span></a>
        </div>
        <div class="quote-film-frame">
            <video class="quote-film-video" autoplay muted loop playsinline controls preload="metadata" aria-label="فنان يكتب الخط العربي بالحبر">
                <source src="https://videos.pexels.com/video-files/32771503/13969880_3840_2160_30fps.mp4" type="video/mp4">
                متصفحك لا يدعم تشغيل الفيديو.
            </video>
            <blockquote class="quote-film-caption" dir="rtl">«بعض الكلمات تُكتب بالحبر، وأخرى تُكتب فينا.»</blockquote>
        </div>
    </section>

    <section class="about-site-panel mt-8" aria-labelledby="about-site-title">
        <div class="about-site-intro">
            <p class="eyebrow">فكرة صدى</p>
            <h2 id="about-site-title" class="mt-2 text-2xl font-black md:text-3xl">الكلمات الجميلة تستحق أن تجد طريقها إليك</h2>
            <p class="mt-4 max-w-2xl text-sm leading-7 text-white/70 md:text-base">صدى مساحة تجمع اقتباسات الكتب والأدب في مكان واحد. ابحث عن عبارة تناسب شعورك، تعرّف على مصدرها، واحتفظ بالكلمات التي تحبها أو شاركها مع مجتمع يقدّر المعنى.</p>
        </div>
        <div class="about-goals" aria-label="مميزات الموقع">
            <article class="about-goal"><span aria-hidden="true">٠١</span><div><h3>اكتشف بسهولة</h3><p>ابدأ من تصنيف يعبّر عن الفكرة التي تبحث عنها.</p></div></article>
            <article class="about-goal"><span aria-hidden="true">٠٢</span><div><h3>احتفظ بما تحب</h3><p>اجمع اقتباساتك المفضلة في مكان واحد.</p></div></article>
            <article class="about-goal"><span aria-hidden="true">٠٣</span><div><h3>شارك الإلهام</h3><p>أضف كلماتك وشاركها مع مجتمع صدى.</p></div></article>
        </div>
    </section>

    <section class="home-discover mt-8" id="discover" aria-labelledby="discover-title">
        <div class="home-discover-heading"><p class="eyebrow">اكتشف ما يلهمك</p><h2 id="discover-title">ابحث في الاقتباسات</h2><span>{{ $quoteCount }} اقتباس</span></div>
        <form method="GET" action="{{ route('quotes.index') }}" class="home-search-form">
            <label class="sr-only" for="quote-search">ابحث عن اقتباس أو كاتب أو موضوع</label><input id="quote-search" type="search" name="q" value="{{ request('q') }}" placeholder="ابحث عن فكرة، كاتب، أو موضوع…">
            @if(request('sort'))<input type="hidden" name="sort" value="{{ request('sort') }}">@endif
            <button type="submit">بحث</button>
        </form>
        <details class="home-search-options" @if(request('category')) open @endif>
            <summary>تصفّح حسب تصنيف الاقتباس</summary>
            <form method="GET" action="{{ route('quotes.index') }}" class="home-search-selects">
                @if(request('q'))<input type="hidden" name="q" value="{{ request('q') }}">@endif @if(request('sort'))<input type="hidden" name="sort" value="{{ request('sort') }}">@endif
                <label class="sr-only" for="category-filter">تصنيف الاقتباس</label><select id="category-filter" class="input" name="category"><option value="">كل التصنيفات</option>@foreach($categories as $category)<option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>@endforeach</select>
                <button class="btn-primary" type="submit">تطبيق</button>
            </form>
        </details>
    </section>

    <section class="home-highlights mt-8 grid gap-6 lg:grid-cols-[1.1fr_.9fr]">
        <article class="daily-panel">
            <div class="flex items-center justify-between gap-3"><span class="eyebrow">اقتباس اليوم</span><span class="text-xs text-white/45">{{ now()->translatedFormat('l، j F') }}</span></div>
            @if ($dailyQuote)
                <blockquote class="mt-5 text-2xl font-bold leading-relaxed" dir="auto">“{{ $dailyQuote->content }}”</blockquote>
                <p class="mt-3 text-sm text-white/55">— {{ $dailyQuote->author_name ?? $dailyQuote->user?->name ?? 'من المجتمع' }}@if($dailyQuote->source_title)<span class="mr-2">· {{ $dailyQuote->source_title }}</span>@endif</p>
                <button class="mt-5 action-button" type="button" data-share-featured="{{ $dailyQuote->content }}" data-author-featured="{{ $dailyQuote->author_name ?? $dailyQuote->user?->name ?? 'صدى' }}">مشاركة اقتباس اليوم</button>
            @else
                <p class="mt-5 text-white/65">كن أول من يشارك اقتباسًا ليظهر هنا.</p>
            @endif
        </article>
        <article class="challenge-panel">
            <div class="flex items-center gap-3"><span class="challenge-icon">✦</span><div><p class="eyebrow">تحدي اليوم</p><h2 class="mt-1 text-xl font-bold">{{ $challenge }}</h2></div></div>
            @auth<button class="mt-5 rounded-xl bg-white/15 px-4 py-2 font-bold transition hover:bg-white/20" type="button" data-open-challenge>شارك في التحدي</button>@else<a class="mt-5 inline-block rounded-xl bg-white/15 px-4 py-2 font-bold transition hover:bg-white/20" href="{{ route('login') }}">سجّل لتشارك</a>@endauth
        </article>
    </section>

    <section class="category-highlights mt-14" aria-labelledby="category-highlights-title">
        <div class="mb-6 flex flex-wrap items-end justify-between gap-4">
            <div><p class="eyebrow">مختارات صدى</p><h2 id="category-highlights-title" class="mt-2 text-3xl font-black">اقتباس من كل تصنيف</h2><p class="mt-2 text-sm text-white/55">كلمات مختارة من اهتمامات وموضوعات متنوعة.</p></div>
            <a class="action-button" href="{{ route('categories.index') }}">تصفّح كل التصنيفات ←</a>
        </div>
        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
            @foreach($categories as $category)
                @php($categoryQuote = $categoryHighlights->get($category))
                <article class="category-quote-tile">
                    <div class="flex items-center justify-between gap-3"><span class="tag">{{ $category }}</span><span class="category-quote-mark" aria-hidden="true">“</span></div>
                    @if($categoryQuote)
                        <blockquote class="mt-3 text-lg font-bold leading-8" dir="auto">{{ $categoryQuote->content }}</blockquote>
                        <p class="mt-4 text-sm text-white/50">— {{ $categoryQuote->author_name ?? $categoryQuote->user?->name ?? 'من المجتمع' }}</p>
                    @else
                        <p class="mt-3 text-sm leading-7 text-white/55">سيظهر هنا اقتباس جديد من هذا التصنيف قريبًا.</p>
                    @endif
                    <a class="mt-5 inline-flex text-sm font-bold text-violet-200 hover:text-amber-200" href="{{ route('quotes.index', ['category' => $category]) }}">اقتباسات {{ $category }} ←</a>
                </article>
            @endforeach
        </div>
    </section>

</div>

@auth
<dialog id="quote-dialog" class="site-dialog"><form method="POST" action="{{ route('quotes.store') }}" class="space-y-4">@csrf
    <div class="flex items-start justify-between gap-4"><div><p class="eyebrow">شارك ما يلهمك</p><h2 class="mt-1 text-2xl font-bold">أضف اقتباسًا</h2></div><button type="button" class="dialog-close" data-close-dialog aria-label="إغلاق">×</button></div>
    <label class="field-label">الاقتباس<textarea class="input mt-2 min-h-32" name="content" required minlength="3" maxlength="500" placeholder="اكتب الكلمات التي تود مشاركتها"></textarea></label>
    <label class="field-label">تصنيف الاقتباس<select class="input mt-2" name="category">@foreach($categories as $category)<option value="{{ $category }}">{{ $category }}</option>@endforeach</select></label>
    <label class="field-label">المصدر أو صاحب العبارة <span class="text-white/40">(اختياري)</span><input class="input mt-2" name="source" maxlength="180" placeholder="مثال: اسم الكاتب أو الكتاب"></label>
    @if(request('challenge'))<input type="hidden" name="challenge" value="1">@endif
    <label class="flex items-center gap-2 text-sm text-white/75"><input type="checkbox" name="challenge" value="1" class="accent-emerald-200"> هذه مشاركتي في تحدي اليوم</label>
    <button class="btn-primary w-full" type="submit">نشر الاقتباس</button>
</form></dialog>
@endauth

<dialog id="card-dialog" class="site-dialog card-dialog"><div class="space-y-4"><div class="flex items-start justify-between"><div><p class="eyebrow">بطاقة اقتباس</p><h2 class="mt-1 text-2xl font-bold">صمّمها وشاركها</h2></div><button type="button" class="dialog-close" data-close-dialog aria-label="إغلاق">×</button></div><div id="card-preview" class="card-preview"><p id="card-preview-text" dir="auto"></p><span id="card-preview-author"></span></div><label class="field-label">لون البطاقة<select id="card-theme" class="input mt-2"><option value="violet">بنفسجي ليلي</option><option value="sunset">غروب</option><option value="mint">نعناع</option><option value="sand">رملي</option></select></label><button type="button" class="btn-primary w-full" id="download-card">تنزيل الصورة</button></div></dialog>
@endsection
