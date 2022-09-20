<div class="modal fade" id="employee-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <form id="employee-form" method="post" action="" enctype="multipart/form-data">
                @csrf()
                <input type="hidden" id="employee-id" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name<b style="color: red">*</b></label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label>Email<b style="color: red">*</b></label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" name="address" id="address"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Phone<b style="color: red">*</b></label>
                        <input type="number" class="form-control" name="phone_no" id="phone_no" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
