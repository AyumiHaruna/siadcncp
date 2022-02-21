<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    @include('almacen.partials._head')

    <title> SICA | @yield('title') </title>

    @yield('moreStyles')

  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 subBanner" style="background-image:url({{ asset('../img/main/subBanner/'.rand(1,14).'.jpg') }} )">
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 noPadd">
            @include('almacen.partials._menuAlmacen')
        </div>
      </div>

      <div class="row">
        @yield('content')
      </div>

      @include('almacen.partials._footer')

    </div>
  </body>

  @yield('script')
</html>
