@extends('admin.main')

@section('title', 'View Users')

@section('style')
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
                        <h4>Users List</h4>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-rounded">Add Users</a>
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
                                                        <th>Email</th>
                                                        <!-- <th>Roles</th> -->
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
                                                        <th>Email</th>
                                                        <!-- <th>Roles</th> -->
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
        $('.more-roles').click(function() {
            $this = $(this);
            var $roleList = $this.parent('.role-list');
            console.log($roleList);
            $.ajax({
                url: "{{ route('admin.more-role-for-user',['user_id' => ':user_id']) }}".replace(':user_id',$roleList.data('user-id')),
                success: function(data) {
                    $roleList.find('.badge').remove();
                    $.each(data, function(index, item) {
                        $roleShow = "{{ route('admin.roles.show', ':role_id') }}".replace(':role_id',item.id);
                        $roleList.append('<a href="' + $roleShow + '" title="View ' + item.name + '"> <span class="me-1 badge ' + (item.status === 1 ? 'bg-info' : 'bg-danger') + '">' + item.slug + '</span></a>');
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
                ajax: "{{ route('admin.users.list') }}",
                columns: [
                    { data: 'name', name: 'name' ,
                        render : function(data, type, row) {
                            name = row.name
                            // return '<a href="">'+row.name+'</a>';
                            @can('user_show')
                                url = '{{ route('admin.users.show',':userID') }}'.replace(':userID', row.id);
                                name = '&emsp;<a href="'+url+'" class="mr-3 text-info" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View">'+row.name+'</a>';
                            @endcan
                            return name;

                        }
                    },
                    { data: 'email', name: 'email' ,
                        render : function(data, type, row) {
                        
                            return row.email;
                        }
                    },
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
                            view = edit = permission_delete = '';

                            @can('user_edit')
                                editURL = '{{ route('admin.users.edit',':userID') }}'.replace(':userID', row.id);
                                edit = '<a href="'+editURL+'" class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover edit-button" data-bs-original-title="Edit"> <span class="nav-icon-wrap"><i class="ri-pencil-fill"></i></span></a>';
                        @endcan
                        
                        @can('user_show')
                                url = '{{ route('admin.users.show',':userID') }}'.replace(':userID', row.id);
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
