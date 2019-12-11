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
        #custom_slug {
            margin-top: 10px;
        }
        #text-custom-slug {
            color: #333;
            font-weight: 600;
            font-size: 14px;
            margin-left: 10px;
        }
        .thumbnail{
            width: 163px;
            height: 163px;
            margin: 10px;
            float: left;
        }
        #clear{
            display:none;
            float: right;
            margin-bottom: 5px;
        }
        #result {
              display: none;
              width: 100%;
          }
        .upload-gallery {
            border: 4px dotted #cccccc;
            min-height: 200px;
            width: 100%;
            margin-top: 0;
        }
        .custom-tab nav {
            background-color: rgba(43, 34, 34, 0.03);
            border: 1px solid rgba(0,0,0,.125);
        }
        .nav-tabs {
            border-bottom: none !important;
        }
        .nav-tabs .nav-link {
            border: none !important;
            border-top-left-radius: 0 !important;
            border-top-right-radius: 0 !important;
        }
        .nav-tabs .nav-item {
            margin-bottom: 0 !important;
            color: #333;
            font-weight: 600;
        }
        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            background-color: rgb(247, 247, 247);
        }
        .image-append {
            border: 1px solid #f8f8f8;
            background-color: #272c33;
        }
        .upload-gallery {
            background-image: url(http://localhost:8000/a-images/noimg.jpg);
            background-color: #f3f3f3;
            width: 100%;
            background-size: contain;
        }
        #clear {
            display: none;
            width: 100%;
            text-align: right;
            background: transparent;
            border: transparent;
            color: #333;
            font-weight: 600;
            text-decoration: underline;
            float: none !important;
            margin-bottom: 0 !important;
            cursor: pointer;
        }
        #nav-tabContent {
            height: 570px;
            overflow-y: scroll;
            padding-right: 1rem !important;
            padding-left: 0 !important;
        }
        .custom-tab-right {
            height: 300px;
            overflow-y: scroll;
            padding-right: 0.5rem !important;
        }
        .product-module .card-header {
            padding: 8px 10px !important;
        }
        .product-module .card-body {
            padding: 10px !important;
        }
        .product-module .card-body.select-custom-height {
            height: 205px;
            overflow-y: scroll;
        }

        .tree ul {
            border-left: 1px dashed #dfdfdf;
        }

        .tree li {
            list-style: none;
            padding: 0 18px;
            cursor: pointer;
            vertical-align: middle;
            background: #fff;
        }

        .tree li:first-child {
            border-radius: 3px 3px 0 0;
        }

        .tree li:last-child {
            border-radius: 0 0 3px 3px;
        }

        .tree .active,
        .active li {
            background: #efefef;
        }

        .tree label {
            cursor: pointer;
        }

        .tree input[type=checkbox] {
            margin: -2px 6px 0 0px;
        }

        .has > label {
            color: #000;
        }

        .tree .total {
            color: #e13300;
        }

        .checkbox {
            padding: 0 20px 15px 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }
        .checkbox-input {
            margin-right: 10px;
        }

        .input-item {
            width: 50%;
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
                            <h4>Thêm sản phẩm</h4>
                        </div>
                        <div class="card-body">
                            <form id="form-add-product" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="custom-tab">
                                            <nav>
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <a class="nav-item nav-link active show" id="custom-nav-home-tab" data-toggle="tab" href="#custom-nav-home" role="tab" aria-controls="custom-nav-home" aria-selected="true">Sản phẩm</a>
                                                    <a class="nav-item nav-link" id="custom-nav-profile-tab" data-toggle="tab" href="#custom-nav-profile" role="tab" aria-controls="custom-nav-profile" aria-selected="false">Thông tin sản phẩm</a>
                                                    <a class="nav-item nav-link" id="custom-nav-contact-tab" data-toggle="tab" href="#custom-nav-contact" role="tab" aria-controls="custom-nav-contact" aria-selected="false">Thông số sản phẩm</a>
                                                </div>
                                            </nav>
                                            <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                                                <div class="tab-pane fade active show" id="custom-nav-home" role="tabpanel" aria-labelledby="custom-nav-home-tab">
                                                    <div class="row form-group">
                                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Loại sản phẩm</label></div>
                                                        <div class="col-12 col-md-9">
                                                            <select name="type_pro_id" id="type_pro_id" class="form-control">
                                                                <option value="0">Chọn loại sản phẩm</option>
                                                                @if(!empty($type_products))
                                                                    @foreach($type_products as $key => $value)
                                                                        <option value="{{ $value->id }}">{!! $value->tp_name !!}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3"><label for="text-input"
                                                                                         class=" form-control-label">Mã sản phẩm</label></div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="pro_code" name="pro_code" placeholder="Mã sản phẩm"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3"><label for="text-input"
                                                                                         class=" form-control-label">Tên sản phẩm</label></div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="pro_name" name="pro_name"
                                                                   placeholder="Tên sản phẩm" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3"><label for="text-input"
                                                                                         class=" form-control-label">Slug sản phẩm</label></div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" name="pro_slug" id="pro_slug" disabled
                                                                   placeholder="Mặc định ( Ví dụ: ao-so-mi-a300)"
                                                                   class="form-control">
                                                            <input type="checkbox" id="custom_slug"><span id="text-custom-slug">Custom Slug</span>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3"><label for="text-input"
                                                                                         class=" form-control-label">Giá sản phẩm</label></div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="text" id="prd_price" name="prd_price"
                                                                   placeholder="Giá sản phẩm"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3"><label for="text-input"
                                                                                         class=" form-control-label">Phần trăm giảm giá</label></div>
                                                        <div class="col-12 col-md-9">
                                                            <input type="number" id="prd_percent_discount" name="prd_percent_discount"
                                                                   placeholder="Phần trăm giảm giá (%)"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3">
                                                            <label for="textarea-input" class=" form-control-label">Mô tả ngắn</label>
                                                        </div>
                                                        <div class="col-12 col-md-9">
                                                            <textarea name="prd_excerpt" id="prd_excerpt" rows="5" placeholder="Mô tả ngắn" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-3"><label for="select" class=" form-control-label">Trạng
                                                                thái</label></div>
                                                        <div class="col-12 col-md-9">
                                                            <select name="pro_status" id="pro_status" class="form-control">
                                                                <option value="1">Hiện</option>
                                                                <option value="2">Ẩn</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="custom-nav-profile" role="tabpanel" aria-labelledby="custom-nav-profile-tab">
                                                    <div class="row form-group">
                                                        <div class="col col-md-12">
                                                            <label for="textarea-input" class=" form-control-label">Ảnh Gallery</label>
                                                        </div>
                                                        <div class="col col-md-12">
                                                            <input style="display: none;" id="files" type="file" name="prd_gallery[]" onchange="readURL(this);" accept="image/*" multiple="true" multiple/>
                                                            <button type="button" id="clear">Xóa tất cả</button>
                                                            <div class="upload-gallery" onclick="uploadGallery()">
                                                                <output id="result"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col col-md-12">
                                                            <label for="textarea-input" class=" form-control-label">Chi tiết sản phẩm</label>
                                                        </div>
                                                        <div class="col col-md-12">
                                                            <textarea id="content" name="prd_content"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="custom-nav-contact" role="tabpanel" aria-labelledby="custom-nav-contact-tab">
                                                    Thông số kĩ thuật sản phẩm
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="product-avatar">
                                            <div class="form-group">
                                                <label for="">Ảnh đại diện</label>
                                                <div class="upload-image">
                                                    <div class="input-file">
                                                        <input type='file' onchange="readURLAvatar(this);" name="pro_avatar"
                                                               id="pro_avatar" style="display: none"/>
                                                    </div>
                                                    <div class="image-append">
                                                        <img style="width: 100%; height: 260px;" id="avatar" onclick="chooseFile()" src="{{ asset('a-images/noimg.jpg') }}" alt="your image"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="custom-tab-right">
                                            <div class="product-module">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4>Danh mục</h4>
                                                    </div>
                                                    <div class="card-body select-custom-height">
                                                        <div class="multi-checkbox">
                                                            {{ CustomHelpers::showCategories($categories) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-module">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4>Thương hiệu</h4>
                                                    </div>
                                                    <div class="card-body select-custom-height">
                                                        <div class="multi-checkbox">
                                                            <div class="checkbox">
                                                                @if(!empty($brands))
                                                                    @foreach($brands as $key => $value)
                                                                        <div class="input-item">
                                                                            <input type="checkbox" id="brand_id" name="brand_id" value="{{ $value->id }}" class="checkbox-input">{!! $value->br_name !!}
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-module">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4>Hỗ trợ Seo</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row form-group">
                                                            <div class="col-12 col-md-12"><label for="textarea-input"
                                                                                                 class=" form-control-label">Seo Description</label>
                                                            </div>
                                                            <div class="col-12 col-md-12"><textarea name="pro_seo_description"
                                                                                                    id="pro_seo_description"
                                                                                                    rows="3" placeholder="Seo Description..."
                                                                                                    class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-12 col-md-12"><label for="textarea-input"
                                                                                                 class=" form-control-label">Seo Keyword</label>
                                                            </div>
                                                            <div class="col-12 col-md-12"><textarea name="pro_seo_keyword"
                                                                                                    id="pro_seo_keyword"
                                                                                                    rows="3" placeholder="Seo Keyword..."
                                                                                                    class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="card-footer" style="width: 100%">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Save
                                        </button>
                                        <button type="reset" class="btn btn-danger btn-sm">
                                            <i class="fa fa-ban"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div>
@endsection
@section('ajax')
    <script>
        $('#form-add-product').validate({
            rules: {
                pro_name: {
                    required: true,
                },
            },
            messages: {
                pro_name: {
                    required: 'Vui lòng nhập tên sản phẩm',
                },
            },
            submitHandler: function (data) {
                tinyMCE.triggerSave();
                var content = $("#content").val();
                var type_pro_id = $('#type_pro_id').val();
                var pro_code = $('#pro_code').val();
                var pro_name = $('#pro_name').val();
                var pro_slug = $('#pro_slug').val();
                var prd_price = $('#prd_price').val();
                var prd_percent_discount = $('#prd_percent_discount').val();
                var prd_excerpt = $('#prd_excerpt').val();
                var pro_status = $('#pro_status').val();
                var pro_seo_description = $('#pro_seo_description').val();
                var pro_seo_keyword = $('#pro_seo_keyword').val();
                var pro_avatar = $('#pro_avatar').prop('files')[0];
                var brand_id = $('#brand_id:checked').val();

                var form_data = new FormData();
                form_data.append('prd_content', content);
                form_data.append('type_pro_id', type_pro_id);
                form_data.append('pro_code', pro_code);
                form_data.append('pro_name', pro_name);
                form_data.append('pro_slug', pro_slug);
                form_data.append('prd_price', prd_price);
                form_data.append('prd_percent_discount', prd_percent_discount);
                form_data.append('prd_excerpt', prd_excerpt);
                form_data.append('pro_status', pro_status);
                form_data.append('pro_seo_description', pro_seo_description);
                form_data.append('pro_seo_keyword', pro_seo_keyword);
                form_data.append('pro_avatar', pro_avatar);
                var files = $("#files")[0].files;
                for(var i = 0; i < files.length; i++){
                    var file = files[i];
                    form_data.append('prd_gallery[]', file, file.name);
                }
                $('#category_id:checked').each(function(i){
                    form_data.append('category_id[]', $(this).val());
                });
                form_data.append('brand_id', brand_id);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route('post-store-product') }}',
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
                                title: 'Thêm sản phẩm thành công',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            window.location.href = "{{ route('page-products') }}";
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Thêm sản phẩm thất bại',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            return false;
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        });
    </script>
@endsection
@section('scripts')
    <script>
        tinymce.init({
            selector: '#content',
            height: 400,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: ['fontselect | fontsizeselect | insertfile undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |',
                'link image media pageembed | code | emoticons | insertdatetime | forecolor backcolor | table'],
            images_upload_url: '{{ route('uploadEditor') }}',
            images_upload_credentials: true,
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '{{ route('uploadEditor') }}');
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                xhr.setRequestHeader('x-csrf-token', csrfToken);
                xhr.onload = function() {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);
                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            },
        });

        $(document).ready(function(){
            $('.input-item input:checkbox').click(function() {
                $('.input-item input:checkbox').not(this).prop('checked', false);
            });
        });

        $('#custom_slug').change(function () {
            if ($(this).prop("checked") == true) {
                $('#pro_slug').prop('disabled', false);
            } else {
                $('#pro_slug').prop('disabled', true);
                $('#pro_slug').val('');
            }
        });

        function chooseFile() {
            $('#pro_avatar').click();
        }

        function uploadGallery() {
            $('#files').click();
        }

        function readURLAvatar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#avatar').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).on('click', '.tree label', function(e) {
            $(this).next('ul').fadeToggle();
            e.stopPropagation();
        });

        $(document).on('change', '.tree input[type=checkbox]', function(e) {
            $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
            $(this).parentsUntil('.tree').children("input[type='checkbox']").prop('checked', this.checked);
            e.stopPropagation();
        });

        $(document).ready(function () {
            window.onload = function () {
                if (window.File && window.FileList && window.FileReader) {
                    $('#files').on("change", function (event) {
                        $('.upload-gallery').css('background', 'rgb(248, 248, 248)');
                        var files = event.target.files; //FileList object
                        var output = document.getElementById("result");
                        for (var i = 0; i < files.length; i++) {
                            var file = files[i];
                            //Only pics
                            // if(!file.type.match('image'))
                            if (file.type.match('image.*')) {
                                if (this.files[0].size < 2097152) {
                                    // continue;
                                    var picReader = new FileReader();
                                    picReader.addEventListener("load", function (event) {
                                        var picFile = event.target;
                                        var div = document.createElement("div");
                                        div.innerHTML = "<img class='thumbnail' src='" + picFile.result + "'" +
                                            "title='preview image'/>";
                                        output.insertBefore(div, null);
                                    });
                                    //Read the image
                                    $('#clear, #result').show();
                                    picReader.readAsDataURL(file);
                                } else {
                                    alert("Image Size is too big. Minimum size is 2MB.");
                                    $(this).val("");
                                }
                            } else {
                                alert("You can only upload image file.");
                                $(this).val("");
                            }
                        }

                    });
                } else {
                    console.log("Your browser does not support File API");
                }
            };

            $('#files').on("click", function () {
                $('.thumbnail').parent().remove();
                $('result').hide();
                $(this).val("");
            });

            $('#clear').on("click", function () {
                $('.thumbnail').parent().remove();
                $('#result').hide();
                $('#files').val("");
                $(this).hide();
            });
        });
    </script>
@endsection
