<!DOCTYPE html>
<html lang="en">
  <head>
    @include('backend.dashboard.component.head')
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
    @include('backend.dashboard.component.nav')

      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
    @include('backend.dashboard.component.sidebar')

        <!-- partial -->
    @include($template)
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('backend.dashboard.component.script')
  </body>
</html>