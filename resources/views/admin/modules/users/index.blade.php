@extends('admin.layouts.master')
@section('styles')
    <link rel="stylesheet" href="admin/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="admin/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
@endsection
@section('main')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Data Table</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Khách hàng</th>
                                    <th>Email</th>
                                    <th>Ngày đăng ký</th>
                                    <th>Ngày sửa</th>
                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($users))
                                    @foreach($users as $key => $user)
                                        <tr>
                                            <td>{!! $key + 1 !!}</td>
                                            <td>{!! !empty($user->name) ? $user->name : 'Dữ liệu trống' !!}</td>
                                            <td>{!! !empty($user->email) ? $user->email : 'Dữ liệu trống' !!}</td>
                                            <td>{!! !empty($user->created_at) ? $user->created_at : 'Dữ liệu trống' !!}</td>
                                            <td>{!! !empty($user->updated_at) ? $user->updated_at : 'Dữ liệu trống' !!}</td>
                                            <td>
                                                <a href="" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                <a href="" class="btn btn-warning"><i class="fa fa-trash"></i></a>
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
