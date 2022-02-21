<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    @include('almacen.partials._head')

    <title> SICA | @yield('title') </title>

    @yield('moreStyles')

  </head>
  <body>
    <div class="container">
      <div class="row">
        @yield('content')
      </div>
    </div>
  </body>

  @yield('script')
</html>
