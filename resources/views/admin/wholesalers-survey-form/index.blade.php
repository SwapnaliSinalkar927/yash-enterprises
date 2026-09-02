@extends('admin.main')

@section('title', 'View Wholesaler Survey Form')

@section('style')
<style>
    .mdi-chevron-down::before {
        content: "" !important;
    }
</style>
@endsection

@section('content')
<div class="hk-pg-wrapper">
    <div class="container-fluid pb-0">
        <div class="hk-pg-body">
            <div class="row mb-3 mt-3">
                <div class="col-md-12" id="error_section">
                    <!-- @if(\Session::get('status') == 'failed')
                        @include('admin.components.server-alert', ['status' => \Session::get('status')])
                    @endif
                    @if(\Session::get('status') == 'success')
                        @include('admin.components.server-alert', ['status' => \Session::get('status')])
                    @endif -->
                </div>
            </div>
            <section id="sec_10" class="hk-section">
                <div class="hk-example card card-shadow card-wth-tabs  mt-3">
                    <div class="card-header">
                        <h4>Wholesaler Survey Form</h4>
                        <!-- @can('wholesaler_create') -->
                        <!-- <a href="{{ route('admin.states.create') }}" class="btn btn-primary btn-rounded">Add States</a> -->
                        <!-- <div class="page-title-right">
                           
                            <div class="btn-group">
                                <a class="dropdown-item add"
                                    href="{{ route('admin.wholesalers-survey-form.create') }}">Add
                                    Wholesaler Survey Form </a>
                            </div>
                        </div> -->
                        <!-- @endcan -->
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content m-0">
                            <div class="tab-pane fade show active" id="prev_tab_9">
                                <div class="container py-3">
                                    <div class="row">
                                        <div class="col">
                                            <table id="example" class="table table-bordered" cellspacing="0"
                                                width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Mobile Number</th>
                                                        <th>WD Code</th>
                                                        <th>Volume of Flake Mint</th>
                                                        <th>Volume of Flake Liberty</th>
                                                        <th>Created At</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Mobile Number</th>
                                                        <th>WD Code</th>
                                                        <th>Volume of Flake Mint</th>
                                                        <th>Volume of Flake Liberty</th>
                                                        <th>Created At</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="html_tab_9">
                                <div class="hk-code-block">
                                    <button class="btn btn-icon btn-xs btn-flush-light btn-rounded flush-soft-hover"
                                        data-clipboard-snippet><span class="btn-icon-wrap"><span class="feather-icon"><i
                                                    data-feather="copy"></i></span></span></button>
                                    <pre class="language-markup"></pre>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="script_tab_9">
                                <div class="hk-code-block">
                                    <button class="btn btn-icon btn-xs btn-flush-light btn-rounded flush-soft-hover"
                                        data-clipboard-snippet><span class="btn-icon-wrap"><span class="feather-icon"><i
                                                    data-feather="copy"></i></span></span></button>
                                    <pre class="language-javascript"></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="modal fade" id="uploadCSV" tabindex="-1" role="dialog" aria-labelledby="uploadCSVTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadCSVTitle">Upload CSV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.bulk_wholesalers_upload') }}" method="POST" enctype="multipart/form-data">
                    <!-- @csrf -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <p>Download a <a href="{{ asset('sample_csv/wholesalers.csv') }}" download>sample CSV
                                        template</a> to see an example of the format required.</p>
                                <div class="mt-3">
                                    <label for="formFile" class="form-label">Import CSV</label>
                                    <input class="form-control" type="file" name="file" accept=".csv" required="">
                                    <small>Only <code>.csv</code> files.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary waves-effect waves-light">Upload</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    @endsection

    @section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Only needed for the filename of export files.
            // Normally set in the title tag of your page.
            document.title = "Wholesalers Survey Form Data";

            // Create search inputs in footer
            $("#example tfoot th").each(function () {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            });

            // DataTable initialisation
            var table = $("#example").DataTable({
                dom: '<"dt-buttons"Bf><"clear">lirtp',
                paging: true,
                autoWidth: true,
                responsive: true,
                stateSave: true,
                processing: true,
                serverSide: true,
                deferRender: true,  // Delay rendering of table
                language: {
                    search: "",
                    searchPlaceholder: "Search",
                    sLengthMenu: "_MENU_ items",
                    paginate: {
                        next: '<i class="ri-arrow-right-s-line"></i>', // or '→'
                        previous: '<i class="ri-arrow-left-s-line"></i>' // or '←'
                    }
                },
                buttons: [
                    "colvis",
                    "csvHtml5",
                    "excelHtml5",
                ],
                initComplete: function (settings, json) {
                    var footer = $("#example tfoot tr");
                    $("#example thead").append(footer);
                },
                ajax: "{{ route('admin.wholesalers-survey-form.list') }}",
                columns: [
                    {
                        data: 'full_name',
                        name: 'full_name',
                        render: function (data, type, row) {
                            var full_name = row.full_name;
                            @can('wholesaler_show')
                                var showUrl = '{{ route('admin.wholesalers.show', ':wholesalerID') }}'.replace(':wholesalerID', row.id);
                                full_name = '&emsp;<a href="' + showUrl + '" class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View">' + row.full_name + '</a>';
                            @endcan
                            return full_name;
                        }
                    },
                    {
                        data: 'mobile_number',
                        name: 'mobile_number'
                    },
                    {
                        data: 'wd.code',
                        name: 'wd.code',
                        // render: function (data, type, row) {
                        //     if (row.wd) {
                        //         var wd = row.wd.code;
                        //         @can('wholesaler_show')
                            //             var showUrl = '{{ route('admin.wds.show', ':wdID') }}'.replace(':wdID', row.wd.id);
                            //             wd = '&emsp;<a href="' + showUrl + '" class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View">' + row.wd.code + '</a>';
                        //         @endcan
                        //     } else {
                        //         wd = '<span class="badge badge-pill badge-soft-danger font-size-11">N/A</span>';
                        //     }
                        //     return wd;
                        // }
                    },
                    {
                        data: 'volume_flake_mint',
                        name: 'volume_flake_mint',
                        // render: function (data, type, row) {
                        //     if (row.pincode) {
                        //         var pincode_name = row.pincode.code;
                        //         @can('pincode_show')
                            //             var showUrl = '{{ route('admin.pincodes.show', ':pincodeID') }}'.replace(':pincodeID', row.pincode.id);
                            //             pincode_name = '&emsp;<a href="' + showUrl + '" class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View">' + row.pincode.code + '</a>';
                        //         @endcan
                        //         return pincode_name;
                        //     } else {
                        //         return '<span class="badge badge-pill badge-soft-danger font-size-11">N/A</span>'
                        //     }
                        // }
                    },
                    {
                        data: 'volume_flake_liberty',
                        name: 'volume_flake_liberty',
                        // render: function (data, type, row) {
                        //     if (row.city) {
                        //         var city_name = row.city.name;
                        //         @can('city_show')
                            //             var showUrl = '{{ route('admin.cities.show', ':cityID') }}'.replace(':cityID', row.city.id);
                            //             city_name = '&emsp;<a href="' + showUrl + '" class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View">' + row.city.name + '</a>';
                        //         @endcan
                        //         return city_name;
                        //     } else {
                        //         return '<span class="badge badge-pill badge-soft-danger font-size-11">N/A</span>'
                        //     }
                        // }
                    },


                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function (data, type, row) {
                            var d = new Date(row.created_at);
                            var month = ("0" + (d.getMonth() + 1)).slice(-2);
                            var day = ("0" + d.getDate()).slice(-2);
                            return d.getFullYear() + '-' + month + '-' + day + ' ' + d.toTimeString().split(' ')[0];
                        }
                    },
                    {
                        data: 'id',
                        render: function (data, type, row) {
                            var del = '';
                            @can('wholesaler_survey_form_delete')
                                del = '<button class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover delete-button" data-id="' + row.id + '" data-bs-original-title="Delete"> <span class="nav-icon-wrap"><i class="ri-delete-bin-6-fill"></i></span></button>';
                            @endcan

                            return del;

                        }
                    }
                ]
            });

            // Apply the search
            $("#example thead").on("keyup", "input", function () {
                table.column($(this).parent().index())
                    .search(this.value)
                    .draw();
            });

            $(document).on('click', '.delete-button', function () {
                var surveyID = $(this).data('id');
                Swal.fire({
                    title: "Are you sure?",
                    text: "This action cannot be undone!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        var url = '{{ route("admin.wholesaler-survey-form.destroy", ":surveyID") }}';
                        url = url.replace(':surveyID', surveyID);
                        $.ajax({
                            url: url,
                            type: 'GET',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                Swal.fire("Deleted!", response.message, "success");
                                // Refresh the table or remove the row
                                $('#example').DataTable().ajax.reload();
                            },
                            error: function (response) {
                                Swal.fire("Error!", "Unable to delete the wholesaler.", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>
    @endsection