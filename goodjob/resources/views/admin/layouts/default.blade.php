<!DOCTYPE html>
<html lang="en">

<head>
   @include('admin.partials.head')

   @include('admin.partials.styles')
   
</head>

<body>
    <div class="d-flex" id="wrapper">

        @include('admin.partials.sidebar')

            <!-- Page content wrapper-->
            <div id="page-content-wrapper" class="dashboard">
                @include('admin.partials.header')
                @yield('content')
                @include('admin.partials.scripts')
            </div>
                
</body>

</html>
