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

        .input-file {
            background: #ccc;
            padding: 8px;
        }

        .image-append {
            margin-top: 15px;
            max-width: 180px;
        }

        #custom_slug {
            margin-top: 10px;
        }

        #text-custom-slug {
            color: #333;
            font-weight: 600;
            font-size: 14px;
            margin-left: 10px;
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
                            <strong>Thêm mới danh mục</strong>
                        </div>
                        <div class="card-body card-block">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="form-add-category" class="form-horizontal" enctype="multipart/form-data"
                                          method="POST">
                                        @csrf
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input"
                                                                             class=" form-control-label">Chọn danh mục
                                                    cha</label></div>
                                            <div class="col-12 col-md-9">
                                                <select id="cat_parent_id" name="cat_parent_id" class="form-control">
                                                    <option value="0">Chọn danh mục cha</option>
                                                    {{ CustomHelpers::menu($categories) }}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input"
                                                                             class=" form-control-label">Ảnh đại
                                                    diện</label></div>
                                            <div class="col-12 col-md-9">
                                                <div class="input-file">
                                                    <input type='file' onchange="readURL(this);" name="cat_image"
                                                           id="cat_image"/>
                                                </div>
                                                <div class="image-append">
                                                    <img id="avatar" src="http://placehold.it/180" alt="your image"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input"
                                                                             class=" form-control-label">Tên danh
                                                    mục</label></div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="cat_name" name="cat_name"
                                                       placeholder="Tên danh mục"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input"
                                                                             class=" form-control-label">Slug</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" name="cat_slug" id="cat_slug" disabled
                                                       placeholder="Mặc định ( Ví dụ: quan-ao-dep)"
                                                       class="form-control">
                                                <input type="checkbox" id="custom_slug"><span id="text-custom-slug">Custom Slug</span>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="textarea-input"
                                                                             class=" form-control-label">Mô tả</label>
                                            </div>
                                            <div class="col-12 col-md-9"><textarea name="cat_description"
                                                                                   id="cat_description"
                                                                                   rows="5" placeholder="Mô tả..."
                                                                                   class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input"
                                                                             class=" form-control-label">Seo
                                                    Description</label></div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="cat_seo_description" name="cat_seo_description"
                                                       placeholder="Seo Description"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="text-input"
                                                                             class=" form-control-label">Seo
                                                    Keyword</label></div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="cat_seo_keyword" name="cat_seo_keyword"
                                                       placeholder="Seo Keyword"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="select" class=" form-control-label">Trạng
                                                    thái</label></div>
                                            <div class="col-12 col-md-9">
                                                <select name="cat_status" id="cat_status" class="form-control">
                                                    <option value="1">Hiện</option>
                                                    <option value="2">Ẩn</option>
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
        $('#form-add-category').validate({
            rules: {
                cat_name: {
                    required: true,
                },
            },
            messages: {
                cat_name: {
                    required: 'Vui lòng nhập tên danh mục',
                },
            },
            submitHandler: function (e) {
                var cat_parent_id = $('#cat_parent_id').val();
                var cat_name = $('#cat_name').val();
                var cat_slug = $('#cat_slug').val();
                var cat_description = $('#cat_description').val();
                var cat_seo_description = $('#cat_seo_description').val();
                var cat_seo_keyword = $('#cat_seo_keyword').val();
                var cat_status = $('#cat_status').val();
                var file_data = $('#cat_image').prop('files')[0];

                var form_data = new FormData();
                form_data.append('cat_image', file_data);
                form_data.append('cat_parent_id', cat_parent_id);
                form_data.append('cat_name', cat_name);
                form_data.append('cat_slug', cat_slug);
                form_data.append('cat_description', cat_description);
                form_data.append('cat_seo_description', cat_seo_description);
                form_data.append('cat_seo_keyword', cat_seo_keyword);
                form_data.append('cat_status', cat_status);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route('post-store-category') }}',
                    data: form_data,
                    dataType: 'json',
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        if (data.status == true) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Thêm danh mục thành công',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            window.location.href = "{{ route('page-categories') }}";
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Thêm danh mục thất bại',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            return false;
                        }
                    },
                    error: function (error) {
                        var errorMes = error.responseJSON.messages;
                        if (errorMes.cat_name) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Tên danh mục đã tồn tại',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            return false;
                        }
                        if (errorMes.cat_slug) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Slug danh mục đã tồn tại',
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
@section('scripts')
    <script>
        $('#custom_slug').change(function () {
            if ($(this).prop("checked") == true) {
                $('#cat_slug').prop('disabled', false);
            } else {
                $('#cat_slug').prop('disabled', true);
                $('#cat_slug').val('');
            }
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#avatar').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
