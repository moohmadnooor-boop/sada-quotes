<?php

namespace App\Http\Controllers;

use App\Models\Quote;

class SourceController extends Controller
{
    public function index()
    {
        $sources = Quote::query()
            ->whereNotNull('source_title')
            ->whereNotNull('source_url')
            ->whereIn('source', ['النص الأصلي', 'ترجمة عربية عن النص الأصلي'])
            ->get(['author_name', 'source_title', 'source_url'])
            ->groupBy('source_title')
            ->map(fn ($quotes) => [
                'title' => $quotes->first()->source_title,
                'author' => $quotes->first()->author_name,
                'url' => $quotes->first()->source_url,
                'synopsis' => match ($quotes->first()->source_title) {
                    'هاملت' => 'مأساة تدور في الدنمارك حول الأمير هاملت بعد وفاة والده المفاجئة وزواج أمه من عمه كلوديوس. يظهر شبح الملك كاشفًا سرًا عن جريمة قتل، فيبدأ هاملت رحلة انتقام تتشابك فيها الشكوك ومكائد القصر.',
                    'كبرياء وتحامل' => 'رواية تتبع إليزابيث بينيت وعائلتها في مجتمع إنجليزي تحكمه الطبقة والمال والزواج. تؤدي لقاءاتها بالسيد دارسي إلى سوء فهم وأحكام متسرعة، قبل أن تكشف الأحداث حقائق تغيّر نظرة كل منهما إلى الآخر.',
                    'تأملات' => 'مجموعة من الخواطر الشخصية لماركوس أوريليوس، يتأمل فيها الفضيلة وضبط النفس والواجب ومكان الإنسان في العالم. تقدم أفكارًا عملية عن مواجهة صعوبات الحياة بالعقل والاتزان.',
                    'الأدب الكبير' => 'كتاب في الحكمة والآداب، يتناول في مقالاته نصائح للحاكم في تدبير شؤون الحكم، ثم ينتقل إلى آداب الصداقة وحسن التعامل مع الناس.',
                    'الحنين إلى الأوطان' => 'يجمع الجاحظ أخبارًا وحكايات وأشعارًا تصوّر تعلق الناس بأوطانهم واشتياقهم إلى ديارهم، ويعرض صورًا مختلفة للغربة والوفاء للمكان الأول.',
                    default => 'نبذة تعريفية عن هذا الكتاب ومضمونه.',
                },
                'cover' => match ($quotes->first()->source_title) {
                    'هاملت' => 'images/book-covers/hamlet.svg',
                    'كبرياء وتحامل' => 'images/book-covers/pride-and-prejudice.svg',
                    'تأملات' => 'images/book-covers/meditations.svg',
                    'الأدب الكبير' => 'images/book-covers/al-adab-al-kabir.svg',
                    'الحنين إلى الأوطان' => 'images/book-covers/al-haneen-ila-al-awtan.svg',
                    default => 'images/book-covers/default.svg',
                },
            ])
            ->values();

        return view('sources', compact('sources'));
    }
}
