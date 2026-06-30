<!DOCTYPE html>
<html>
<head>
    
    @include('layouts.partials.meta')

</head>
<body>

    {{-- NAVBAR --}}
    @include('layouts.partials.header')


    {{-- CONTENIDO --}}
    <div class='container'>
        @yield('content')
    </div>

    {{-- FOOTER --}}
    @include('layouts.partials.footer')

    @yield('scripts')
    
</body>
</html> 