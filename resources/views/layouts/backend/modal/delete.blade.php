<div class="modal fade text-left show" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel10" style="display: none; padding-right: 17px;">
    <form action="#" method="post">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger white">
                <h4 class="modal-title white" id="myModalLabel10">حذف</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body">
                    هل انت متأكد من الحذف؟
                </div>
                <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">إغلاق</button>
                <button type="submit" class="btn btn-outline-danger">حذف</button>
                </div>
            </div>
        </div>
    </form>
</div>
