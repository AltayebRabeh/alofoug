<div class="modal fade text-left" id="addToMainMenu-{{$link->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('links.add.to.main.menu', $link) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">إضافة إلى القائمة الرئيسية</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">إسم الرابط</label>
                        <input type="text" readonly name="name" value="{{ old('name', $link->name) }}" id="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="url">عنوان الرابط</label>
                        <input type="text" readonly value="{{ old('url', $link->url) }}" id="url" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="order">الترتيب</label>
                        <input type="number" name="order" value="{{ old('order') }}" id="order" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="parent">إختيار رابط اب</label>
                        <select name="parent" id="parent" class="form-control">
                            <option value=""></option>
                            @foreach ($main_menu as $link)
                                <option value="{{ $link->id }}">{{ $link->link->name }}</option>
                            @endforeach
                        </select>
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
