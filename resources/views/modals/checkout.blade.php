{{-- Start - Statistics Modal --}}
<div class="modal fade bd-example-modal-xl" id="checkout-modal" tabindex="-1" role="dialog"
     aria-labelledby="myExtraLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title statistics-modal-title" id="myLargeModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="table-responsive" style="clear: both;">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Guest Name</th>
                                <th class="text-center">Start Time</th>
                                <th class="text-center">End Time</th>
                                <th class="text-center">Total Time</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">50% discount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center" id="id"></td>
                                <td id="name"></td>
                                <td id="start_date" class="text-center font-weight-bold"></td>
                                <td id="end_date" class="text-center font-weight-bold"></td>
                                <td id="total_time" class="text-center font-weight-bold"></td>
                                <td class="text-center font-weight-bold text-danger"><span id="total_cost"></span> L.E
                                </td>
                                <td class="text-center">
                                    <div class="form-group">
                                        <div class="checkbox checkbox-success">
                                            <input id="has_discount" name="50_discount" type="checkbox">
                                            <label for="has_discount"></label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <input type="hidden" id="current_guest_id">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="pull-right m-t-30 text-right">
                        <hr>
                        <h3><b>Total : </b><span class="font-weight-bold text-danger"><span class="final_cost"></span> L.E</span>
                        </h3>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="text-center">
                        <button class="btn btn-danger" data-toggle="modal" data-target="#payment" type="submit">
                            <i class="fas fa-dollar-sign" style="font-size: 17px"></i>
                            Proceed to payment
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade bd-example-modal-xl" id="payment" tabindex="-1" role="dialog"
     aria-labelledby="myExtraLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card bg-danger">
                    <div class="card-body text-center">
                        <h2 class="text-white"><b>Total: <span id="final_cost" class="final_cost"></span> L.E</b></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label">Guest Pay:</label>
                            <input type="number" id="guest_pay" class="form-control" placeholder="ex: 200">
                        </div>
                        <div class="form-group">
                            <label class="control-label text-muted">The rest of the money</label>
                            <input value="0" type="number" id="rest_money" class="form-control" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{-- end - Statistics Modal --}}



