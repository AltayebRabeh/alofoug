<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class=" nav-item"><a href="{{ route('dashboard') }}"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">لوحة التحكم</span></a>

        </li>

        <li class=" nav-item"><a href="#"><i class="la la-edit"></i><span class="menu-title" data-i18n="nav.page_layouts.main">الاحداث والاخبار</span></a>
          <ul class="menu-content">
            <li><a class="menu-item" href="{{ route('posts.create') }}" data-i18n="nav.page_layouts.1_column">إضافة حدث او خبر</a>
            </li>
            <li><a class="menu-item" href="{{ route('posts.index') }}" data-i18n="nav.page_layouts.2_columns">عرض كل الاحداث و الاخبار</a>
            </li>

            <li><a class="menu-item" href="{{ route('posts.breaking_news') }}" data-i18n="nav.page_layouts.2_columns">الاحداث و الاخبار العاجلة</a>
            </li>
            <li><a class="menu-item" href="{{ route('categories.index') }}" data-i18n="nav.page_layouts.3_columns">التصنيفات</a>
            </li>
          </ul>
        </li>

        <li class=" nav-item"><a href="#"><i class="la la-file"></i><span class="menu-title" data-i18n="nav.page_layouts.main">الصفحات</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="{{ route('pages.create') }}" data-i18n="nav.page_layouts.1_column">إضافة صفحة</a>
              </li>
              <li><a class="menu-item" href="{{ route('pages.index') }}" data-i18n="nav.page_layouts.2_columns">عرض كل الصفحات</a>
              </li>
              <li><a class="menu-item" href="{{ route('pdf.pages.create') }}" data-i18n="nav.page_layouts.1_column">إضافة صفحة PDF</a>
              </li>
              <li><a class="menu-item" href="{{ route('pdf.pages.index') }}" data-i18n="nav.page_layouts.2_columns">عرض كل صفحات الـ PDF</a>
              </li>
            </ul>
          </li>

          <li class=" nav-item"><a href="#"><i class="la la-image"></i><span class="menu-title" data-i18n="nav.page_layouts.main">الشريط المتحرك</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="{{ route('slides.create') }}" data-i18n="nav.page_layouts.1_column">إضافة شريط</a>
              </li>
              <li><a class="menu-item" href="{{ route('slides.index') }}" data-i18n="nav.page_layouts.2_columns">عرض كل الاشرطة</a>
              </li>
            </ul>
          </li>

          <li class=" nav-item"><a href="{{ route('filemanager') }}"><i class="la la-folder-open"></i><span class="menu-title" data-i18n="nav.dash.main">مدير الملفات</span></a>

          </li>

          <li class="navigation-header">
            <span data-i18n="nav.category.layouts">الكلية</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
          </li>


          <li class="nav-item"><a href="#"><i class="la la-university"></i><span class="menu-title" data-i18n="nav.page_layouts.main">البرامج</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="{{ route('programs.create') }}" data-i18n="nav.page_layouts.1_column">إضافة برنامج</a>
              </li>
              <li><a class="menu-item" href="{{ route('programs.index') }}" data-i18n="nav.page_layouts.2_columns">عرض كل البرامج</a>
              </li>
              <li><a class="menu-item" href="{{ route('classrooms.index') }}" data-i18n="nav.page_layouts.2_columns">الفصول</a>
              </li>
            </ul>
          </li>

          <li class=" nav-item"><a href="#"><i class="la la-certificate"></i><span class="menu-title" data-i18n="nav.page_layouts.main">النتائج</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="{{ route('results.create') }}" data-i18n="nav.page_layouts.1_column">إضافة نتيجة</a>
              </li>
              <li><a class="menu-item" href="{{ route('results.index') }}" data-i18n="nav.page_layouts.2_columns">عرض كل النتائج</a>
              </li>
            </ul>
          </li>


          <li class="navigation-header">
            <span data-i18n="nav.category.layouts">الادارة</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Layouts"></i>
          </li>

          <li class=" nav-item"><a href="{{ route('links.index') }}"><i class="la la-link"></i><span class="menu-title" data-i18n="nav.dash.main">الروابط</span></a>

          </li>

          <li class=" nav-item"><a href="{{ route('contacts.index') }}"><i class="la la-envelope"></i><span class="menu-title" data-i18n="nav.dash.main">المراسلات</span></a>

          </li>

          <li class=" nav-item"><a href="{{ route('visitors.index') }}"><i class="la la-eye"></i><span class="menu-title" data-i18n="nav.dash.main">الزوار</span></a>

          </li>

          <li class=" nav-item"><a href="#"><i class="la la-users"></i><span class="menu-title" data-i18n="nav.page_layouts.main">المستخدمين</span></a>
            <ul class="menu-content">
              <li><a class="menu-item" href="{{ route('users.create') }}" data-i18n="nav.page_layouts.1_column">إضافة مستخدم</a>
              </li>
              <li><a class="menu-item" href="{{ route('users.index') }}" data-i18n="nav.page_layouts.2_columns">عرض كل المستخدمين</a>
              </li>
            </ul>
          </li>

          <li class=" nav-item"><a href="{{ route('settings.index') }}"><i class="la la-gear"></i><span class="menu-title" data-i18n="nav.dash.main">الاعدادات</span></a>

          </li>

      </ul>
    </div>
  </div>
