@extends('layouts.main')
@section('parent-breadcrumb', 'Guests')
@section('child-1-breadcrumb', 'Guests')
@section('child-2-breadcrumb', 'Today Guests')

@section('styles')
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/plugins/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Data Export</h4>
                            <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                        </div>
                        <div class="col-md-6">
                            <button data-toggle="modal" data-target="#create-user-modal"
                                    class="btn btn-lg btn-outline-primary m-r-5 float-right">
                                <i class="mdi mdi-plus"></i>
                                Add Guest
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive m-t-20">
                        <table id="example23"
                               class="text-center display nowrap table table-hover table-striped table-bordered"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>speciality</th>
                                <th>mobile</th>
                                <th>know us from</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{asset('assets/plugins/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script>
        $(function () {
            $('#example23').DataTable({
                processing: true,
                language: {
                    loadingRecords: '&nbsp;',
                    processing: '<div class="spinner-border spinner-border-sm"></div>'
                },
                serverSide: true,
                ajax: {
                    type: 'get',
                    url: '{{url('get-today-guests')}}'
                },
                columns: [
                    {data: 'name', name: 'name', searchable: true, orderable: false},
                    {data: 'email', name: 'email', searchable: true, orderable: false},
                    {data: 'speciality', name: 'speciality', searchable: true, orderable: false},
                    {data: 'mobile', name: 'mobile', searchable: true, orderable: false},
                    {data: 'come_from', name: 'come_from', searchable: true, orderable: false},
                    {data: 'start_date', name: 'start_date', searchable: true, orderable: false},
                    {data: 'end_date', name: 'end_date', searchable: true, orderable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
            });
        });
    </script>

    <script>
        let currentBaseUrl = '{{url('/')}}/';

        !function (window, document, $) {
            "use strict";
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(
                {
                    /** this event fires when all the form data is valid, it prevents form submission. */
                    submitSuccess: function ($form, event) {
                        /** check the submitted data (id) to determine which form submitted. */
                        if ($form.attr('id') === 'add_new_user') {
                            event.preventDefault();
                            change_btn('add_new_user_btn', 'Loading', 1);
                            handleModalOperation('ajax-add-new-guest', 'add_new_guest', $form.serialize());
                        } else if ($form.attr('id') === 'cme_calculator_form') {
                            event.preventDefault();
                            handleModalOperation('cme-calculation', 'cme_calculation', $form.serialize());
                        }
                    }
                }
            );
        }(window, document, jQuery);


        function change_btn(btn_id, btn_value, process) {
            if (process === 1)
                $('#' + btn_id).html(`<i class="fa fa-refresh fa-spin"></i> ${btn_value}`).prop('disabled', true);
            else if (process === 0)
                $('#' + btn_id).html(`${btn_value}`).prop('disabled', false);
        }

        function handleModalOperation($url, $process, $formBody) {
            switch ($process) {
                case 'add_new_guest':
                    $.ajax({
                        type: 'get',
                        url: currentBaseUrl + $url,
                        data: $formBody,
                        success: function (response) {
                            change_btn('add_new_user_btn', '+ Add Guest', 0);
                            get_success_error_messages('message_add_new_user', response,
                                'create-user-modal',
                                'New guest has been added successfully.',
                                'Sorry, unexpected error occurred.', 'mdi-account-check', 'mdi-account-alert', 1500);
                            refreshDataTables();
                        }
                    });
                    break;

                case 'add_new_and_print_regular_guest':
                    $.ajax({
                        type: 'get',
                        url: currentBaseUrl + url,
                        data: data + '&type=0',
                        success: function (response) {

                        }
                    });
                    break;
            }
        }

        function refreshDataTables() {
            $('#example23').DataTable().ajax.reload();
        }


        function get_success_error_messages(div_id, response = '', modal_id = '', success_message = '', error_message = '', success_icon = '', error_icon = '', session_interval = 1000) {
            if (response.code === 200) {
                $('#' + div_id).html(`<div class="alert alert-success"><i class="mdi ${success_icon}"></i> ${response.message}</div>`);
            } else if (response.code === 500 || response.code === 404 || response.code === 400) {
                $('#' + div_id).html(`<div class="alert alert-danger"><i class="mdi ${error_icon}"></i> ${response.message}</div>`);
            }

            setTimeout(function () {
                $('#' + div_id).html(``);
                if (modal_id !== '') {
                    $('#' + modal_id).modal('toggle');
                }
                clearTimeout()
            }, session_interval);

            empty_modal_fields_on_close(modal_id);
        }


        function empty_modal_fields_on_close(modal_id) {
            $('#' + modal_id).on('hidden.bs.modal', function (e) {
                $(this).find("input").val('').end();
            });
        }

        $('.modal').on('shown.bs.modal', function () {
            $(this).find('input').first().focus();
        });

        $(document).on('click', '.guest-checkout', function () {
            let guestId = $(this).attr('data-guest_id');

            $.ajax({
                type: 'get',
                url: currentBaseUrl + 'guest-checkout',
                data: {guest_id: guestId},
                success: function (response) {
                    $('#id').html(`${response.id}`);
                    $('#current_guest_id').val(`${response.id}`);
                    $('#name').html(`${response.name}`);
                    $('#start_date').html(`${response.start_date}`);
                    $('#end_date').html(`${response.end_date}`);
                    $('#total_time').html(`${response.total_time} / hours`);
                    $('#total_cost').html(`${response.total_cost}`);
                    $('.final_cost').html(`${response.total_cost}`);
                    $('#has_discount').prop('checked', response.discount_50);

                }
            })
        });

        $(document).on('click', '#has_discount', function () {
            let guestId = $('#current_guest_id').val();
            $.ajax({
                type: 'get',
                url: currentBaseUrl + 'change-discount-status',
                data: {guest_id: guestId},
                success: function (response) {
                    $('.final_cost').html(`${response.total_cost}`)
                }

            });
        });

        $(document).on('keyup', '#guest_pay', function () {
            let total = parseFloat($('#final_cost').text());
            let guestPay = $('#guest_pay').val();
            if (!guestPay) {
                $('#rest_money').val(0);
            } else {
                $('#rest_money').val(Math.round(guestPay - total, 2));
            }
        });

    </script>
@endsection
