<!DOCTYPE html>
<html lang="en">
    <head>
        @include('frontend.layouts.top')
    </head>
    <body>
        <div id="wrapper">
            <div id="app">
                <!-- user="{{json_encode(session('loginMember'),true)}}" -->
                <template-component></template-component>
            </div>
        </div>
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <script>
            window.__user__ = @json(session('loginMember'));
            window.__baseUrl__ = @json(url('/'));
        </script>
        <script src="/js/app.js"></script>
        @include('frontend.layouts.bot')
    </body>
</html>