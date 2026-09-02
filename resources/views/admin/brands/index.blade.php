@extends('admin.main')

@section('title', 'View Brands')

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
                        <h4>Brands List</h4>
                        @can('brand_create')
                        <div class="page-title-right">
                                <!-- Example split danger button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary add"><a class="text-white" href="{{ route('admin.brands.create') }}">Add Brands</a></button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-chevron-down"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.brands.create') }}">Add
                                                </a>
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#uploadCSV">Add Bulk
                                        Brands</a>
                                    </div>
                                </div>
                            </div>
                        @endcan
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
                                                        <th>Name</th>
                                                        <th>Short Code</th>
                                                        <th>Status</th>
                                                        <th>Created At</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>                                                 
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Short Code</th>
                                                        <th>Status</th>
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
                <form action="{{ route('admin.bulk_brand_upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <p>Download a <a href="{{ asset('sample_csv/brand.csv') }}" download>sample CSV template</a> to see an example of the format required.</p>
                                <div class="mt-3">
                                    <label for="formFile" class="form-label">Import CSV</label>
                                    <input type="hidden" name="table" value="wds">
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
                ajax: "{{ route('admin.brands.list') }}",
                columns: [
                    { 
                        data: 'name', 
                        name: 'name',
                        render: function(data, type, row) {
                            var name = row.name;
                            @can('brand_show')
                                var showUrl = '{{ route('admin.brands.show',':brandID') }}'.replace(':brandID', row.id);
                                name = '&emsp;<a href="'+showUrl+'" class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View">'+row.name+'</a>';
                            @endcan
                            return name;
                        }
                    },
                    { 
                        data: 'short_code',
                        name: 'short_code',
                        render: function(data, type, row) {
                            return row.short_code;
                        }
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            if (row.status == 1) {
                                return '<span class="badge badge-pill badge-soft-success font-size-11">Active</span>';
                            } else {
                                return '<span class="badge badge-pill badge-soft-danger font-size-11">Inactive</span>';
                            }
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
                            var edit = '';
                            var show = '';
                            var del = '';
                            @can('brand_edit')
                                var editURL = '{{ route('admin.brands.edit',':brandID') }}'.replace(':brandID', row.id);
                                edit = '<a href="'+editURL+'" class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover edit-button" data-bs-original-title="Edit"> <span class="nav-icon-wrap"><i class="ri-pencil-fill"></i></span></a>';
                            @endcan
                            @can('brand_show')
                                var showUrl = '{{ route('admin.brands.show',':brandID') }}'.replace(':brandID', row.id);
                                show = '<a href="'+showUrl+'" class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover view-button" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="View"> <span class="nav-icon-wrap"><i class="ri-eye-fill"></i></span></a>';
                            @endcan

                            @can('brand_delete')
                                del = '<button class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover delete-button" data-id="'+row.id+'" data-bs-original-title="Delete"> <span class="nav-icon-wrap"><i class="ri-delete-bin-6-fill"></i></span></button>';
                            @endcan
                            return edit + show + del;
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
        });

        $(document).on('click', '.delete-button', function() {
            var brandID = $(this).data('id');
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
                        url: '{{ route('admin.brands.destroy', ':brandID') }}'.replace(':brandID', brandID),
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
                            Swal.fire("Error!", "Unable to delete the Brand.", "error");
                        }
                    });
                }
            });
        });

    </script>
@endsection
