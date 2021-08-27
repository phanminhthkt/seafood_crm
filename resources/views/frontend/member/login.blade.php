<!DOCTYPE html>
<html lang="en">
    <head>
        @include('frontend.layouts.top')
    </head>
    <body>
<div class="login-4">
	<div class="form-section">
	    @include('blocks.messages')
	    <h3>ĐĂNG NHẬP</h3>

	    <form action="{{ route('client.post.login') }}" method="POST" class="needs-validation" novalidate>
	        <div class="form-group form-box">
	            <input type="text" name="email" class="input-text form-control" placeholder="Email hoặc Tên đăng nhập" required>
	            <div class="invalid-feedback mt-1">
	                Vui lòng nhập tên đăng nhập.
	            </div>
	        </div>
	        <div class="form-group form-box">
	            <input type="password" name="password" class="input-text form-control" placeholder="Mật khẩu" required>
	             <div class="invalid-feedback mt-1">
	                Vui lòng nhập mật khẩu.
	            </div>
	        </div>
	        <div class="form-group clearfix">
	            <button type="submit" class="btn-md btn-theme float-left">Đăng nhập</button>
	            <a href="forgot-password-4.html" class="forgot-password">Quên mật khẩu</a>
	        </div>
	        @csrf
	    </form>
	    <p>Chưa có tài khoản? <a href="{{route('client.member.register')}}" class="thembo"> Đăng ký</a></p>
	</div>
</div>
 @include('frontend.layouts.bot')
    </body>
</html>