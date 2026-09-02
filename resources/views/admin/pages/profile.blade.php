

@extends('admin.main')

@section('title', 'Profile Info')

@section('style')
    <style>
        .status{
            border-bottom:white !important;
        }
    </style>
@endsection

@section('content')
<div class="hk-pg-wrapper">
    <div class="container-fluid p-5 pb-0">
        <h4 class="mb-sm-0 font-size-18">
        @yield('title')
        </h4>
        <div class="hk-pg-body">
            <div class="tab-pane fade show active" id="tab_block_1">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="card card-wth-line">
                            <div class="card-line bg-primary table-card-line"></div>
                            <table class="table mt-2" style="overflow-x:auto;display:table;">
                                <tbody>
                                    <tr>
                                        <th scope="row">Full Name :</th>
                                        <td>{{ $currentUser->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">E-mail :</th>
                                        <td>{{ $currentUser->email }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Roles :</th>
                                        <td>
                                            @foreach($currentUser->roles as $role)
                                            <span class="me-1 badge bg-info" title="{{ $role->name }}">{{ $role->slug }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Joined  :</th>
                                        <td>
                                            <span title="{{ $currentUser->created_at->format('d-m-Y h:i:sa') }}">{{ $currentUser->created_at->diffForHumans() }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection