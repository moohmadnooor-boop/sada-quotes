@extends('Layout.app')
@section('title', $collection->name)
@section('content')
<div class="mx-auto max-w-5xl px-4 py-12"><p class="eyebrow">مجموعة اقتباسات</p><h1 class="mb-7 mt-2 text-3xl font-black">{{ $collection->name }}</h1><div class="space-y-5">@forelse($quotes as $quote)<x-quote-card :quote="$quote" :collections="$collections" />@empty<div class="panel py-12 text-center text-white/55">هذه المجموعة فارغة. أضف اقتباسًا إليها من قائمة الاقتباس.</div>@endforelse</div><div class="mt-6">{{ $quotes->links() }}</div></div>
@endsection
