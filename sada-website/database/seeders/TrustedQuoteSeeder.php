<?php

namespace Database\Seeders;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TrustedQuoteSeeder extends Seeder
{
    public function run(): void
    {
        $editor = User::firstOrCreate(
            ['email' => 'editor@sada.example'],
            ['name' => 'فريق صدى', 'password' => Str::random(64)],
        );

        $quotes = [
            [
                'english' => 'It is a truth universally acknowledged, that a single man in possession of a good fortune must be in want of a wife.',
                'arabic' => 'من الحقائق المسلّم بها أن الرجل الأعزب، إذا كان ذا ثروة طيبة، لا بد أن يكون بحاجة إلى زوجة.',
                'author' => 'جين أوستن', 'title' => 'كبرياء وتحامل',
                'url' => 'https://www.gutenberg.org/ebooks/1342', 'category' => 'حب', 'mood' => 'متفائل', 'source' => 'ترجمة عربية عن النص الأصلي',
            ],
            [
                'english' => 'I could easily forgive his pride, if he had not mortified mine.',
                'arabic' => 'كان يسعني أن أغفر كبرياءه، لولا أنه جرح كبريائي.',
                'author' => 'جين أوستن', 'title' => 'كبرياء وتحامل',
                'url' => 'https://www.gutenberg.org/ebooks/1342', 'category' => 'حب', 'mood' => 'حزين', 'source' => 'ترجمة عربية عن النص الأصلي',
            ],
            [
                'english' => 'Why, then ’tis none to you; for there is nothing either good or bad but thinking makes it so.',
                'arabic' => 'إذن، لا يكون الشيء خيرًا أو شرًّا في ذاته؛ إنما التفكير هو ما يجعله كذلك.',
                'author' => 'ويليام شكسبير', 'title' => 'هاملت',
                'url' => 'https://www.gutenberg.org/ebooks/1524', 'category' => 'حكمة', 'mood' => 'هادئ', 'source' => 'ترجمة عربية عن النص الأصلي',
            ],
            [
                'english' => 'This above all: to thine own self be true;',
                'arabic' => 'قبل كل شيء، كن صادقًا مع نفسك.',
                'author' => 'ويليام شكسبير', 'title' => 'هاملت',
                'url' => 'https://www.gutenberg.org/ebooks/1524', 'category' => 'حكمة', 'mood' => 'متفائل', 'source' => 'ترجمة عربية عن النص الأصلي',
            ],
            [
                'english' => 'So that what before was the impediment, is now the principal object of her working; and that which before was in her way, is now her readiest way.',
                'arabic' => 'وهكذا يصبح ما كان عائقًا أمامك هو مادة عملك، وما كان يعترض طريقك يغدو أيسر سبيل تمضي فيه.',
                'author' => 'ماركوس أوريليوس', 'title' => 'تأملات',
                'url' => 'https://www.gutenberg.org/ebooks/2680', 'category' => 'تحفيز', 'mood' => 'متحمس', 'source' => 'ترجمة عربية عن النص الأصلي',
            ],
            [
                'english' => 'Charitable actions, and a holy disposition, is the only fruit of this earthly life.',
                'arabic' => 'الأعمال الخيّرة والنفس النبيلة هما الثمرة الوحيدة لهذه الحياة.',
                'author' => 'ماركوس أوريليوس', 'title' => 'تأملات',
                'url' => 'https://www.gutenberg.org/ebooks/2680', 'category' => 'عام', 'mood' => 'ممتن', 'source' => 'ترجمة عربية عن النص الأصلي',
            ],
            [
                'english' => 'إنك إن تلتمس رضى جميع الناس تلتمس ما لا يُدرك.',
                'arabic' => 'إنك إن تلتمس رضى جميع الناس تلتمس ما لا يُدرك.',
                'author' => 'عبد الله بن المقفع', 'title' => 'الأدب الكبير',
                'url' => 'https://www.safahat.org/books/84694028/1.1/', 'category' => 'حكمة', 'mood' => 'هادئ', 'source' => 'النص الأصلي',
            ],
            [
                'english' => 'إنَّ كلمةً واحدةً من الصواب تُصيب موضعها خيرٌ من مائة كلمة تقولها في غير فُرَصها ومواضعها.',
                'arabic' => 'إنَّ كلمةً واحدةً من الصواب تُصيب موضعها خيرٌ من مائة كلمة تقولها في غير فُرَصها ومواضعها.',
                'author' => 'عبد الله بن المقفع', 'title' => 'الأدب الكبير',
                'url' => 'https://www.safahat.org/books/84694028/1.2/', 'category' => 'حكمة', 'mood' => 'متفائل', 'source' => 'النص الأصلي',
            ],
            [
                'english' => 'إنَّ لكل شيء من العلم ونوع من الحكمة وصنف من الأدب سببًا يدعو إلى تأليف ما كان فيه مشتَّتًا، ومعنًى يحدو على جمع ما كان متفرقًا.',
                'arabic' => 'إنَّ لكل شيء من العلم ونوع من الحكمة وصنف من الأدب سببًا يدعو إلى تأليف ما كان فيه مشتَّتًا، ومعنًى يحدو على جمع ما كان متفرقًا.',
                'author' => 'الجاحظ', 'title' => 'الحنين إلى الأوطان',
                'url' => 'https://www.safahat.org/books/25703937/1/', 'category' => 'حكمة', 'mood' => 'هادئ', 'source' => 'النص الأصلي',
            ],
            [
                'english' => 'ولولا تقييد العلماء خواطرهم على الدهر، ونقرهم آثار الأوائل في الصخر، لبطل أول العلم وضاع آخره.',
                'arabic' => 'ولولا تقييد العلماء خواطرهم على الدهر، ونقرهم آثار الأوائل في الصخر، لبطل أول العلم وضاع آخره.',
                'author' => 'الجاحظ', 'title' => 'الحنين إلى الأوطان',
                'url' => 'https://www.safahat.org/books/25703937/1/', 'category' => 'تحفيز', 'mood' => 'متفائل', 'source' => 'النص الأصلي',
            ],
        ];

        foreach ($quotes as $entry) {
            $attributes = [
                'user_id' => $editor->id,
                'mood' => $entry['mood'],
                'author_name' => $entry['author'],
                'source_title' => $entry['title'],
                'source_url' => $entry['url'],
                'source' => $entry['source'],
            ];

            $legacyQuote = $entry['english'] !== $entry['arabic']
                ? Quote::query()->where('user_id', $editor->id)
                    ->where('content', $entry['english'])
                    ->where('category', $entry['category'])
                    ->first()
                : null;

            if ($legacyQuote) {
                $legacyQuote->update($attributes + ['content' => $entry['arabic']]);
            } else {
                Quote::updateOrCreate(
                    ['content' => $entry['arabic'], 'category' => $entry['category']],
                    $attributes + ['category' => $entry['category']],
                );
            }
        }
    }
}
