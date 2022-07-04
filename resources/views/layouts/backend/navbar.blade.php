<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-info navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
              <img class="brand-logo" alt="" src="{{ $cache_settings->min_logo }}">
              <h3 class="brand-text">{{ $cache_settings->name }}</h3>
            </a>
          </li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
            <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#"><i class="ficon ft-search"></i></a>
              <div class="search-input">
                <form action="{{ route('dashboard.search') }}" method="get">
                    @csrf
                    <input class="input" name="search" type="text" placeholder="البحث ...">
                </form>
              </div>
            </li>
          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">مرحباً,
                  <span class="user-name text-bold-700">{{Auth::user()->name}}</span>
                </span>
                <span class="avatar avatar-online">
                  <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim(Auth::user()->email))) }}" alt="avatar"><i></i></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('profile.index') }}"><i class="ft-user"></i> تعديل الملف الشخصي</a>
                    <a class="dropdown-item" href="javascript:void();" onclick="getElementById('logout').submit()"><i class="ft-power"></i> تسجيل خروج
                        <form action="{{ route('logout') }}" method="POST" id="logout">@csrf</form>
                    </a>
              </div>
            </li>
            <li class="dropdown dropdown-notification nav-item">
                <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                    <i class="ficon ft-mail"></i>
                    <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">{{$notificationCount > 0 ??''}}</span>
                </a>
              <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                <li class="dropdown-menu-header">
                  <h6 class="dropdown-header m-0">
                    <span class="grey darken-2">الرسائل</span>
                  </h6>
                  <span class="notification-tag badge badge-default badge-warning float-right m-0">{{$notificationCount}} رسائل جديدة</span>
                </li>
                <li class="scrollable-container media-list w-100">
                    @forelse ($notifications as $notification)
                    <a href="{{ route('contacts.show', $notification) }}">
                        <div class="media">
                          <div class="media-left align-self-center"><i class="la la-envelope icon-bg-circle bg-cyan"></i></div>
                          <div class="media-body">
                            <h6 class="media-heading">مراسلة من {{ $notification->name }}</h6>
                            <p class="notification-text font-small-3 text-muted">{{ Str::limit($notification->subject, 30) }}</p>
                            <small>
                              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">{{ $notification->created_at }}</time>
                            </small>
                          </div>
                        </div>
                      </a>
                    @empty
                      <div class="text-center mb-2">لاتوجد مراسلات</div>
                    @endforelse
                  </li>
                <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="{{ route('contacts.index') }}">الرسائل (<span class="notif-count">{{$notificationCount}}</span>)</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
