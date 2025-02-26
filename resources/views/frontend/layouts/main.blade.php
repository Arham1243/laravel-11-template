<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' | ' . env('APP_NAME') : env('APP_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('frontend.layouts.links')
    @yield('css')
    @stack('css')
</head>

<body>

    @include('frontend.layouts.header')
    @yield('content')
    @include('frontend.layouts.footer')
    @include('frontend.layouts.scripts')
    @yield('js')
    @stack('js')


    <script type="text/javascript">
        const showMessage = (message, type, position = 'bottom-right') => {
                $.toast({
                    heading: type === 'success' ? 'Success!' : 'Error!',
                    position: position,
                    text: message,
                    loaderBg: type === 'success' ? '#ff6849' : '#ff6849',
                    icon: type === 'success' ? 'success' : 'error',
                    hideAfter: 3000,
                    stack: 6
                });
            }
            (() => {

                @if (session('notify_success') || isset($_GET['notify_success']))
                    $.toast({
                        heading: 'Success!',
                        position: 'bottom-right',
                        text: '{{ session('notify_success') ?? $_GET['notify_success'] }}',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 4000,
                        stack: 6
                    });
                @elseif (session('notify_error') || isset($_GET['notify_error']))
                    $.toast({
                        heading: 'Error!',
                        position: 'bottom-right',
                        text: '{{ session('notify_error') ?? $_GET['notify_error'] }}',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 5000,
                        stack: 6
                    });
                @endif

            })()
    </script>
</body>

</html>
