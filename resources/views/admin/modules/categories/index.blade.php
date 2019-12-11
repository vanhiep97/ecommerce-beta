@extends('admin.layouts.master')
@section('styles')
    <link rel="stylesheet" href="admin/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="admin/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <style>
        /* Switch 4 Specific Style Start */
        .input_wrapper{
            width: 80px;
            height: 40px;
            position: relative;
            cursor: pointer;
        }

        .input_wrapper input[type="checkbox"]{
            width: 80px;
            height: 40px;
            cursor: pointer;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background: #315e7f;
            border-radius: 6px;
            position: relative;
            outline: 0;
            -webkit-transition: all .2s;
            transition: all .2s;
        }

        .input_wrapper input[type="checkbox"]:after{
            position: absolute;
            content: "";
            top: 3px;
            left: 3px;
            width: 34px;
            height: 34px;
            background: #dfeaec;
            z-index: 2;
            border-radius: 6px;
            -webkit-transition: all .35s;
            transition: all .35s;
        }

        .input_wrapper svg{
            position: absolute;
            top: 50%;
            -webkit-transform-origin: 50% 50%;
            transform-origin: 50% 50%;
            fill: #fff;
            -webkit-transition: all .35s;
            transition: all .35s;
            z-index: 0;
        }

        .input_wrapper .is_checked{
            width: 18px;
            left: 18%;
            -webkit-transform: translateX(190%) translateY(-30%) scale(0);
            transform: translateX(190%) translateY(-30%) scale(0);
        }

        .input_wrapper .is_unchecked{
            width: 15px;
            right: 10%;
            -webkit-transform: translateX(0) translateY(-30%) scale(1);
            transform: translateX(0) translateY(-30%) scale(1);
        }

        /* Checked State */
        .input_wrapper input[type="checkbox"]:checked{
            background: #23da87;
        }

        .input_wrapper input[type="checkbox"]:checked:after{
            left: calc(100% - 37px);
        }

        .input_wrapper input[type="checkbox"]:checked + .is_checked{
            -webkit-transform: translateX(0) translateY(-30%) scale(1);
            transform: translateX(0) translateY(-30%) scale(1);
        }

        .input_wrapper input[type="checkbox"]:checked ~ .is_unchecked{
            -webkit-transform: translateX(-190%) translateY(-30%) scale(0);
            transform: translateX(-190%) translateY(-30%) scale(0);
        }

        /* Switch 4 Specific Style End */
    </style>
@endsection
@section('main')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <strong class="card-title" style="margin-bottom: 0 !important;">Danh mục sản phẩm</strong>
                            <strong><a href="{{ route('page-create-category') }}" class="btn btn-danger btn-sm">Thêm mới <span class="ti-plus"></span></a></strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên danh mục</th>
                                    <th>Slug</th>
                                    <th>Parent</th>
                                    <th>Ngày tạo</th>
                                    <th>Status</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($categories))
                                    @foreach($categories as $key => $cat)
                                        <tr>
                                            <td>{!! $key + 1 !!}</td>
                                            <td>{!! !empty($cat->cat_name) ? $cat->cat_name : 'Dữ liệu trống' !!}</td>
                                            <td>{!! !empty($cat->cat_slug) ? $cat->cat_slug : 'Dữ liệu trống' !!}</td>
                                            <td>{{ !empty(CustomHelpers::showParentMenu($cat->cat_parent_id)) ? CustomHelpers::showParentMenu($cat->cat_parent_id) : 'Danh mục cha' }}</td>
                                            <td>{!! !empty($cat->created_at) ? $cat->created_at : 'Dữ liệu trống' !!}</td>
                                            <td>
                                                <div class="input_wrapper">
                                                    <input type="checkbox" data-id="{{$cat->id}}" id="toggle-class" class="switch_4" {{ $cat->cat_status == 1 ? 'checked' : '' }}>
                                                    <svg class="is_checked" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 426.67 426.67">
                                                        <path d="M153.504 366.84c-8.657 0-17.323-3.303-23.927-9.912L9.914 237.265c-13.218-13.218-13.218-34.645 0-47.863 13.218-13.218 34.645-13.218 47.863 0l95.727 95.727 215.39-215.387c13.218-13.214 34.65-13.218 47.86 0 13.22 13.218 13.22 34.65 0 47.863L177.435 356.928c-6.61 6.605-15.27 9.91-23.932 9.91z"/>
                                                    </svg>
                                                    <svg class="is_unchecked" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 212.982 212.982">
                                                        <path d="M131.804 106.49l75.936-75.935c6.99-6.99 6.99-18.323 0-25.312-6.99-6.99-18.322-6.99-25.312 0L106.49 81.18 30.555 5.242c-6.99-6.99-18.322-6.99-25.312 0-6.99 6.99-6.99 18.323 0 25.312L81.18 106.49 5.24 182.427c-6.99 6.99-6.99 18.323 0 25.312 6.99 6.99 18.322 6.99 25.312 0L106.49 131.8l75.938 75.937c6.99 6.99 18.322 6.99 25.312 0 6.99-6.99 6.99-18.323 0-25.313l-75.936-75.936z" fill-rule="evenodd" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('page-edit-category', ['id' => $cat->id]) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-warning" onclick="del({{ $cat->id }})"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <p>Không có dữ liệu</p>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div>
@endsection
@section('ajax')
    <script>
        $(function () {
            $('#toggle-class').change(function () {
                var status = $(this).prop('checked') == true ? 1 : 2;
                var category_id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    cache: false,
                    url: '{{ route('update-status-cat') }}',
                    data: {
                        status: status,
                        category_id: category_id
                    },
                    success: function (data) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Cập nhật trạng thái thành công',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function (error) {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Cập nhật trạng thái thất bại',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        return false;
                    }
                });
            })
        });
        var del = function (id) {
            swal.fire({
                title: 'Are you sure?',
                text: "Bạn có muốn xóa nhóm quyền này không!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.value) {
                    var form_data = new FormData();
                    form_data.append('_method', 'delete');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type:'POST',
                        url:'{{ url("/s-admin/category/delete") }}' +'/' +id,
                        contentType: false,
                        processData: false,
                        data: form_data,
                    }).done(function(rs){
                        swal.fire(
                            'Deleted!',
                            'Xóa nhóm quyền thành công',
                            'success'
                        ).then((result)=>{window.location.reload()})
                    }).fail(function(err){
                        console.log(err);
                        $("#modalDel").modal('hide');
                    });
                    return false;
                }
            });
        }
    </script>
@endsection
@section('scripts')
    <script src="admin/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="admin/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="admin/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="admin/vendors/jszip/dist/jszip.min.js"></script>
    <script src="admin/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="admin/vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="admin/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="admin/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="admin/vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="admin/assets/js/init-scripts/data-table/datatables-init.js"></script>
@endsection
