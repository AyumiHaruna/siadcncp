<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    @include('main.partials._head')

    <title> SIADCNCPC | @yield('title') </title>

    @yield('moreStyles')

  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        @yield('content')
      </div>      
    </div>
  </body>

  @yield('script')
</html>
