@props(['page' => ''])

<header class="site-header sticky top-0 z-50 border-b border-white/10 bg-[#100d1b]/90 backdrop-blur-xl">
    <nav class="site-nav mx-auto flex max-w-[1320px] items-center justify-between gap-5 px-4 py-3 md:px-8" aria-label="التنقل الرئيسي">
        <a href="{{ route('home') }}" class="brand-link flex items-center gap-3" aria-label="صدى — الرئيسية">
            <img src="{{ asset('images/sada-mark.svg') }}" class="h-11 w-11" alt="">
            <span><span class="block text-xl font-extrabold tracking-tight">صدى</span><span class="brand-tagline block text-[.65rem]">مساحة للكلمات الملهمة</span></span>
        </a>
        <div class="site-nav-links flex flex-wrap items-center justify-end gap-2 text-sm" dir="rtl">
            <a href="{{ route('quotes.index') }}" class="nav-link">الاقتباسات</a>
            <a href="{{ route('quotes.index', ['sort' => 'trending']) }}" class="nav-link">الأكثر تداولًا</a>
            <a href="{{ route('sources') }}" class="nav-link">مصادر الكتب</a>
            @auth
                <details class="profile-menu">
                    <summary class="nav-link profile-menu-trigger">الملف الشخصي <span aria-hidden="true">⌄</span></summary>
                    <div class="profile-menu-panel" aria-label="روابط الملف الشخصي">
                        <a href="{{ route('profile', auth()->user()) }}">حسابي</a>
                        <a href="{{ route('favorites') }}">المفضلة</a>
                        <a href="{{ route('collections.index') }}">مجموعاتي</a>
                        @if (auth()->user()->is_admin)
                            <a href="{{ route('admin.reports') }}">الإدارة</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">تسجيل الخروج</button></form>
                    </div>
                </details>
            @else
                <a href="{{ route('login') }}" class="nav-link">دخول</a>
                <a href="{{ route('signup') }}" class="nav-cta rounded-xl bg-emerald-200 px-4 py-2 font-bold text-[#171328] transition hover:bg-emerald-100">حساب جديد</a>
            @endauth
        </div>
    </nav>
</header>
