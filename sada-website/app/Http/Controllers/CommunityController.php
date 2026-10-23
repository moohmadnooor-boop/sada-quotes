<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Quote;
use App\Models\QuoteComment;
use App\Models\QuoteReport;
use App\Models\User;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function like(Quote $quote) { auth()->user()->likedQuotes()->toggle($quote->id); return back(); }
    public function favorite(Quote $quote) { auth()->user()->favoriteQuotes()->toggle($quote->id); return back(); }

    public function comment(Request $request, Quote $quote)
    {
        $data = $request->validate(['content' => ['required', 'string', 'min:2', 'max:500']]);
        $comment = new \App\Models\QuoteComment($data);
        $comment->user()->associate(auth()->user());
        $quote->comments()->save($comment);
        return back();
    }

    public function profile(User $user)
    {
        $user->loadCount(['quotes', 'followers', 'following']);
        $query = $user->quotes()->with(['user', 'comments.user'])->withCount(['likes', 'comments']);
        if (auth()->check()) {
            $query->withExists([
                'likes as is_liked' => fn ($q) => $q->whereKey(auth()->id()),
                'favorites as is_favorite' => fn ($q) => $q->whereKey(auth()->id()),
            ]);
        }
        $quotes = $query->latest()->paginate(10);
        $collections = auth()->check() ? auth()->user()->quoteCollections()->latest()->get() : collect();
        $isFollowing = auth()->check() && auth()->user()->following()->whereKey($user->id)->exists();
        return view('profile', compact('user', 'quotes', 'collections', 'isFollowing'));
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate(['name' => ['required', 'string', 'min:2', 'max:60'], 'bio' => ['nullable', 'string', 'max:300']]);
        auth()->user()->update($data);
        return back()->with('status', 'تم تحديث ملفك الشخصي.');
    }

    public function follow(User $user)
    {
        abort_if($user->is(auth()->user()), 403);
        auth()->user()->following()->toggle($user->id);
        return back();
    }

    public function favorites()
    {
        $quotes = auth()->user()->favoriteQuotes()->with(['user', 'comments.user'])->withCount(['likes', 'comments'])
            ->withExists([
                'likes as is_liked' => fn ($q) => $q->whereKey(auth()->id()),
                'favorites as is_favorite' => fn ($q) => $q->whereKey(auth()->id()),
            ])->latest('quote_favorites.created_at')->paginate(12);
        $collections = auth()->user()->quoteCollections()->latest()->get();
        return view('favorites', compact('quotes', 'collections'));
    }

    public function createCollection(Request $request)
    {
        $data = $request->validate(['name' => ['required', 'string', 'min:2', 'max:80']]);
        auth()->user()->quoteCollections()->create($data);
        return back()->with('status', 'تم إنشاء المجموعة.');
    }

    public function collections()
    {
        $collections = auth()->user()->quoteCollections()->withCount('quotes')->latest()->get();
        return view('collections.index', compact('collections'));
    }

    public function addToCollection(Request $request, Quote $quote)
    {
        $data = $request->validate(['collection_id' => ['required', 'integer', 'exists:collections,id']]);
        $collection = auth()->user()->quoteCollections()->findOrFail($data['collection_id']);
        $collection->quotes()->toggle($quote->id);
        return back()->with('status', 'تم تحديث المجموعة.');
    }

    public function collection(Collection $collection)
    {
        abort_unless($collection->user_id === auth()->id(), 403);
        $quotes = $collection->quotes()->with(['user', 'comments.user'])->withCount(['likes', 'comments'])
            ->withExists([
                'likes as is_liked' => fn ($q) => $q->whereKey(auth()->id()),
                'favorites as is_favorite' => fn ($q) => $q->whereKey(auth()->id()),
            ])->latest('collection_quote.created_at')->paginate(12);
        $collections = auth()->user()->quoteCollections()->latest()->get();
        return view('collection', compact('collection', 'quotes', 'collections'));
    }

    public function report(Request $request, Quote $quote)
    {
        $data = $request->validate(['reason' => ['required', 'string', 'min:3', 'max:180']]);
        QuoteReport::firstOrCreate(['user_id' => auth()->id(), 'quote_id' => $quote->id], $data);
        return back()->with('status', 'وصل بلاغك للمراجعة.');
    }

    public function admin()
    {
        abort_unless(auth()->user()->is_admin, 403);
        $reports = QuoteReport::with(['quote.user', 'user'])->where('resolved', false)->latest()->paginate(20);
        return view('admin.reports', compact('reports'));
    }

    public function resolveReport(QuoteReport $report)
    {
        abort_unless(auth()->user()->is_admin, 403);
        $report->update(['resolved' => true]);
        return back()->with('status', 'تم إغلاق البلاغ.');
    }

    public function removeReportedQuote(QuoteReport $report)
    {
        abort_unless(auth()->user()->is_admin, 403);
        $report->quote?->delete();
        return back()->with('status', 'تم حذف الاقتباس المخالف.');
    }
}
