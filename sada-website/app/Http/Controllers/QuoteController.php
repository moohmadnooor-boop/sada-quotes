<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuoteRequest;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    /** Show every quote grouped under its category. */
    public function categories()
    {
        $categories = [
            ['name' => 'عام', 'description' => 'أفكار من تفاصيل الحياة اليومية، وكلمات تشبه لحظاتنا الصغيرة.', 'message' => 'في أبسط الأيام، تختبئ معانٍ تستحق أن نتوقف عندها.', 'image' => 'images/category-general.svg', 'alt' => 'ضوء هادئ يرمز إلى أفكار الحياة اليومية'],
            ['name' => 'تحفيز', 'description' => 'عبارات تشجعك على مواصلة الطريق، خطوة بعد خطوة.', 'message' => 'كل خطوة صادقة تقرّبك من المكان الذي تحلم به.', 'image' => 'images/category-motivation.svg', 'alt' => 'شمس تشرق خلف طريق صاعد ترمز إلى التحفيز'],
            ['name' => 'نجاح', 'description' => 'كلمات عن الطموح والعمل والصبر الذي يصنع الإنجاز.', 'message' => 'النجاح حكاية تكتبها محاولاتك كل يوم.', 'image' => 'images/category-success.svg', 'alt' => 'نجمة وكأس يرمزان إلى النجاح والإنجاز'],
            ['name' => 'حب', 'description' => 'عبارات عن المودة والقرب والروابط التي تمنح الحياة دفئًا.', 'message' => 'المحبة كلمة قصيرة، لكن أثرها يملأ العمر.', 'image' => 'images/category-love.svg', 'alt' => 'قلب مضيء يرمز إلى الحب والمودة'],
            ['name' => 'دراسة', 'description' => 'اقتباسات ترافق رحلة التعلم والبحث وبناء المعرفة.', 'message' => 'كل فكرة تتعلمها تفتح أمامك بابًا جديدًا.', 'image' => 'images/category-study.svg', 'alt' => 'كتاب مفتوح يرمز إلى التعلم والدراسة'],
            ['name' => 'حكمة', 'description' => 'كلمات تختصر خبرة وتجربة، وتترك معناها في الذاكرة.', 'message' => 'الحكمة أن ترى في اللحظة معنى يتجاوزها.', 'image' => 'images/category-wisdom.svg', 'alt' => 'مصباح دافئ يرمز إلى الحكمة والبصيرة'],
        ];

        $quotesByCategory = Quote::with('user')
            ->whereIn('category', array_column($categories, 'name'))
            ->latest()
            ->get()
            ->groupBy('category');

        return view('categories.index', compact('categories', 'quotesByCategory'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quoteCount = Quote::count();
        $dailyQuote = $quoteCount
            ? Quote::with('user')->withCount('likes')->orderBy('id')->skip(now()->dayOfYear % $quoteCount)->first()
            : null;
        $challenge = collect([
            'اكتب عبارة تلهمك لمواصلة الطريق.',
            'شارك اقتباسًا عن الشجاعة والبدايات الجديدة.',
            'ما العبارة التي تتمنى سماعها اليوم؟',
            'اختر اقتباسًا يصف معنى النجاح بالنسبة لك.',
            'شارك كلمات تمنح الأمل لشخص يحتاجها.',
        ])->get(now()->dayOfYear % 5);
        $categories = ['عام', 'تحفيز', 'نجاح', 'حب', 'دراسة', 'حكمة'];
        $categoryHighlights = Quote::with('user')
            ->whereIn('category', $categories)
            ->latest()
            ->get()
            ->unique('category')
            ->keyBy('category');
        return view('welcome', compact('quoteCount', 'dailyQuote', 'challenge', 'categories', 'categoryHighlights'));
    }

    /** Display all quotes on the dedicated browse page. */
    public function all()
    {
        $isTrending = request('sort') === 'trending';
        $query = Quote::with(['user', 'comments.user'])->withCount(['likes', 'comments']);
        if (auth()->check()) {
            $query->withExists([
                'likes as is_liked' => fn ($q) => $q->whereKey(auth()->id()),
                'favorites as is_favorite' => fn ($q) => $q->whereKey(auth()->id()),
            ]);
        }

        if (request('q')) $query->where('content', 'like', '%'.request('q').'%');
        if (request('category')) $query->where('category', request('category'));

        if ($isTrending) {
            // Stable demo-only popularity values keep the trending page populated
            // without changing real likes or comments stored in the database.
            $query->selectRaw('((quotes.id * 37 + 13) % 251) + 50 as demo_likes_count')
                ->whereRaw('((quotes.id * 37 + 13) % 251) >= 170')
                ->orderByDesc('demo_likes_count');
        } else {
            $query->latest();
        }
        $quotes = $isTrending ? $query->limit(18)->get() : $query->paginate(18)->withQueryString();
        $categories = ['عام', 'تحفيز', 'نجاح', 'حب', 'دراسة', 'حكمة'];
        $collections = auth()->check() ? auth()->user()->quoteCollections()->withCount('quotes')->latest()->get() : collect();

        return view('quotes.index', compact('quotes', 'categories', 'collections', 'isTrending'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuoteRequest $request)
    {
        $data = $request->validated();
        $challenge = $request->boolean('challenge');
        unset($data['challenge']);
        if ($challenge) $data['challenge_on'] = today();
        Auth::user()->quotes()->create($data);
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuoteRequest $request, Quote $quote)
    {
        abort_if($quote->user_id != Auth::id(), 403);

        $quote->update($request->validated());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quote $quote)
    {
        abort_if($quote->user_id != Auth::id(), 403);
        $quote->delete();
        return redirect()->back();
    }
}
