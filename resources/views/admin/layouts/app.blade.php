<!DOCTYPE html>
<html lang="es">

<head>
    @include('admin/layouts/head')
</head>

<body scroll-spy="" id="top" class=" theme-template-dark theme-pink alert-open alert-with-mat-grow-top-right">

    @include('admin/layouts/header')
        @section('main-content')
            @show

    @include('admin/layouts/footer')

</body>

</html>