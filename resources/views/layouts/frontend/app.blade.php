<!--
|___________________________________________________________________________
|                                                                           |
|About Developer                                                            |
|___________________________________________________________________________|
|                                                                           |
|Name: Altayeb Fadlelmola Rabeh Fadlelmola                                  |
|Email: AltayebRabeh@gmail.com                                              |
|Phone: 00249127400216 - 00249929161131                                     |
|___________________________________________________________________________|
-->

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ str_replace('_', '-', app()->getLocale()) == 'en' ? 'ltr' : 'rtl' }}">
<head>
    <meta charset="utf-8">

    <!-- Google Meta -->
    <meta name="Description" CONTENT="@yield('description')">
    <meta name="robots" content="index,follow">

    <!-- Facebook Meta -->
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:image" content="@yield('image')">
    <meta property="og:url" content="@yield('url')">

    <!-- Twitter Meta -->
    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:description" content="@yield('description')">
    <meta name="twitter:image" content="@yield('image')">
    <meta name="twitter:url" content="@yield('url')">
    <meta name="twitter:card" content="@yield('description')">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon apple-touch-icon apple-touch-icon-precomposed" href="{{ $cache_settings ? $cache_settings->min_logo : '' }}">

    <title>@yield('title') - {{ $cache_settings ? $cache_settings->name : config('app.name', 'alofoug') }}</title>

      {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&family=Roboto:ital,wght@1,900&display=swap" rel="stylesheet">

    @yield('css')

    <!-- Styles -->
    @if(LaravelLocalization::getCurrentLocale() == 'ar')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    @endif

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    @if(LaravelLocalization::getCurrentLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('frontend/css/rtl.css') }}">
    @endif

</head>
<body>

    <div id="app">
            <!-- Start Topbar -->
    <div class="top-bar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('index') }}" class="logo d-none d-md-block">
                    <img src="{{ $cache_settings ? $cache_settings->logo : config('app.name', 'alofoug') }}" alt="">
                </a>
                <marquee behavior="" direction="{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'right' : 'left' }}">
                   @if ($cache_breaking_news)
                        @foreach ($cache_breaking_news as $news)
                            @if (!$loop->first)
                                &nbsp; &nbsp; <> &nbsp; &nbsp;
                            @endif
                            <a class="text-d" href="{{ route('news.events.single', $news->slug) }}">{{$news->title}}</a>
                        @endforeach
                   @endif
                </marquee>
                <div class="search">
                    <a data-bs-toggle="modal" href="#searchModalToggle" role="button"><i class="bi bi-search"></i></a>
                    <div class="modal fade" id="searchModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <form action="{{ route('search') }}" method="GET">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" name="search" placeholder="{{ __('Search') }}..." class="form-control" id="">
                                        <input type="hidden" name="search_type" value="Search Type">
                                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lang p-2">
                    @if(LaravelLocalization::getCurrentLocale() == 'ar')
                        <a  class="btn btn-primary" rel="alternate" hreflang="en" href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                            English
                        </a>
                    @else
                        <a  class="btn btn-primary" rel="alternate" hreflang="ar" href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">
                            عربي
                        </a>
                    @endif
                </div>
                <div class="social-media d-flex justify-content-between align-items-center">
                    @if($cache_settings->social_media)
                        @foreach (json_decode($cache_settings->social_media) as $social_media)
                            <a href="{{ $social_media->social_url }}"><i class="bi bi-{{ strtolower($social_media->social_icon) }}"></i></a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->

    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-sm-block d-md-none" href="{{ route('index') }}">
                <img src="{{ $cache_settings ? $cache_settings->min_logo : config('app.name', 'alofoug') }}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
          </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-left w-100 flex-wrap">
                    @if($cache_main_menu)
                        @foreach ($cache_main_menu as $link)
                        <li class="nav-item {{ $link->childrens->first() ? 'dropdown' : ''}}">
                            <a class="nav-link {{ $link->childrens->first() ? 'dropdown-toggle' : '' }}" href="{{ $link->link->url }}" {{ $link->childrens->first() ? 'id="navbarDropdown" role="" data-bs-toggle="dropdown" aria-expanded="false"' : ''}}>
                                {{ $link->link->name }}
                            </a>
                            @if($link->childrens->first())
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach ($link->childrens as $child)
                                        <li><a class="dropdown-item" href="{{ $child->link->url }}">{{ $child->link->name }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <main class="content">
        @yield('content')
    </main>

    <!-- Start Footer -->
    <footer>
        <div class="container">
            <div class="row pt-5">
                <div class="col-md-3">
                    <h5 class="h5">{{ __('Quick Links') }}</h5>
                    <ul class="list-unstyled">
                        @if($cache_under_menu)
                            @foreach ($cache_under_menu as $link)
                                <li><a href="{{ $link->link->url }}">{{ $link->link->name }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="h5">{{ __('Latest Events & News') }}</h5>
                    <ul class="list-unstyled">
                        @if($cache_recent_posts)
                            @foreach ($cache_recent_posts as $post)
                                <li><a href="{{ route('news.events.single', $post->slug) }}">{{ $post->title }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="h5">{{ __('Social Media') }}</h5>
                    <ul class="list-unstyled">
                        @if($cache_settings->social_media)
                            @foreach (json_decode($cache_settings->social_media) as $social_media)
                                <li><a href="{{ $social_media->social_url }}"><i class="bi bi-{{ strtolower($social_media->social_icon) }}"></i> {{ ucfirst($social_media->social_icon) }}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-md-3 visitors">
                    <h5 class="h5">{{  __('Visitors') }}</h5>
                    <ul class="list-unstyled">
                        <li>{{ __('Today\'s Visitors') }} <span>{{ $VisitorsPerDay }}</span></li>
                        <li>{{ __('Visitors Per Month') }} <span>{{ $VisitorsPerMonth }}</span></li>
                        <li>{{ __('Visitors Per Year') }} <span>{{ $VisitorsPerYear }}</span></li>
                        <li>{{ __('All Visitors') }} <span>{{ $allVisitors }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright text-center p-2 mt-3">
            <hr>
            {{ __('Copyright') }} &copy; {{ date('Y') }} <a href="#">{{ $cache_settings ? $cache_settings->name : config('app.name', 'alofoug') }}</a>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- Popup -->
    <span class="popup d-none p-2"><i class="bi bi-chevron-up"></i></span>

    </div>

    @yield('js')

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
</body>
</html>
