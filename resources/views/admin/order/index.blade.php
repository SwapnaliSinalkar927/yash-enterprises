@extends('admin.main')

@section('title', 'View Order')

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
                    @if(\Session::get('status') == 'failed')
                        @include('admin.components.server-alert', ['status' => \Session::get('status')])
                    @endif
                    @if(\Session::get('status') == 'success')
                        @include('admin.components.server-alert', ['status' => \Session::get('status')])
                    @endif
                </div>
            </div>
            <section id="sec_10" class="hk-section" >
                <div class="hk-example card card-shadow card-wth-tabs  mt-3" >
                    <div class="card-header">
                        <h4>Wholesaler Order List</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content m-0">
                            <div class="tab-pane fade show active" id="prev_tab_9">
                                <div class="container py-3">
                                    <div class="row">
                                        <div class="col">
                                            <table id="example" class="table table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Wholesaler</th>
                                                        <th>Code Used</th>
                                                        <th>Value</th>
                                                        <th>Brand</th>
                                                        <th>Created At</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>                                                 
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Wholesaler</th>
                                                        <th>Code Used</th>
                                                        <th>Value</th>
                                                        <th>Brand</th>
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

    <div class="modal fade" id="uploadCSV" tabindex="-1" role="dialog" aria-labelledby="uploadCSVTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadCSVTitle">Upload CSV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.bulk_cities_upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <p>Download a <a href="{{ asset('sample_csv/cities.csv') }}" download>sample CSV template</a> to see an example of the format required.</p>
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
    <script type="text/javascript">
        $(document).ready(function() {
            // Create search inputs in footer
            $("#example tfoot th").each(function() {
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
                initComplete: function(settings, json) {
                    var footer = $("#example tfoot tr");
                    $("#example thead").append(footer);
                },
                ajax: {
                    url: "{{ route('admin.orders.list') }}", // base route without query params
                    data: function(d) {
                        d.wd_id = "{{ request()->get('wd_id') }}";          
                        d.wholesaler_id = "{{ request()->get('wholesaler_id') }}";
                        d.brand_id = "{{ request()->get('brand_id') }}";
                    }
                },
                columns: [
                    { 
                        data: 'wholesaler.full_name', 
                        name: 'wholesaler.full_name',
                        render: function(data, type, row) {
                            var name = row.wholesaler.full_name;
                            @can('wholesaler_show')
                                var showUrl = '{{ route('admin.wholesalers.show',':wholesalerID') }}'.replace(':wholesalerID', row.wholesaler.id);
                                name = '&emsp;<a href="'+showUrl+'" class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View">'+row.wholesaler.full_name+'</a>';
                            @endcan
                            return name;
                        }
                    },
                    { 
                        data: 'code.code', 
                        name: 'code.code',
                        render: function(data, type, row) {
                            var code = row.code.code;
                            @can('code_show')
                                var showUrl = '{{ route('admin.generate-codes.show',':codeID') }}'.replace(':codeID', row.code.id);
                                code = '&emsp;<a href="'+showUrl+'" class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View">'+row.code.code+'</a>';
                            @endcan
                            return code;
                        }
                    },
                    { 
                        data: 'value',
                        name: 'value',
                        render: function(data, type, row) {
                            if(row.value)
                                return row.value;
                            else{
                                return '<i class="text-danger">NA</i>';
                            }
                        }
                    },
                    { 
                        data: 'brand.name', 
                        name: 'brand.name',
                        render: function(data, type, row) {
                            // var brand = row.brand.name;
                            // return brand;
                            var brand = row.brand.name;
                            @can('brand_show')
                                var showUrl = '{{ route('admin.brands.show',':brandID') }}'.replace(':brandID', row.brand.id);
                                brand = '&emsp;<a href="'+showUrl+'" class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View">'+row.brand.name+'</a>';
                            @endcan
                            return brand;
                        }
                    },
                    { 
                        data: 'created_at', 
                        name: 'created_at',
                        render: function(data, type, row) {
                            var d = new Date(row.created_at);
                            var month = ("0" + (d.getMonth() + 1)).slice(-2);
                            var day = ("0" + d.getDate()).slice(-2);
                            return d.getFullYear() + '-' + month + '-' + day + ' ' + d.toTimeString().split(' ')[0];
                        }
                    },
                    { 
                        data: 'id',
                        render: function(data, type, row) {
                            var del = '';
                             @can('order_deletes')
                                del = '<button class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover delete-button" data-id="'+row.id+'" data-bs-original-title="Delete"> <span class="nav-icon-wrap"><i class="ri-delete-bin-6-fill"></i></span></button>';
                            @endcan
                            return del;
                        }
                    }
                ]
            });

            // Apply the search
            $("#example thead").on("keyup", "input", function() {
                table.column($(this).parent().index())
                    .search(this.value)
                    .draw();
            });
            $(document).on('click', '.delete-button', function() {
                var orderID = $(this).data('id');
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
                        $.ajax({
                            url: '{{ route('admin.orders.destroy', ':orderID') }}'.replace(':orderID', orderID),
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire("Deleted!", response.message, "success");
                                // Refresh the table or remove the row
                                $('#example').DataTable().ajax.reload();
                            },
                            error: function(response) {
                                Swal.fire("Error!", "Unable to delete the Order.", "error");
                            }
                        });
                    }
                });
            });
        });

    </script>
@endsection
