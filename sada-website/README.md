# صدى — منصة الاقتباسات

موقع عربي لاستكشاف الاقتباسات حسب التصنيف، حفظ المفضلة والمجموعات، والتفاعل مع اقتباسات المجتمع.

## المتطلبات

- PHP 8.4.1 أو أحدث، مع إضافات PHP التي يتطلبها Laravel.
- Composer.
- Node.js و npm.
- VS Code أو أي محرر نصوص.

## التشغيل على Windows / PowerShell

افتح مجلد المشروع في VS Code ثم افتح Terminal داخله ونفّذ:

```powershell
composer install
Copy-Item .env.example .env
New-Item -ItemType File -Force database/database.sqlite
php artisan key:generate
php artisan migrate --seed
npm install
npm run build
php artisan serve
```

افتح العنوان الذي يظهر في الطرفية، غالبًا `http://127.0.0.1:8000`.

للتطوير مع إعادة بناء الواجهة تلقائيًا، افتح نافذتي Terminal داخل VS Code:

```powershell
php artisan serve
```

```powershell
npm run dev
```

## ملفات المشروع المهمة

- `app/` و`routes/`: منطق التطبيق ومسارات الصفحات.
- `resources/views/`: صفحات Blade ومكونات الواجهة.
- `resources/css/` و`resources/js/`: تنسيقات وتصرفات الواجهة.
- `public/images/`: الشعار والصور وأغلفة الكتب ورسوم التصنيفات.
- `database/migrations/`: بنية قاعدة البيانات.
- `database/seeders/`: بيانات الاقتباسات والتصنيفات الابتدائية.
- `composer.json` و`composer.lock`: اعتماديات PHP وإصداراتها.
- `package.json` و`package-lock.json`: اعتماديات الواجهة وإصداراتها.
- `.env.example`: نموذج إعداد البيئة المحلية.

ملفات `vendor/` و`node_modules/` و`public/build/` يتم توليدها محليًا من ملفات الاعتماديات، لذلك لا تُرفع إلى GitHub. ملف `.env` وقاعدة البيانات المحلية مستبعدان لأنهما قد يحتويان إعدادات أو بيانات خاصة. الاقتباسات الأساسية يعيدها الأمر `php artisan migrate --seed`.
