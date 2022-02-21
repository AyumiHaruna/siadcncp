<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    @include('main.partials._head')

    <title> SIADCNCPC | @yield('title') </title>

    @yield('moreStyles')

  </head>
  <body  style="background-image:url(../img/main/semiBG/{{ rand(1,20) }}.jpg)">
    <div class="container-fluid">
      <div class="row divMenu">
        <div class="col-md-10 offset-md-1 noPadd">
            @include('main.partials._menu')
        </div>
      </div>

      <div class="row">
        @yield('content')
      </div>

      <div class="row">
        <div class="col-md-12">
          @include('main.partials._footer')
        </div>
      </div>
    </div>
  </body>

  @yield('script')
</html>
