<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Ecommerce</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <base href="{{ asset('/') }}">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="admin/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="admin/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="admin/vendors/selectFX/css/cs-skin-elastic.css">


    <link rel="stylesheet" href="admin/assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>


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
</head>

<body class="bg-dark">
<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-logo">
                <a href="index.html">
                    <img class="align-content" src="a-images/logo.png" alt="">
                </a>
            </div>
            <div class="login-form">
                <form id="form-login">
                    <div class="form-group">
                        <label>Tài khoản</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Nhớ mật khẩu
                        </label>
                        <label class="pull-right">
                            <a href="#">Quên mật khẩu?</a>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Đăng nhập</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="admin/vendors/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    $('#form-login').validate({
        rules: {
            email: {
                required: true,
                email: true,
                minlength: 15,
            },
            password: {
                required: true,
                minlength: 6,
            }
        },
        messages: {
            email: {
                required: 'Vui lòng nhập Email',
                email: 'Email không đúng định dạng',
                minlength: 'Email tối thiểu 15 kí tự'
            },
            password: {
                required: 'Vui lòng nhập mật khẩu',
                minlength: 'Mật khẩu tối thiểu 6 kí tự'
            }
        },
        submitHandler: function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                cache: false,
                url: '{{ route('post-login') }}',
                data: {
                    email: $('#email').val(),
                    password: $('#password').val(),
                },
                dataType: 'json',
                success: function(data){
                    if(data.result == true) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Đăng nhập thành công',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        window.location.href = "{{ url('s-admin') }}";
                    } else {
                        Swal.fire(
                            'Đăng nhập thất bại',
                            'Tài khoản hoặc mật khẩu không chính xác!',
                            'error'
                        );
                        return false;
                    }
                },
                error: function(error){
                    Swal.fire(
                        'Đăng nhập thất bại',
                        'Tài khoản hoặc mật khẩu không chính xác!',
                        'error'
                    );
                    return false;
                }
            });
        }
    });
</script>
<script src="admin/vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="admin/assets/js/main.js"></script>
</body>

</html>
