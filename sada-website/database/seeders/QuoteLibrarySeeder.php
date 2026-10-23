<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Quote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuoteLibrarySeeder extends Seeder
{
    /**
     * Each pair contains a curated Arabic quote and its former English text.
     * The public library stores only the Arabic version.
     */
    public function run(): void
    {
        $editor = User::firstOrCreate(
            ['email' => 'editor@sada.example'],
            ['name' => 'فريق صدى', 'password' => Str::random(64)],
        );

        $categories = [
            'عام' => [
                ['كل يوم يترك نافذة صغيرة لبداية جديدة.', 'Every day leaves a small window open for a new beginning.'],
                ['الكلمة الطيبة تصل أبعد مما نتوقع.', 'A kind word travels farther than we expect.'],
                ['امنح لحظتك انتباهك، فهي الجزء الوحيد الذي تملكه الآن.', 'Give this moment your attention; it is the only part you own right now.'],
                ['الأشياء البسيطة تصنع أيامًا لا تُنسى.', 'Simple things make the days we remember.'],
                ['لا تحتاج الرحلة إلى خريطة كاملة، فقط إلى خطوة صادقة.', 'A journey does not need a perfect map, only an honest first step.'],
                ['اترك في يومك مكانًا لشيء لم تخطط له.', 'Leave a little room in your day for something unplanned.'],
                ['لكل إنسان حكاية تستحق أن تُسمع.', 'Everyone carries a story worth hearing.'],
                ['حين تصغي جيدًا، ترى ما لا تقوله الكلمات.', 'When you listen closely, you notice what words leave unsaid.'],
                ['التغيير الهادئ يغيّر شكل الحياة مع الوقت.', 'Quiet change reshapes a life over time.'],
                ['بعض الإجابات تأتي بعد أن نمنح السؤال وقتًا.', 'Some answers arrive after we give the question time.'],
                ['شارك النور الذي وجدته، ولو كان صغيرًا.', 'Share the light you found, even if it is small.'],
                ['ما نكرره كل يوم يصبح ملامحنا.', 'What we repeat each day becomes part of who we are.'],
                ['العالم أوسع قليلًا حين ننظر إليه بفضول.', 'The world grows a little wider when we meet it with curiosity.'],
                ['احتفظ بالدهشة، فهي بداية المعرفة.', 'Keep your sense of wonder; it is where learning begins.'],
                ['ليس لكل لحظة عنوان، وبعضها يكفي أن يُعاش.', 'Not every moment needs a name; some only need to be lived.'],
            ],
            'تحفيز' => [
                ['ابدأ بما تستطيع، ثم دع شجاعتك توسّع الطريق.', 'Begin with what you can do, and let courage widen the path.'],
                ['خطوة صغيرة اليوم أقوى من خطة مؤجلة.', 'A small step today is stronger than a postponed plan.'],
                ['تقدّمك البطيء ما زال تقدّمًا.', 'Slow progress is still progress.'],
                ['لا تنتظر أن يختفي الخوف؛ تحرّك ومعك بعضه.', 'Do not wait for fear to disappear; move forward with some of it.'],
                ['كل محاولة تمنحك معلومة لم تكن تملكها.', 'Every attempt gives you information you did not have before.'],
                ['حين تتعب، خفف السرعة ولا تتخلَّ عن وجهتك.', 'When you are tired, slow down without giving up your direction.'],
                ['الاستمرار الهادئ يهزم الحماس الذي لا يعود.', 'Steady effort outlasts excitement that never returns.'],
                ['ما تبنيه بصبرك يبقى أقوى من استعجالك.', 'What patience builds is stronger than what haste produces.'],
                ['أعطِ حلمك موعدًا على التقويم، لا مكانًا في الخيال فقط.', 'Give your dream a place on the calendar, not only in your imagination.'],
                ['كل باب مغلق يعلّمك كيف تبحث عن مدخل آخر.', 'Every closed door teaches you to look for another entrance.'],
                ['ثق بالتدريب الذي لا يصفق له أحد.', 'Trust the practice that no one applauds.'],
                ['العودة بعد التعثر جزء من المهارة.', 'Getting back up is part of the skill.'],
                ['طموحك لا يحتاج إذنًا كي يبدأ.', 'Your ambition does not need permission to begin.'],
                ['اصنع عادة صغيرة تساند النسخة التي تريد أن تصبحها.', 'Build one small habit that supports who you want to become.'],
                ['لا تقارن بدايتك بمنتصف طريق شخص آخر.', 'Do not compare your beginning with someone else’s middle.'],
            ],
            'نجاح' => [
                ['النجاح أثرٌ يتراكم من اختيارات صغيرة.', 'Success is the sum of small choices repeated.'],
                ['الإنجاز الحقيقي يجعل طريق غيرك أسهل.', 'Meaningful achievement makes someone else’s path easier.'],
                ['النتيجة الجيدة تبدأ بسؤال واضح.', 'A good result begins with a clear question.'],
                ['كل مهارة كبيرة كانت يومًا محاولة مرتبكة.', 'Every great skill was once an awkward attempt.'],
                ['النجاح الذي يشبهك أفضل من نجاح يرضي الجميع.', 'Success that fits you is better than success that pleases everyone.'],
                ['العمل المتقن يتحدث بهدوء بعد انتهاء صاحبه.', 'Careful work speaks quietly after its maker has left.'],
                ['التقدم يقاس بما تعلمته، لا بما عرضته فقط.', 'Progress is measured by what you learned, not only what you showed.'],
                ['النجاح المستدام يترك مساحة للحياة.', 'Lasting success leaves room for life.'],
                ['حوّل الملاحظات إلى معرفة، والمعرفة إلى ممارسة.', 'Turn feedback into insight, and insight into practice.'],
                ['إنجاز اليوم يصبح خبرة الغد.', 'Today’s effort becomes tomorrow’s experience.'],
                ['الفريق الناجح يجعل الفضل أكبر من صاحبه.', 'A strong team makes the credit bigger than any one person.'],
                ['الوضوح يوفر على الطموح كثيرًا من الدوران.', 'Clarity saves ambition from taking the long way around.'],
                ['النتائج تتبع العمل الذي نكرره بإتقان.', 'Results follow the work we repeat with care.'],
                ['القيادة أن تفتح الطريق ثم تمشي فيه مع الآخرين.', 'Leadership opens a path and walks it alongside others.'],
                ['النجاح ليس سرعة الوصول، بل قيمة ما بنيته.', 'Success is not how quickly you arrive, but what you build along the way.'],
            ],
            'حب' => [
                ['الحب أن يجد قلبك مكانًا آمنًا ليكون على طبيعته.', 'Love is a safe place where the heart can be itself.'],
                ['الاهتمام الصغير يقول أحيانًا ما تعجز عنه الخطب.', 'A small act of care can say what a long speech cannot.'],
                ['نحب أكثر حين نصغي بلا استعجال الرد.', 'We love more deeply when we listen without rushing to reply.'],
                ['المودة أن تتذكر التفاصيل التي تهم الآخر.', 'Affection remembers the details that matter to someone else.'],
                ['القرب الحقيقي لا يلغي المسافة، بل يملؤها بالثقة.', 'Real closeness does not erase distance; it fills it with trust.'],
                ['الحب الناضج يترك للآخر مساحة كي ينمو.', 'Mature love gives another person room to grow.'],
                ['أجمل العلاقات تتسع فيها الحقيقة والرحمة معًا.', 'The best relationships make room for both honesty and kindness.'],
                ['كلمة «أنا هنا» قد تكون بيتًا كاملًا.', '“I am here” can feel like an entire home.'],
                ['المحبة فعل يتجدد في الأيام العادية.', 'Love is a choice renewed on ordinary days.'],
                ['حين نحترم الحدود، يصبح القرب أصدق.', 'Closeness becomes more genuine when we respect boundaries.'],
                ['الحب أن ترى الإنسان كاملًا، لا كما تتمنى أن يكون.', 'Love sees a person as they are, not only as we wish them to be.'],
                ['شارك من قلبك، واترك للآخر حق الاختلاف.', 'Offer your heart and leave room for another point of view.'],
                ['العناية المتبادلة تجعل البيت شعورًا قبل أن يكون مكانًا.', 'Mutual care makes home a feeling before it is a place.'],
                ['الرفق في الخلاف يحمي ما بنيناه في الوفاق.', 'Gentleness in disagreement protects what harmony has built.'],
                ['بعض القلوب تمنح اللحظة العادية معنى جديدًا.', 'Some hearts give an ordinary moment a new meaning.'],
            ],
            'دراسة' => [
                ['السؤال الجيد بداية معرفة لا نهاية لها.', 'A good question is the start of knowledge with no final page.'],
                ['كل صفحة تقرؤها توسّع نافذة في ذهنك.', 'Every page you read opens another window in your mind.'],
                ['الفهم ينمو حين نشرح الفكرة بكلماتنا.', 'Understanding grows when we explain an idea in our own words.'],
                ['استراحة قصيرة تعيد للتركيز طريقه.', 'A short break can help focus find its way back.'],
                ['الخطأ في التدريب دليل على أنك تحاول شيئًا جديدًا.', 'A practice mistake is often proof that you are trying something new.'],
                ['لا تحفظ المعلومة وحدها؛ ابحث عن سببها.', 'Do not only memorize a fact; look for the reason behind it.'],
                ['المعرفة التي تشاركها تصبح أوضح لك ولغيرك.', 'Knowledge becomes clearer when you share it.'],
                ['التعلم ليس سباقًا؛ لكل عقل إيقاعه.', 'Learning is not a race; every mind has its own rhythm.'],
                ['رتّب أفكارك، وستبدو المسألة أقل اتساعًا.', 'Organize your thoughts, and the problem may feel smaller.'],
                ['جلسة مركزة اليوم تختصر قلقًا غدًا.', 'A focused study session today can quiet tomorrow’s worry.'],
                ['اكتب ما فهمته؛ فالورقة تكشف ما يحتاج شرحًا آخر.', 'Write what you understand; the page reveals what needs another look.'],
                ['كل معلومة جديدة تجد مكانها بين معلومات قديمة.', 'Each new idea finds a place among the things you already know.'],
                ['التكرار الذكي يجعل الجهد أقل هدرًا.', 'Thoughtful review makes effort go further.'],
                ['الفضول يحمل الكتاب إلى ما وراء الصفحة.', 'Curiosity carries a book beyond its pages.'],
                ['اجعل هدف المذاكرة أن تفهم، لا أن تنتهي فقط.', 'Let the goal of studying be understanding, not merely finishing.'],
            ],
            'حكمة' => [
                ['ليس كل ما يمكن قوله يستحق أن يُقال الآن.', 'Not everything that can be said needs to be said now.'],
                ['من عرف حدوده استطاع أن يختار طريقه.', 'Knowing your limits helps you choose your direction.'],
                ['الحكمة أن ترى العاقبة قبل أن يغريك الطريق.', 'Wisdom looks toward the consequence before the path tempts you.'],
                ['الرأي يتسع حين يظل صاحبه مستعدًا للتعلم.', 'An opinion grows wiser when its owner remains teachable.'],
                ['الوقت لا يغيّر كل شيء، لكنه يكشف أشياء كثيرة.', 'Time does not change everything, but it reveals a great deal.'],
                ['التوازن ليس أن تقسم وقتك بالتساوي، بل أن تعطي كل شيء حقه.', 'Balance is not equal time; it is giving each thing what it needs.'],
                ['اختر المعركة التي تستحق سلامك.', 'Choose the struggle that is worth your peace.'],
                ['الاعتذار الصادق يصلح ما لا يصلحه التبرير.', 'A sincere apology can repair what excuses cannot.'],
                ['من يطلب الحقيقة يقبل أن تفاجئه.', 'A seeker of truth allows it to be surprising.'],
                ['الصبر أن تعمل، ثم تترك للزمن نصيبه.', 'Patience is doing your part and leaving time to do its own.'],
                ['الإنصات يسبق كثيرًا من الحلول.', 'Listening comes before many of the best answers.'],
                ['لا تجعل رأيك سجنًا يمنعك من رؤية الجديد.', 'Do not turn an opinion into a cell that keeps out new ideas.'],
                ['ما لا تستطيع تغييره، لا تدعه يسرق ما تستطيع.', 'Do not let what you cannot change steal what you can.'],
                ['القوة تعرف متى تتقدم ومتى تترك المجال.', 'Strength knows when to step forward and when to make room.'],
                ['الفهم العميق يجعل الكلمات أقل والاختيارات أهدأ.', 'Deep understanding often brings fewer words and calmer choices.'],
            ],
        ];

        $moodLabels = ['متفائل', 'هادئ', 'متحمس', 'ممتن', 'حزين'];

        foreach ($categories as $category => $pairs) {
            $quoteIndex = 0;
            foreach ($pairs as [$arabic, $english]) {
                $moodIndex = ($quoteIndex * 2) % 6;
                $mood = $moodIndex === 5 ? null : $moodLabels[$moodIndex];
                $arabicQuote = $editor->quotes()->updateOrCreate(
                    ['content' => $arabic, 'category' => $category],
                    ['mood' => $mood, 'source' => 'صياغة أصلية — صدى'],
                );

                $oldEnglishQuote = Quote::query()
                    ->where('user_id', $editor->id)
                    ->where('content', $english)
                    ->where('category', $category)
                    ->where('source', 'صياغة أصلية — صدى')
                    ->first();

                if ($oldEnglishQuote && $oldEnglishQuote->id !== $arabicQuote->id) {
                    $this->mergeQuoteActivity($oldEnglishQuote->id, $arabicQuote->id);
                    $oldEnglishQuote->delete();
                }
                $quoteIndex++;
            }
        }

        // Older releases stored mood-only entries under a private placeholder
        // category. Give those existing rows real categories so they appear in
        // the feed and can be found through both filters, without deleting rows
        // or breaking likes, favorites, comments, or collections.
        $categoryNames = array_keys($categories);
        Quote::where('category', 'خاص بالمشاعر')
            ->orderBy('id')
            ->get()
            ->each(function (Quote $quote, int $index) use ($categoryNames): void {
                $quote->update(['category' => $categoryNames[$index % count($categoryNames)]]);
            });

    }

    private function mergeQuoteActivity(int $oldQuoteId, int $arabicQuoteId): void
    {
        DB::transaction(function () use ($oldQuoteId, $arabicQuoteId): void {
            foreach ([['quote_likes', 'user_id'], ['quote_favorites', 'user_id'], ['collection_quote', 'collection_id']] as [$table, $ownerColumn]) {
                foreach (DB::table($table)->where('quote_id', $oldQuoteId)->get() as $activity) {
                    $existing = DB::table($table)
                        ->where($ownerColumn, $activity->{$ownerColumn})
                        ->where('quote_id', $arabicQuoteId)
                        ->exists();

                    $query = DB::table($table)
                        ->where($ownerColumn, $activity->{$ownerColumn})
                        ->where('quote_id', $oldQuoteId);

                    if ($existing) {
                        $query->delete();
                    } else {
                        $query->update(['quote_id' => $arabicQuoteId]);
                    }
                }
            }

            foreach (DB::table('quote_reports')->where('quote_id', $oldQuoteId)->get() as $report) {
                $existing = DB::table('quote_reports')
                    ->where('user_id', $report->user_id)
                    ->where('quote_id', $arabicQuoteId)
                    ->exists();

                if ($existing) {
                    DB::table('quote_reports')->where('id', $report->id)->delete();
                } else {
                    DB::table('quote_reports')->where('id', $report->id)->update(['quote_id' => $arabicQuoteId]);
                }
            }

            DB::table('quote_comments')->where('quote_id', $oldQuoteId)->update(['quote_id' => $arabicQuoteId]);
        });
    }
}
