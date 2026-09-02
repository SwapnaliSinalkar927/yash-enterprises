@extends('admin.main')

@section('title', 'Edit User')

@section('style')
    <style>
        label,
        .status-title {
            font-weight: 700 !important;
            font-size: 13px !important;
            margin-bottom: 0.3rem;
        }
    </style>
@endsection

@section('content')
    <div class="hk-pg-wrapper">
        <div class="container-fluid p-5 pb-0">
            <h4 class="mb-sm-0 font-size-18">
                Edit User
            </h4>
            <div class="hk-pg-body mt-2">
                <div class="tab-pane fade show active" id="tab_block_1">
                    <form action="{{ route('admin.users.update', [$user->id]) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="card card-wth-line">
                                    <div class="card-line bg-primary"></div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="name">Name.:</label>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $user->name }}" id="name" name="name" required>
                                                    @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="email">Email.:</label>
                                                    <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ?? $user->email }}" id="email" name="email" required>
                                                    @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="password">Password.:</label>
                                                    <div class="input-group auth-pass-inputgroup">
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" id="password" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon" required autocomplete="off">
                                                        <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                                    </div>
                                                    @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="roles">Roles.:</label>
                                                    <select class="form-control @error('roles') is-invalid @enderror multiple-select" name="roles[]"  data-placeholder="-- Please select --" multiple="multiple" id="roles">
                                                        @foreach ($roles as $role) 
                                                        <option value="{{ $role->id }}" {{ in_array($role->id, old('roles', $user->roles->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $role->slug }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('roles')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-muted"></div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="card card-wth-line">
                                    <div class="card-line bg-warning"></div>
                                    <div class="card-body mb-1">
                                        <h5 class="card-title">Status:</h5>
                                        <select name="status" id="activeStatus" class="form-select">
                                            <option value="1" {{ $user->status == "1" || old('status')== "1"  ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $user->status == "0" || old('status')== "0"  ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="card-footer text-muted"></div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-rounded" style="float:right">Submit</button>
                    </form>
                </div>
            </div>
        </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){

            $('.multiple-select').select2({
                theme: "classic",
            });

            $('.multiple-select').each(function() {
                var select = $(this);
                var selectAllOption = $('<option></option>').val('select-all').text('Select All');
                var isSelectAll = false;

                select.prepend(selectAllOption).select2({
                    placeholder: select.data('placeholder'),
                    allowClear: true
                });
                select.on('select2:select', function(e) {
                    if (e.params.data.id === 'select-all') {
                        isSelectAll = true;
                        select.find('option').prop('selected', true);
                        select.trigger('change.select2');
                        selectAllOption.text('Deselect All');
                        select.find('[value="select-all"]').text('Deselect All');
                    } else if (select.find('option').length === select.find('option:selected').length + 1) {
                        selectAllOption.prop('selected', true);
                        select.trigger('change.select2');
                        // selectAllOption.text('Deselect All');
                        select.find('[value="select-all"]').text('Deselect All');
                    }
                });

                select.on('select2:unselect', function(e) {
                    if (e.params.data.id === 'select-all') {
                        isSelectAll = false;
                        select.find('option').prop('selected', false);
                        select.trigger('change.select2');
                        selectAllOption.text('Select All');
                        select.find('[value="select-all"]').text('Select All');
                    } else if (isSelectAll) {
                        selectAllOption.prop('selected', false);
                        select.trigger('change.select2');
                        // selectAllOption.text('Select All');
                        select.find('[value="select-all"]').text('Select All');
                        isSelectAll = false;
                    }
                });
            });

            $('#name').on('keyup', function() {
                var slug = $(this).val().toLowerCase().replace(/[^a-z0-9]+/g,'_');
                $('#slug').val(slug);
            });
        });
    </script>
@endsection
