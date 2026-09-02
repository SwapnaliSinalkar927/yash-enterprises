@extends('admin.main')

@section('title', 'Admin Users')

@section('style')
    <style>
        .table-card-line {
            height: 4px !important;
        }
    </style>
@endsection

@section('content')
<div class="hk-pg-wrapper">
    <div class="container-fluid p-5 pb-0">
        <h4 class="mb-sm-0 font-size-18">
        {{ $user->name }}'s Detail
            {!! ($user->status==1) ? '<span class="badge badge-sm badge-success">Active</span>' : '<span class="badge badge-sm badge-danger">Inactive</span>' !!}
            <!-- <span class="badge badge-sm badge-success">Active</span> -->
        </h4>
        <div class="hk-pg-body mt-2">
            <div class="tab-pane fade show active" id="tab_block_1">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card card-wth-line">
                            <div class="card-line bg-primary table-card-line"></div>
                            <!-- <div class="card-body"></div> -->
                            <table class="table mb-0 mt-2" style="overflow-x:auto;display:table;">
                                <tbody>
                                    <tr>
                                        <th scope="row">Full Name :</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">E-mail :</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Roles :</th>
                                        <td>
                                            @foreach($user->roles as $role)
                                            <a href="{{ route('admin.roles.show', $role->id) }}">
                                            <span class="me-1 badge bg-info" title="{{ $role->name }}">{{ $role->slug }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Joined  :</th>
                                        <td class="created_at">
                                           
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Last Logged In At  :</th>
                                        <td>
                                        {!! $last_logged_in_at?->diffForHumans() ?? '<i class="text-muted">Not Available</i>' !!}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="card-footer text-muted"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $( document ).ready(function() {
            created_at_data = "{{ $user->created_at }}";
            result = formattedDateTime(created_at_data);
            $(".created_at").html(result);
        });
    </script>
@endsection