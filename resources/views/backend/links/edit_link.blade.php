<div class="modal fade text-left" id="edit-{{$link->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('links.update', $link) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel1">تعديل رابط</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">إسم الرابط بالعربي</label>
                        <input type="text" name="name" value="{{ old('name', $link->name) }}" id="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="name_en">إسم الرابط بالانجليزي</label>
                        <input type="text" name="name_en" value="{{ old('name', $link->getTranslation('name', 'en')) }}" id="name_en" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="url">عنوان الرابط</label>
                        <input type="url" @readonly($link->primary || $link->linkable_id) name="url" value="{{ old('url', $link->url) }}" id="url" class="form-control">
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
