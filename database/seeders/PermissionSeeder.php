<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'عرض الاحصاءات']);

        Permission::create(['name' => 'عرض الاحداث و الاخبار']);
        Permission::create(['name' => 'إضافة حدث او خبر']);
        Permission::create(['name' => 'تعديل حدث او خبر']);
        Permission::create(['name' => 'عرض الاحداث والاحداث و الاخبار العاجلة']);
        Permission::create(['name' => 'حذف حدث او خبر']);

        Permission::create(['name' => 'عرض التصنيفات']);
        Permission::create(['name' => 'إضافة تصنيف']);
        Permission::create(['name' => 'تعديل تصنيف']);
        Permission::create(['name' => 'حذف تصنيف']);

        Permission::create(['name' => 'عرض الصفحات']);
        Permission::create(['name' => 'إضافة صفحة']);
        Permission::create(['name' => 'تعديل صفحة']);
        Permission::create(['name' => 'حذف صفحة']);

        Permission::create(['name' => 'عرض صفحات الـ PDF']);
        Permission::create(['name' => 'إضافة صفحة PDF']);
        Permission::create(['name' => 'تعديل صفحة PDF']);
        Permission::create(['name' => 'حذف صفحة PDF']);

        Permission::create(['name' => 'عرض الشريط المتحرك']);
        Permission::create(['name' => 'إضافة شريط متحرك']);
        Permission::create(['name' => 'تعديل شريط متحرك']);
        Permission::create(['name' => 'حذف شريط متحرك']);

        Permission::create(['name' => 'عرض المراسلات']);
        Permission::create(['name' => 'الرد على مراسلة']);
        Permission::create(['name' => 'حذف مراسلة']);

        Permission::create(['name' => 'عرض البرامج']);
        Permission::create(['name' => 'إضافة برنامج']);
        Permission::create(['name' => 'تعديل برنامج']);
        Permission::create(['name' => 'حذف برنامج']);

        Permission::create(['name' => 'عرض الفصول']);
        Permission::create(['name' => 'إضافة فصل']);
        Permission::create(['name' => 'تعديل فصل']);
        Permission::create(['name' => 'حذف فصل']);

        Permission::create(['name' => 'عرض النتائج']);
        Permission::create(['name' => 'إضافة نتيجة']);
        Permission::create(['name' => 'تعديل نتيجة']);
        Permission::create(['name' => 'حذف نتيجة']);

        Permission::create(['name' => 'عرض الروابط']);
        Permission::create(['name' => 'إضافة رابط']);
        Permission::create(['name' => 'تعديل رابط']);
        Permission::create(['name' => 'حذف رابط']);

        Permission::create(['name' => 'عرض المستخدمين']);
        Permission::create(['name' => 'إضافة مستخدم']);
        Permission::create(['name' => 'تعديل مستخدم']);
        Permission::create(['name' => 'حذف مستخدم']);

        Permission::create(['name' => 'مدير الملفات']);

        Permission::create(['name' => 'عرض الزوار']);

        Permission::create(['name' => 'الاعدادات']);

    }
}
