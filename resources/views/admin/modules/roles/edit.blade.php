@extends('admin.layouts.master')
@section('styles')
    <style>
        label.error {
            display: inline-block;
            color: #d71212;
            width: 100%;
            font-size: 13px;
            font-weight: 600;
            text-transform: capitalize;
            margin-top: 5px;
        }
    </style>
@endsection
@section('main')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Cập nhật Roles</strong>
                        </div>
                        <div class="card-body card-block">
                            <div class="row">
                                <div class="col-md-4">
                                    <h5 class="card-title">
                                        Role Details
                                    </h5>
                                    <p class="text-muted">
                                        A general role information.
                                    </p>
                                </div>
                                <div class="col-lg-8">
                                    <form id="form-edit-role" class="form-horizontal">
                                        @csrf
                                        <input type="hidden" name="id" id="role_id" value="{{ $role->id }}">
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên quyền</label></div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="role_name" name="name" value="{!! old('role_name', $role->name) !!}" placeholder="Tên quyền" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Tên hiển thị</label></div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="role_name_display" name="label" value="{!! old('role_name_display', $role->label) !!}" placeholder="Tên hiển thị" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Mô tả</label></div>
                                            <div class="col-12 col-md-9"><textarea name="description" id="role_des" rows="5" placeholder="Mô tả..." class="form-control">{!! old('role_des', $role->description) !!}</textarea></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="select" class=" form-control-label">Trạng thái</label></div>
                                            <div class="col-12 col-md-9">
                                                <select name="status" id="role_status" class="form-control">
                                                    <option value="{{ old('role_status', $role->status) }}">{{ $role->status == 1 ? 'Hiện' : 'Ẩn' }}</option>
                                                    @if($role->status === 2)
                                                    <option value="1">Hiện</option>
                                                    @elseif($role->status === 1)
                                                    <option value="2">Ẩn</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fa fa-dot-circle-o"></i> Save
                                            </button>
                                            <button type="reset" class="btn btn-danger btn-sm">
                                                <i class="fa fa-ban"></i> Reset
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div>
@endsection
@section('ajax')
    <script>
        $('#form-edit-role').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 4,
                    maxlength: 60,
                },
                label: {
                    required: true,
                    minlength: 4,
                    maxlength: 60,
                },
            },
            messages: {
                name: {
                    required: 'Vui lòng nhập tên quyền',
                    minlength: 'Tên quyền tối thiểu 4 kí tự',
                    maxlength: 'Tên quyền tối đa 60 kí tự'
                },
                label: {
                    required: 'Vui lòng nhập tên hiển thị',
                    minlength: 'Tên quyền tối thiểu 4 kí tự',
                    maxlength: 'Tên quyền tối đa 60 kí tự'
                },
            },
            submitHandler: function () {
                var role_id = $('#role_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    cache: false,
                    url: '{{ route('post-update-role') }}',
                    data: {
                        id: role_id,
                        name: $('#role_name').val(),
                        label: $('#role_name_display').val(),
                        description: $('#role_des').val(),
                        status: $('#role_status').val(),
                    },
                    dataType: 'json',
                    success: function(data){
                        if(data.result == true) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Cập nhật Role thành công',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            window.location.href = "{{ route('page-roles') }}";
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Cập nhật Role thất bại',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            return false;
                        }
                    },
                    error: function(error){
                        var errorMes = error.responseJSON.messages;
                        if(errorMes) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Cập nhật Role thất bại',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            return false;
                        }
                    }
                });
            }
        });
    </script>
@endsection
