<!DOCTYPE html>
<html lang="en">
    <head>
        @include('backend.layouts.top')
        
    </head>
    <body>
        <div id="wrapper">
            @include('backend.layouts.header')

            <div class="left-side-menu">
            @include('backend.layouts.navigation')
            </div>
            <div class="content-page">
                <div id="pre-loader">
                    <div id="pre-loade" class="app-loader"><div class="loading"></div></div>
                </div>
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                <!-- end Footer -->
            </div>
            @include('backend.layouts.modal')
            @include('backend.layouts.footer')
        </div>
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        @include('backend.layouts.bot')
    </body>
</html>