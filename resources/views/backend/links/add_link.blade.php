<div class="modal fade text-left" id="addlink" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('links.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">إضافة رابط</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">إسم الرابط بالعربي</label>
                        <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name_en">إسم الرابط بالانجليزي</label>
                        <input type="text" name="name_en" value="{{ old('name_en') }}" id="name_en" class="form-control">
                        @error('name_en')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="url">عنوان الرابط</label>
                        <input type="url" name="url" value="{{ old('url') }}" id="url" class="form-control">
                        @error('url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
