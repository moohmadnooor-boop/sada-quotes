@props(['quote', 'collections' => null])
<article class="quote-card group" data-quote-card data-content="{{ $quote->content }}" data-author="{{ $quote->author_name ?? $quote->user?->name ?? 'صدى' }}" data-url="{{ route('home') }}#quote-{{ $quote->id }}">
    <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        @if ($quote->author_name)
            <div class="flex items-center gap-3">
                <span class="avatar">{{ mb_substr($quote->author_name, 0, 1) }}</span>
                <span><span class="block font-bold">{{ $quote->author_name }}</span><span class="text-xs text-white/45">{{ $quote->source_title }}</span></span>
            </div>
        @else
            <a href="{{ route('profile', $quote->user) }}" class="flex items-center gap-3 hover:text-emerald-100">
                <span class="avatar">{{ mb_substr($quote->user?->name ?? 'ص', 0, 1) }}</span>
                <span><span class="block font-bold">{{ $quote->user?->name ?? 'صدى' }}</span><span class="text-xs text-white/45">{{ $quote->created_at->diffForHumans() }}</span></span>
            </a>
        @endif
        <div class="flex flex-wrap items-center gap-2">
            @if ($quote->category !== 'خاص بالمشاعر')<span class="tag">{{ $quote->category }}</span>@endif
            @if (isset($quote->demo_likes_count))<span class="tag tag-muted">رواج تجريبي {{ number_format($quote->demo_likes_count) }}</span>@endif
        </div>
    </div>

    <blockquote id="quote-{{ $quote->id }}" class="quote-copy" dir="auto">“{{ $quote->content }}”</blockquote>
    @if ($quote->source_url)
        <p class="mt-3 text-sm text-white/50">{{ $quote->source === 'ترجمة عربية عن النص الأصلي' ? 'ترجمة عربية عن:' : 'النص الأصلي:' }}
            <a class="text-emerald-100 underline underline-offset-4" href="{{ $quote->source_url }}" target="_blank" rel="noopener noreferrer">{{ $quote->source_title }} — {{ $quote->source }}</a>
        </p>
    @elseif ($quote->source)<p class="mt-3 text-sm text-white/50">المصدر: <span class="text-white/70">{{ $quote->source }}</span></p>@endif
    @if ($quote->challenge_on)<p class="mt-3 inline-flex rounded-full bg-violet-400/10 px-3 py-1 text-xs text-violet-200">مشاركة تحدي اليوم</p>@endif

    <div class="mt-5 flex flex-wrap items-center gap-2 border-t border-white/10 pt-4">
        @auth
            <form method="POST" action="{{ route('quotes.like', $quote) }}">@csrf<button class="action-button {{ $quote->is_liked ?? false ? 'action-active' : '' }}" type="submit" aria-label="إعجاب">♥ <span>{{ $quote->likes_count ?? 0 }}</span></button></form>
            <form method="POST" action="{{ route('quotes.favorite', $quote) }}">@csrf<button class="action-button {{ $quote->is_favorite ?? false ? 'action-active' : '' }}" type="submit" aria-label="حفظ الاقتباس">☆ حفظ</button></form>
            @if ($collections && $collections->isNotEmpty())
                <form method="POST" action="{{ route('quotes.collections', $quote) }}" class="flex items-center gap-1">@csrf<select name="collection_id" class="select-small" aria-label="أضف إلى مجموعة">@foreach ($collections as $collection)<option value="{{ $collection->id }}">{{ $collection->name }}</option>@endforeach</select><button class="action-button" type="submit">＋ مجموعة</button></form>
            @endif
        @else
            <a class="action-button" href="{{ route('login') }}">♥ {{ $quote->likes_count ?? 0 }} · سجّل للتفاعل</a>
        @endauth
        <button class="action-button" type="button" data-share-quote>مشاركة</button>
        <button class="action-button" type="button" data-card-quote>تصميم بطاقة</button>
        <button class="action-button" type="button" data-copy-link>نسخ الرابط</button>
        @auth
            <details class="relative mr-auto"><summary class="action-button list-none cursor-pointer">المزيد</summary><div class="absolute left-0 z-20 mt-2 w-52 rounded-2xl border border-white/10 bg-[#211b31] p-3 shadow-xl"><form method="POST" action="{{ route('quotes.report', $quote) }}" class="space-y-2">@csrf<input name="reason" maxlength="180" required class="input !py-2 text-xs" placeholder="سبب الإبلاغ"><button class="text-xs text-emerald-100" type="submit">إرسال بلاغ</button></form>
                @if (auth()->id() === $quote->user_id)
                    <details class="mt-3"><summary class="cursor-pointer text-sm">تعديل الاقتباس</summary><form method="POST" action="{{ route('edit_quote', $quote) }}" class="mt-2 space-y-2">@csrf @method('PUT')<textarea class="input" name="content" required minlength="3" maxlength="500">{{ $quote->content }}</textarea><input class="input" name="source" maxlength="180" value="{{ $quote->source }}" placeholder="المصدر"><button class="text-xs text-emerald-100">حفظ التعديل</button></form></details>
                    <form method="POST" action="{{ route('delete_quote', $quote) }}" class="mt-3">@csrf @method('DELETE')<button class="text-xs text-red-300" onclick="return confirm('هل تريد حذف الاقتباس؟')">حذف الاقتباس</button></form>
                @endif
            </div></details>
        @endauth
    </div>

    <details class="mt-4 border-t border-white/10 pt-3">
        <summary class="cursor-pointer text-sm text-white/65">التعليقات ({{ $quote->comments_count ?? $quote->comments->count() }})</summary>
        <div class="mt-3 space-y-3">
            @foreach ($quote->comments->take(4) as $comment)<p class="rounded-xl bg-white/5 p-3 text-sm"><a class="font-bold text-emerald-100" href="{{ route('profile', $comment->user) }}">{{ $comment->user->name }}</a> <span class="text-white/75">{{ $comment->content }}</span></p>@endforeach
            @auth<form method="POST" action="{{ route('quotes.comment', $quote) }}" class="flex gap-2">@csrf<input name="content" maxlength="500" required class="input" placeholder="أضف تعليقًا"><button class="btn-primary shrink-0 px-4 py-2">إرسال</button></form>@else<a href="{{ route('login') }}" class="text-sm text-emerald-100">سجّل الدخول للتعليق</a>@endauth
        </div>
    </details>
</article>
