
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      @include ('admin.partials.header')
      @yield('additional-css')
   </head>
   <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">     
         
         
         
         @auth
               @include('admin.partials.navigation')
               @yield('content')
               @include ('admin.partials.footer')
               @yield('additional-scripts')
             @else
              <div class="mt-5">
              @yield('content')
               @yield('additional-scripts')
              </div>
             

         @endauth
        
        
             
   </body>
</html>
