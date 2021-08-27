<!DOCTYPE html>
<html lang="en">
    <head>
        @include('backend.layouts.top')
    </head>
    <body>
        <div class="row justify-content-center my-5">
		    <div class="col-lg-6 col-xl-4 mb-4">
		        <div class="error-text-box">
		            <svg viewBox="0 0 600 200">
		                <!-- Symbol-->
		                <symbol id="s-text">
		                    <text text-anchor="middle" x="50%" y="50%" dy=".35em">404</text>
		                </symbol>
		                <!-- Duplicate symbols-->
		                <use class="text" xlink:href="#s-text"></use>
		                <use class="text" xlink:href="#s-text"></use>
		                <use class="text" xlink:href="#s-text"></use>
		                <use class="text" xlink:href="#s-text"></use>
		                <use class="text" xlink:href="#s-text"></use>
		            </svg>
		        </div>
		        <div class="text-center">
		            <h3 class="mt-0 mb-2">Trang của bạn không tìm thấy.</h3>
		            <button  onclick="window.history.back()" class="btn btn-success waves-effect waves-light">Trở lại</button>
		        </div>
		        <!-- end row -->

		    </div> <!-- end col -->
		</div>
        @include('backend.layouts.bot')
    </body>
</html>
