@extends('layouts.frontend.app')

@section('title')
{{ __('Main Page') }}
@endsection

@section('description')
{{ $cache_settings ? $cache_settings->bio : '' }}
@endsection

@section('url')
{{ route('index') }}
@endsection

@section('image')
{{ $cache_settings ? $cache_settings->min_logo : '' }}
@endsection

@section('content')

    <!-- Start Carousel -->
    <div id="carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @if ($cache_slides)
                @foreach ($cache_slides as $slide)
                    <button type="button" data-bs-target="#carousel" data-bs-slide-to="{{ $loop->iteration-1 }}" class="{{ $loop->first ? 'active' : ''}}" aria-current="true" aria-label="{{ $slide->title }}"></button>
                @endforeach
            @endif
        </div>
        <div class="carousel-inner">
            @if ($cache_slides)
                @foreach ($cache_slides as $slide)
                <div class="carousel-item {{ $loop->first ? 'active' : ''}}">
                    <img src="https://alofoug.edu.sd/data0/images/img5.jpg" class="d-block w-100" alt="{{ $slide->title }}">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $slide->title }}</h5>
                        <p>{{ $slide->description }}</p>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- End Carousel -->

    <!-- Start Events & News -->
    <div class="news py-5">
        <div class="container">
            <h3 class="h3 mb-5 secound-title">{{ __('Events & News') }}</h3>
            <div class="row mb-5">
                @if ($cache_recent_posts)
                    @foreach ($cache_recent_posts as $post)
                        <div class="col-md-6 col-lg-3">
                            <a href="{{ route('news.events.single', $post->slug) }}">
                                <div class="card shadow mb-3">
                                    @if ($post->thumbnail)
                                        <div class="image-box  text-center">
                                            @if($post->media_type == 'image')
                                                <div class="image" style="background-image: url({{$post->thumbnail}});"></div>
                                            @else
                                                <div style="background-image: url({{asset('25481.jpg')}});height: 100%;background-position: center center;background-size: cover;"></div>
                                            @endif
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ Str::limit(Str::title($post->title), 28) }}</h5>
                                        <p class="card-text">{{ Str::limit(strip_tags($post->content), 60) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @if ($loop->iteration == 4)
                            @break
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="text-center">
                <a href="{{ route('news.events') }}" class="btn btn-primary">{{ __('See More') }}</a>
            </div>
        </div>
    </div>
    <!-- End Events & News -->

    <!-- Start Statistics -->
    <div class="statistics py-5">
        <div class="container">
            <div class="row">
                @if ($cache_settings->statistics)
                    @foreach (json_decode($cache_settings->statistics) as $statistic)
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="box d-flex flex-column align-items-center">
                            <span class="mb-1 d-flex align-items-center justify-content-center">{{ $statistic->value }}</span>
                            @if (config('app.locale') == 'ar')
                            {{ $statistic->title->ar}}
                            @else
                            {{ $statistic->title->en}}
                            @endif
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- End Statistics -->

    <!-- Start Contact Us -->
    <div class="contact-us py-5" id="contact-us">
        <div class="container">
            <h3 class="h3 mb-5 secound-title">{{ __('Contact Us') }}</h3>
            <div class="row">

                <div class="col-md-3 mb-5">
                    <div class="box p-2 mt-md-5">
                        <h6>{{ __('Email') }}</h6>
                        @if($cache_settings->email)
                            @foreach (json_decode($cache_settings->email) as $email)
                                <a href="mailto:{{ $email->email }}" class="d-block">{{ $email->email }}</a>
                            @endforeach
                        @endif
                    </div>
                    <div class="box p-2 mt-4">
                        <h6>{{ __('Call Us') }}</h6>
                        @if($cache_settings->phone)
                            @foreach (json_decode($cache_settings->phone) as $phone)
                                <a href="tel:{{ $phone->tel }}" class="d-block"><span class="d-block">{{ $phone->tel }}</span></a>
                            @endforeach
                        @endif
                    </div>
                    <div class="box p-2 mt-4">
                        <h6>{{ __('Address') }}</h6>
                        @if($cache_settings->address)
                            <span class="d-block">{{ $cache_settings->address }}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="container">
                        <form action="{{ route('contact.send') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group mb-4">
                                    <input type="text" name="name" id="name" placeholder="{{ __('Enter your name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <input type="email" name="email" id="email" placeholder="{{ __('Enter Your Email') }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" name="subject" id="subject" placeholder="{{ __('Enter Your subject') }}">
                                    @error('subject')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <textarea name="message" id="message" placeholder="{{ __('Leave your message here') }}" rows="5"></textarea>
                                    @error('message')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary w-100">{{ __('Send') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="location mt-5">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d30751.294885235613!2d32.544918!3d15.542855000000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3c435e71a47e9b3e!2sHorizon%20Science%20and%20Technology%20College!5e0!3m2!1sen!2sus!4v1652726949373!5m2!1sen!2sus"
                    width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    <!-- End Contact Us -->

@endsection

@section('js')
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
@endsection
