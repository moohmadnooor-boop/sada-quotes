@extends('Layout.app')

@section('title', 'تسجيل الدخول')
@section('content')
<div class="mx-auto grid min-h-[75vh] max-w-6xl items-center gap-12 px-5 py-12 md:grid-cols-2">
    <div class="space-y-5">
        <p class="eyebrow">أهلًا بعودتك</p>
        <h1 class="text-4xl font-black leading-tight md:text-5xl">كلماتك المفضلة <span class="text-emerald-200">بانتظارك.</span></h1>
        <p class="max-w-lg leading-8 text-white/65">تابع مجتمع الاقتباسات واكتشف ما يلهمك اليوم.</p>
    </div>
    <form action="{{ route('login.store') }}" method="POST" class="panel space-y-5">
        @csrf
        <h2 class="text-2xl font-bold">تسجيل الدخول</h2>
        <label class="field-label">البريد الإلكتروني<input class="input mt-2" name="email" type="email" value="{{ old('email') }}" required autocomplete="email"></label>
        @error('email')<p class="form-error">{{ $message }}</p>@enderror
        <label class="field-label">كلمة المرور<input class="input mt-2" name="password" type="password" required minlength="8" autocomplete="current-password"></label>
        @error('password')<p class="form-error">{{ $message }}</p>@enderror
        <button class="btn-primary w-full" type="submit">دخول</button>
        <p class="text-center text-sm text-white/60">مستخدم جديد؟ <a class="text-emerald-100 underline" href="{{ route('signup') }}">أنشئ حسابًا</a></p>
    </form>
</div>
@endsection
