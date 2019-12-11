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
                        <strong>Cập nhật thương hiệu </strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="form-edit-brand" class="form-horizontal" enctype="multipart/form-data"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="id" id="brand_id" value="{{ $brands->id }}">
                                    <input type="hidden" value="{{ $brands->br_image }}" id="img_old" name="img_old">
                                    <input type="hidden" value="{{ $brands->br_slug }}" id="slug_old" name="slug_old">
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Ảnh thương hiệu</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <div class="input-file">
                                                <input type='file' onchange="readURL(this);" name="br_image" id="br_image" />
                                            </div>
                                            <div class="image-append">
                                                <img id="avatar"
                                                    src="{{ $brands->br_image ? asset('uploads/brands/'.$brands->br_image) : 'http://placehold.it/180'}}"
                                                    alt="your image" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="text-input" class=" form-control-label">Tên thương hiệu</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="br_name" name="br_name"
                                                value="{{ old('br_name', $brands->br_name ? $brands->br_name : 'Dữ liệu trống') }}"
                                                placeholder="Tên danh mục" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input"
                                                class=" form-control-label">Slug</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" name="br_slug" id="br_slug"
                                                value="{{ old('br_slug', $brands->br_slug ? $brands->br_slug : 'Dữ liệu trống') }}"
                                                disabled placeholder="Mặc định ( Ví dụ: quan-ao-dep)"
                                                class="form-control">
                                            <input type="checkbox" id="custom_slug"><span id="text-custom-slug">Custom
                                                Slug</span>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="textarea-input"
                                                class=" form-control-label">Mô tả</label>
                                        </div>
                                        <div class="col-12 col-md-9"><textarea name="br_description" id="br_description"
                                                rows="5" placeholder="Mô tả..."
                                                class="form-control">{{ $brands->br_description ? $brands->br_description : 'Dữ liệu trống' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input"
                                                class=" form-control-label">Seo
                                                Description</label></div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="br_seo_description" name="br_seo_description"
                                                value="{{ old('br_seo_description', $brands->br_seo_description ? $brands->br_seo_description : 'Dữ liệu trống') }}"
                                                placeholder="Seo Description" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input"
                                                class=" form-control-label">Seo
                                                Keyword</label></div>
                                        <div class="col-12 col-md-9">
                                            <input type="text" id="br_seo_keyword" name="br_seo_keyword"
                                                value="{{ old('br_seo_keyword', $brands->br_seo_keyword ? $brands->br_seo_keyword : 'Dữ liệu trống') }}"
                                                placeholder="Seo Keyword" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="select" class=" form-control-label">Trạng thái</label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <select name="br_status" id="br_status" class="form-control">
                                                <option value="{{ old('br_status', $brands->br_status) }}">
                                                    {{ $brands->br_status == 1 ? 'Hiện' : 'Ẩn' }}</option>
                                                @if($brands->br_status === 2)
                                                <option value="1">Hiện</option>
                                                @elseif($brands->br_status === 1)
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
    $('#form-edit-brand').validate({
        rules: {
            br_name: {
                required: true,
            },
        },
        messages: {
            br_name: {
                required: 'Vui lòng nhập tên thương hiệu',
            },
        },
        submitHandler: function (e) {
            var brand_img_old = $('#img_old').val();
            var brand_slug_old = $('#slug_old').val();
            var brand_id = $('#brand_id').val();
            var br_name = $('#br_name').val();      
            var br_slug = $('#br_slug').val();
            var br_description = $('#br_description').val();
            var br_seo_description = $('#br_seo_description').val();
            var br_seo_keyword = $('#br_seo_keyword').val();
            var br_status = $('#br_status').val();
            var file_data = $('#br_image').prop('files')[0];

            var form_data = new FormData();
            form_data.append('id', brand_id);
            form_data.append('br_image_old', brand_img_old);
            form_data.append('br_slug_old', brand_slug_old);
            form_data.append('br_image', file_data);
            form_data.append('br_name', br_name);
            form_data.append('br_slug', br_slug);
            form_data.append('br_description', br_description);
            form_data.append('br_seo_description', br_seo_description);
            form_data.append('br_seo_keyword', br_seo_keyword);
            form_data.append('br_status', br_status);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('post-update-brand') }}',
                data: form_data,
                dataType: 'json',
                type: 'POST',
                cache: false,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    if (data.result == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Thêm thương hiệu thành công',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        window.location.href = "{{ route('page-brands') }}";
                    } else {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Thêm thương hiệu thất bại',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        return false;
                    }
                },
                error: function (error) {
                    var errorMes = error.responseJSON.messages;
                    if (errorMes) {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Thêm thương hiệu thất bại',
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
            $('#br_slug').prop('disabled', false);
        } else {
            $('#br_slug').prop('disabled', true);
            $('#br_slug').val($('#slug_old').val());
        }
    });

    function ChangeToSlug() {
        var title, slug;

        //Lấy text từ thẻ input title
        title = document.getElementById("title").value;

        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();

        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, " - ");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        document.getElementById('slug').value = slug;
    }

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
