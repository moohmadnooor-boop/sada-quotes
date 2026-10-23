@extends('Layout.app')

@section('title', 'إنشاء حساب')
@section('content')
<div class="mx-auto grid min-h-[75vh] max-w-6xl items-center gap-12 px-5 py-12 md:grid-cols-2">
    <div class="space-y-5">
        <p class="eyebrow">مساحة الكلمات الملهمة</p>
        <h1 class="text-4xl font-black leading-tight md:text-5xl">ابدأ مجموعتك من <span class="text-emerald-200">الكلمات الجميلة.</span></h1>
        <p class="max-w-lg leading-8 text-white/65">أنشئ حسابك وشارك اقتباساتك، واجمع ما تحب منها في مكان واحد.</p>
    </div>
    <form action="{{ route('signup.store') }}" method="POST" class="panel space-y-5">
        @csrf
        <h2 class="text-2xl font-bold">إنشاء حساب جديد</h2>
        <label class="field-label">الاسم<input class="input mt-2" name="name" value="{{ old('name') }}" required minlength="2" maxlength="60" autocomplete="name"></label>
        @error('name')<p class="form-error">{{ $message }}</p>@enderror
        <label class="field-label">البريد الإلكتروني<input class="input mt-2" name="email" type="email" value="{{ old('email') }}" required autocomplete="email"></label>
        @error('email')<p class="form-error">{{ $message }}</p>@enderror
        <label class="field-label">كلمة المرور<input class="input mt-2" name="password" type="password" required minlength="8" autocomplete="new-password"></label>
        @error('password')<p class="form-error">{{ $message }}</p>@enderror
        <button class="btn-primary w-full" type="submit">أنشئ حسابك</button>
        <p class="text-center text-sm text-white/60">لديك حساب؟ <a class="text-emerald-100 underline" href="{{ route('login') }}">سجل دخولك</a></p>
    </form>
</div>
@endsection
