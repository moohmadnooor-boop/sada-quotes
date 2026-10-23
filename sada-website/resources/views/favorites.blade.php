@extends('Layout.app')
@section('title', 'اقتباساتي المحفوظة')
@section('content')
<div class="mx-auto max-w-5xl px-4 py-12"><p class="eyebrow">مكتبتك الخاصة</p><h1 class="mb-7 mt-2 text-3xl font-black">الاقتباسات المحفوظة</h1><div class="space-y-5">@forelse($quotes as $quote)<x-quote-card :quote="$quote" :collections="$collections" />@empty<div class="panel py-12 text-center"><p>لم تحفظ اقتباسات بعد.</p><a class="mt-3 inline-block text-emerald-100 underline" href="{{ route('home') }}">اكتشف الاقتباسات</a></div>@endforelse</div><div class="mt-6">{{ $quotes->links() }}</div></div>
@endsection
