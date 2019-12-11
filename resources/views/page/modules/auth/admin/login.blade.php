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
                        <label>Email address</label>
                        <input type="email" id="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                        <label class="pull-right">
                            <a href="#">Forgotten Password?</a>
                        </label>
                    </div>
                    <button type="button" id="login" class="btn btn-success btn-flat m-b-30 m-t-30">Đăng nhập</button>
                    <div class="social-login-content">
                        <div class="social-button">
                            <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Sign in with facebook</button>
                            <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Sign in with twitter</button>
                        </div>
                    </div>
                    <div class="register-link m-t-15 text-center">
                        <p>Don't have account ? <a href="#"> Sign Up Here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="admin/vendors/jquery/dist/jquery.min.js"></script>
{{--<script type="text/html" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>--}}
<script>
    // $('#form-login').validate({
    //     rules: {
    //         email: {
    //             required: true,
    //             email: true,
    //             minlength: 15,
    //         },
    //         password: {
    //             required: true,
    //             minlength: 6,
    //         }
    //     },
    //     messages: {
    //         email: {
    //             required: 'Vui lòng nhập Email',
    //             email: 'Email không đúng định dạng',
    //             minlength: 'Email tối thiểu 15 kí tự'
    //         },
    //         password: {
    //             required: 'Vui lòng nhập mật khẩu',
    //             minlength: 'Mật khẩu tối thiểu 6 kí tự'
    //         }
    //     },
    //     submitHandler: function () {
    //         console.log("xxx");
    //     }
    // });
    $('#login').click(function (e) {
        e.preventDefault();
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
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Đăng nhập thành công',
                    showConfirmButton: false,
                    timer: 1500
                });
                window.location.href = "{{ url('s-admin') }}";
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
    });
</script>
<script type="text/html" src="admin/vendors/popper.js/dist/umd/popper.min.js"></script>
<script type="text/html" src="admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/html" src="admin/assets/js/main.js"></script>
</body>

</html>
