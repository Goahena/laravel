<!DOCTYPE html>
<html lang="en">
  <head>
    @include('frontend.home.component.head')
  </head>
  <body>
    @include('frontend.home.component.nav')
    @include('frontend.home.component.carousel')

    @include($template)

    @include('frontend.home.component.footer')

    @include('frontend.home.component.script')
  </body>
</html>