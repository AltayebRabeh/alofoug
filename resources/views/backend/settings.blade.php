@extends('layouts.backend.admin')

@section('content')
<div class="content-wrapper">

    <div class="description-body">

        <section id="basic-form-layouts">
            <div class="row match-height">
                <div class="col-md-12">
                    <div class="card cairo">
                        <div class="card-header">
                          <h4 class="card-title cairo" id="tel-repeater">الإعدادات الرئيسية</h4>
                          <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                          <div class="heading-elements">
                            <ul class="list-inline mb-0">
                              <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="card-content collapse">
                          <div class="card-body">
                            <form class="row" action="{{ route('settings.update') }}" method="POST">
                                @csrf
                                <div class="form-group col-12 mb-2">
                                    <label for="lfm">الشعار</label>
                                    <div class="input-group">
                                        <a id="lfm" data-input="logo" data-preview="holder" class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> إختيار
                                        </a>
                                        <input id="logo" value="{{$setting->logo}}" readonly class="form-control" type="text" name="logo">
                                    </div>
                                    <div id="holder" style="margin-top:15px">
                                        <img src="{{$setting->logo}}" style="height: 5rem;">
                                    </div>
                                </div>
                                <div class="form-group col-12 mb-2">
                                    <label for="lfm2">الشعار المصغر</label>
                                    <div class="input-group">
                                        <a id="lfm2" data-input="min_logo" data-preview="holder" class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> إختيار
                                        </a>
                                        <input id="min_logo" value="{{$setting->min_logo}}" readonly class="form-control" type="text" name="min_logo">
                                    </div>
                                    <div id="holder2" style="margin-top:15px">
                                        <img src="{{$setting->min_logo}}" style="height: 5rem;">
                                    </div>
                                </div>
                              <div class="col-md-6">
                                <div class="form-group col-12 mb-2">
                                    <label for="name">إسم المؤسسة بالعربي</label>
                                    <input type="text" value="{{$setting->name}}" id="name" class="form-control" placeholder="إسم المؤسسة بالعربي" name="name">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group col-12 mb-2">
                                    <label for="name_en">إسم المؤسسة بالانجليزي</label>
                                    <input type="text" value="{{$setting->getTranslation('name', 'en')}}" id="name_en" class="form-control" placeholder="إسم المؤسسة بالانجليزي" name="name_en">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group col-12 mb-2">
                                    <label for="bio">نبذة عن المؤسسة بالعربي</label>
                                    <textarea id="bio"  rows="5" class="form-control" name="bio" placeholder="نبذة عن المؤسسة بالعربي">{{$setting->bio}}</textarea>
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group col-12 mb-2">
                                    <label for="bio_en">نبذة عن المؤسسة بالانجليزي</label>
                                    <textarea id="bio_en"  rows="5" class="form-control" name="bio_en" placeholder="نبذة عن المؤسسة بالانجليزي"> {{$setting->getTranslation('bio', 'en')}}</textarea>
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="form-group col-12 mb-2">
                                    <label for="address">عنوان المؤسسة بالعربي</label>
                                    <input type="text" value="{{$setting->address}}" id="address" class="form-control" placeholder="عنوان المؤسسة بالعربي" name="address">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group col-12 mb-2">
                                    <label for="address_en">عنوان المؤسسة بالانجليزي</label>
                                    <input type="text" value="{{$setting->getTranslation('address', 'en')}}" id="address_en" class="form-control" placeholder="عنوان المؤسسة بالانجليزي" name="address_en">
                                  </div>
                              </div>

                              <div class="form-group col-12 mb-2">
                                <input type="submit" class="btn btn-primary" value="حفظ">
                              </div>
                            </form>
                          </div>
                        </div>
                    </div>

                    <div class="card cairo">
                        <div class="card-header">
                          <h4 class="card-title cairo" id="tel-repeater">وسائل التواصل</h4>
                          <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                          <div class="heading-elements">
                            <ul class="list-inline mb-0">
                              <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="card-content collapse">
                          <div class="card-body">
                            <form class="row" action="{{ route('settings.contacts') }}" method="POST">
                                @csrf
                              <div class="form-group col-12 mb-2 contact-repeater">
                                <label for="tel">ارقام الهواتف</label>
                                <div data-repeater-list="repeater_group_tels">
                                    @if($setting->phone)
                                    @foreach (json_decode($setting->phone) as $phone)
                                        <div class="input-group mb-1" data-repeater-item="">
                                            <input type="tel"  value="{{$phone->tel}}" name="repeater_group_tels[{{ $loop->index }}][tel]" placeholder="رقم الهاتف" class="form-control" id="example-tel-input">
                                            <span class="input-group-append" id="button-addon2">
                                                <button class="btn btn-danger" type="button" data-repeater-delete=""><i class="ft-x"></i></button>
                                            </span>
                                        </div>
                                    @endforeach
                                  @else
                                    <div class="input-group mb-1" data-repeater-item="">
                                        <input type="tel" name="tel" placeholder="رقم الهاتف" class="form-control" id="example-tel-input">
                                        <span class="input-group-append" id="button-addon2">
                                        <button class="btn btn-danger" type="button" data-repeater-delete=""><i class="ft-x"></i></button>
                                        </span>
                                    </div>
                                  @endif
                                </div>
                                <button type="button" data-repeater-create="" class="btn btn-success">
                                  <i class="ft-plus"></i> إضافة رقم هاتف
                                </button>
                              </div>

                              <hr>

                              <div class="form-group col-12 mb-2 contact-repeater">
                                <label for="emails">البريد الالكتروني</label>
                                <div data-repeater-list="repeater_group_emails">
                                  @if($setting->email)
                                    @foreach (json_decode($setting->email) as $email)
                                        <div class="input-group mb-1" data-repeater-item="">
                                            <input type="email" value="{{$email->email}}" name="repeater_group_emails[{{ $loop->index }}][email]" placeholder="البريد الالكتروني" class="form-control" id="example-tel-input">
                                            <span class="input-group-append" id="button-addon2">
                                            <button class="btn btn-danger" type="button" data-repeater-delete=""><i class="ft-x"></i></button>
                                            </span>
                                        </div>
                                    @endforeach
                                  @else
                                  <div class="input-group mb-1" data-repeater-item="">
                                    <input type="email" name="email" placeholder="البريد الالكتروني" class="form-control" id="example-tel-input">
                                    <span class="input-group-append" id="button-addon2">
                                      <button class="btn btn-danger" type="button" data-repeater-delete=""><i class="ft-x"></i></button>
                                    </span>
                                  </div>
                                  @endif
                                </div>
                                <button type="button" data-repeater-create="" class="btn btn-success">
                                  <i class="ft-plus"></i> إضافة بريد
                                </button>
                              </div>

                              <hr>

                              <div class="form-group col-12 mb-2 contact-repeater">
                                <label for="social_media">مواقع التواصل الاجتماعي</label>
                                <div data-repeater-list="repeater_group_social_media">
                                    @if($setting->social_media)
                                    @foreach (json_decode($setting->social_media) as $social_media)
                                        <div class="input-group mb-1" data-repeater-item="">
                                            <input type="url" value="{{$social_media->social_url}}" name="repeater_group_social_media[{{ $loop->index }}][social_url]" placeholder="عنوان موقع التواصل الاجتماعي" class="form-control" id="example-tel-input">
                                            <input type="text" value="{{$social_media->social_icon}}" name="repeater_group_social_media[{{ $loop->index }}][social_icon]" placeholder="الاسم" class="form-control" id="example-tel-input">
                                            <span class="input-group-append" id="button-addon2">
                                              <button class="btn btn-danger" type="button" data-repeater-delete=""><i class="ft-x"></i></button>
                                            </span>
                                          </div>
                                    @endforeach
                                  @else
                                    <div class="input-group mb-1" data-repeater-item="">
                                        <input type="url" name="social_url" placeholder="عنوان موقع التواصل الاجتماعي" class="form-control" id="example-tel-input">
                                        <input type="text" name="social_icon" placeholder="الاسم" class="form-control" id="example-tel-input">
                                        <span class="input-group-append" id="button-addon2">
                                        <button class="btn btn-danger" type="button" data-repeater-delete=""><i class="ft-x"></i></button>
                                        </span>
                                    </div>
                                  @endif
                                </div>
                                <p class="text-success">يجب كتابة إسم موقع التواصل الاجتماعي باللغة الانجليزية لإظهار الايقونات </p>
                                <button type="button" data-repeater-create="" class="btn btn-success">
                                  <i class="ft-plus"></i> إضافة موقع تواصل
                                </button>
                              </div>

                              <div class="form-group col-12 mb-2">
                                <input type="submit" class="btn btn-primary" value="حفظ">
                              </div>
                            </form>
                          </div>
                        </div>
                    </div>

                    <div class="card cairo">
                        <div class="card-header">
                          <h4 class="card-title cairo" id="tel-repeater">قسم الاحصائيات</h4>
                          <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                          <div class="heading-elements">
                            <ul class="list-inline mb-0">
                              <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="card-content collapse">
                          <div class="card-body">
                            <form class="row" action="{{ route('settings.statistics') }}" method="POST">
                                @csrf

                                @if ($setting->statistics)
                                    @foreach (json_decode($setting->statistics) as $statistic)
                                        <div class="form-group col-md-5 mb-2">
                                            <input type="text" name="statistics[{{ $loop->index }}][title][ar]" value="{{ $statistic->title->ar }}" id="paginate" class="form-control" placeholder="الاسم بالعربي">
                                            @error('statistics.' . $loop->index .'.title.ar')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-5 mb-2">
                                            <input type="text" name="statistics[{{ $loop->index }}][title][en]" value="{{ $statistic->title->en }}" id="paginate" class="form-control" placeholder="الاسم بالانجليزي">
                                            @error('statistics.' . $loop->index .'.title.en')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-2 mb-2">
                                            <input type="text" name="statistics[{{ $loop->index }}][value]" value="{{ $statistic->value }}" id="paginate" class="form-control" placeholder="القيمة">
                                            @error('statistics.' . $loop->index .'.value')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    @endforeach
                                @else
                                    <div class="form-group col-md-5 mb-2">
                                        <input type="text" name="statistics[0][title][ar]" value="" id="paginate" class="form-control" placeholder="الاسم بالعربي">
                                        @error('statistics.0.title.ar')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-5 mb-2">
                                        <input type="text" name="statistics[0][title][en]" value="" id="paginate" class="form-control" placeholder="الاسم بالانجليزي">
                                        @error('statistics.0.title.en')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-2 mb-2">
                                        <input type="text" name="statistics[0][value]" value="" id="paginate" class="form-control" placeholder="القيمة">
                                        @error('statistics.0.value')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>



                                    <div class="form-group col-md-5 mb-2">
                                        <input type="text" name="statistics[1][title][ar]" value="" id="paginate" class="form-control" placeholder="الاسم بالعربي">
                                        @error('statistics.1.title.ar')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-5 mb-2">
                                        <input type="text" name="statistics[1][title][en]" value="" id="paginate" class="form-control" placeholder="الاسم بالانجليزي">
                                        @error('statistics.1.title.en')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-2 mb-2">
                                        <input type="text" name="statistics[1][value]" value="" id="paginate" class="form-control" placeholder="القيمة">
                                        @error('statistics.1.value')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group col-md-5 mb-2">
                                        <input type="text" name="statistics[2][title][ar]" value="" id="paginate" class="form-control" placeholder="الاسم بالعربي">
                                        @error('statistics.2.title.ar')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-5 mb-2">
                                        <input type="text" name="statistics[2][title][en]" value="" id="paginate" class="form-control" placeholder="الاسم بالانجليزي">
                                        @error('statistics.2.title.en')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-2 mb-2">
                                        <input type="text" name="statistics[2][value]" value="" id="paginate" class="form-control" placeholder="القيمة">
                                        @error('statistics.2.value')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group col-md-5 mb-2">
                                        <input type="text" name="statistics[3][title][ar]" value="" id="paginate" class="form-control" placeholder="الاسم بالعربي">
                                        @error('statistics.3.title.ar')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-5 mb-2">
                                        <input type="text" name="statistics[3][title][en]" value="" id="paginate" class="form-control" placeholder="الاسم بالانجليزي">
                                        @error('statistics.3.title.en')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-2 mb-2">
                                        <input type="text" name="statistics[3][value]" value="" id="paginate" class="form-control" placeholder="القيمة">
                                        @error('statistics.3.value')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                @endif


                              <div class="form-group col-12 mb-2">
                                <input type="submit" class="btn btn-primary" value="حفظ">
                              </div>
                            </form>
                          </div>
                        </div>
                    </div>

                    <div class="card cairo">
                        <div class="card-header">
                          <h4 class="card-title cairo" id="tel-repeater">اخرى</h4>
                          <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                          <div class="heading-elements">
                            <ul class="list-inline mb-0">
                              <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="card-content collapse">
                          <div class="card-body">
                            <form class="row" action="{{ route('settings.another') }}" method="POST">
                                @csrf

                                <div class="form-group col-12 mb-2">
                                    <label for="paginate">عدد العناصر في الصفحات</label>
                                    <input type="number" value="{{$setting->paginate}}" id="paginate" class="form-control" placeholder="عدد العناصر في الصفحات" name="paginate">
                                    @error('paginate')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-12 mb-2">
                                    <label for="latest_posts_count">عدد أخر الاحداث والاخبار</label>
                                    <input type="number" value="{{$setting->latest_posts_count}}" id="latest_posts_count" class="form-control" placeholder="عدد أخر الاحداث والاخبار" name="latest_posts_count">
                                    @error('latest_posts_count')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-12 mb-2">
                                    <label for="contact_count">الحد الاقصى للمراسلات اليومية</label>
                                    <input type="number" value="{{$setting->contact_count}}" id="contact_count" class="form-control" placeholder="عدد أخر الاحداث والاخبار" name="contact_count">
                                    @error('contact_count')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>


                              <div class="form-group col-12 mb-2">
                                <input type="submit" class="btn btn-primary" value="حفظ">
                              </div>
                            </form>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>

@endsection

@section('js')

<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
    $('#lfm').filemanager('image');
    $('#lfm2').filemanager('image');
</script>
<script src="{{ asset('backend/vendors/js/forms/repeater/jquery.repeater.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/scripts/forms/form-repeater.js') }}" type="text/javascript"></script>
@endsection
