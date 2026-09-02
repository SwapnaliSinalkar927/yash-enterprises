@extends('admin.main')

@section('title', 'View Roles')

@section('style');
<style type="text/css">
    .more-permissions{
        font-size: 11px;
        cursor: pointer;
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
                        <h4>Roles List</h4>
                        {{-- <button type="button" class="btn btn-primary btn-rounded">Add Roles</button> --}}
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-rounded">Add Roles</a>
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
                                                        <th>Slug</th>
                                                        {{-- <th>Permissions</th> --}}
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
                                                        <th>Slug</th>
                                                        {{-- <th>Permissions</th> --}}
                                                        <th>Status</th>
                                                        <th>Created At</th>
                                                        <th></th>
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
@endsection

@section('script')
    <script type="text/javascript">
        $('.more-permissions').click(function() {
            $this = $(this);
            var $permissionList = $this.parent('.permission-list');
            console.log($permissionList);
            $.ajax({
                url: "{{ route('admin.more-permission-for-role',['role_id' => ':role_id']) }}".replace(':role_id',$permissionList.data('role-id')),
                success: function(data) {
                    $permissionList.find('.badge').remove();
                    $.each(data, function(index, item) {
                        $permissionShow = "{{ route('admin.permissions.show', ':permission_id') }}".replace(':permission_id', item.id);
                        $permissionList.append('<a href="' + $permissionShow + '" title="View ' + item.name + '"> <span class="me-1 badge ' + (item.status === 1 ? 'bg-info' : 'bg-danger') + '">' + item.slug + '</span></a>');
                    });
                    $this.hide();
                }
            });
        });

        $(document).ready(function() {
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
                //    scrollX:true,
                language: { search: "",
                    searchPlaceholder: "Search",
                    sLengthMenu: "_MENU_items",
                    paginate: {
                        next: '<i class="ri-arrow-right-s-line"></i>', // or '→'
                        previous: '<i class="ri-arrow-left-s-line"></i>' // or '←'
                    }
                },
                buttons: [
                    "colvis",
                    // "copyHtml5",
                    "csvHtml5",
                    "excelHtml5",
                    // "pdfHtml5",
                    // "print"
                ],
                initComplete: function(settings, json) {
                    var footer = $("#example tfoot tr");
                    $("#example thead").append(footer);
                },
                // scrollX:  true,
                type: 'GET',
                ajax: "{{ route('admin.role.list') }}",
                columns: [
                    { data: 'name', name: 'name' ,
                        render : function(data, type, row) {
                            name = row.name
                            // return '<a href="">'+row.name+'</a>';
                            @can('role_show')
                                url = '{{ route('admin.roles.show',':roleID') }}'.replace(':roleID', row.id);
                                name = '&emsp;<a href="'+url+'" class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View">'+row.name+'</a>';
                            @endcan
                            return name;

                        }
                    },
                    { data: 'slug', name: 'slug' ,
                        render : function(data, type, row) {
                        
                            return row.slug;
                        }
                    },
                    /*{ data: 'permissions', name: 'permissions' ,
                        render : function(data, type, row) {
                            return permissions;
                        }
                    },*/
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {

                            // return row.status;
                            if (row.status == 1) {
                                return '<span class="badge badge-pill badge-soft-success font-size-11">Active</span>';
                            } else {
                                return '<span class="badge badge-pill badge-soft-danger font-size-11">Inactive</span>';
                            }
                        }
                    },
                
                    { data: 'created_at', name: 'created_at' ,
                        render : function(data, type, row) {
                        
                            var d = new Date(row.created_at);
                            month = ("0" + (d.getMonth() + 1)).slice(-2);
                            day = ("0" + d.getDate()).slice(-2);
                            return d.getFullYear() + '-' + month + '-' + day + ' ' + d.toTimeString().split(' ')[0];
                        }
                    },
                    { data: 'id',
                        render : function(data, type, row) {
                            view = edit = '';

                            @can('role_edit')
                                editURL = '{{ route('admin.roles.edit',':permroleID') }}'.replace(':permroleID', row.id);
                                edit = '<a href="'+editURL+'" class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover edit-button" data-bs-original-title="Edit"> <span class="nav-icon-wrap"><i class="ri-pencil-fill"></i></span></a>';
                        @endcan
                        
                        @can('role_show')
                                url = '{{ route('admin.roles.show',':permroleID') }}'.replace(':permroleID', row.id);
                                view = '<a href="'+url+'" class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover view-button" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="View"> <span class="nav-icon-wrap"><i class="ri-eye-fill"></i></span></a>';
                            @endcan

                    
                        
                            return view+edit;
                        }
                    },
            
                ]
            });

            // Apply the search
            $("#example thead").on("keyup", "input", function() {
                table.column($(this).parent().index())
                    .search(this.value)
                    .draw();
            });
        });

    </script>
@endsection
