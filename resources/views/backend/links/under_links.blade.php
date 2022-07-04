<div class="card">
    <div class="card-header">
      <h4 class="card-title cairo">القائمة السفلية</h4>
      <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
      <div class="heading-elements">
        <ul class="list-inline mb-0">
          <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
        </ul>
      </div>
    </div>
    <div class="card-content collapse show">
        <div class="container p-2">
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-between">
                    <p>إسم الرابط</p>
                    <span class="">الترتيب</span>
                </div>
                @forelse ($under_menu as $under_link)
                    <div class="col-sm-12 p-1 mb-1 border border-primary d-flex justify-content-between align-items-center">
                        <p class="mb-0">{{ $under_link->link->name }}</p>
                        <div>
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#updateUnderMenu-{{$under_link->id}}"><i class="la la-pencil"></i></button>
                            <button data-action="{{ route('links.menu.destroy', $under_link) }}" type="button" class="btn btn-danger btn-sm delete-btn" data-toggle="modal" data-target="#deleteModal"><i class="la la-trash"></i></button>
                            <span class="badge badge-glow badge-pill badge-success ml-4">{{ $under_link->order }}</span>
                        </div>
                        <div class="modal fade text-left" id="updateUnderMenu-{{$under_link->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action="{{ route('links.update.under.menu', $under_link->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel1"></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="order">الترتيب</label>
                                                <input type="number" name="order" value="{{ old('order', $under_link->order) }}" id="order" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">إغلاق</button>
                                            <button type="submit" class="btn btn-outline-primary">حفظ</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col text-center">لايوجد روابط</p>
                @endforelse
            </div>
        </div>
    </div>
  </div>
