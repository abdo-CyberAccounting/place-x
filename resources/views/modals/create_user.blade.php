{{-- Start - Statistics Modal --}}
<div class="modal fade bd-example-modal-lg"  id="create-user-modal" tabindex="-1" role="dialog"
     aria-labelledby="myExtraLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title statistics-modal-title" id="myLargeModalLabel">Create New User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {{--This div to containt the message came from ajax--}}
                <div id="message_add_new_user"></div>
                <form novalidate id="add_new_user">
                    <div class="form-group m-t-10">
                        <div class="controls">
                            <input type="text" class="form-control" name="name" required
                                   data-validation-required-message="This field is required" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                            <input type="text" name="speciality" class="form-control" id="speciality" placeholder="Speciality">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                            <input type="text" name="come_from" class="form-control" placeholder="Know us form">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                            <input type="text" name="mobile"
                                   data-validation-containsnumber-regex="(\d)+"
                                   data-validation-containsnumber-message="No Characters Allowed, Only Numbers"
                                   class="form-control" id="mobile" placeholder="Mobile">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close
                </button>
                <button type="button" id="add_new_user_btn" onclick="$('#add_new_user').submit();" class="btn btn-primary waves-effect text-left">
                     + Add Guest
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{-- end - Statistics Modal --}}

