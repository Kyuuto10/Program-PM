<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Newtronic Solution</title>
    <style>
      .imgPreview img {
            padding: 8px;
            max-width: 100px;
        } 
    </style>

    <!-- ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- end ionicons -->

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    <!-- icon bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- end icon -->

    <!-- My Style -->
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <!-- end my style -->

    <!-- sweet alert -->
    @include('sweetalert::alert')
    <!-- base:css -->
    <link rel="stylesheet" href="{{url('template/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{url('template/vendors/base/vendor.bundle.base.css')}}">
    <!-- endinject -->
    
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{url('template/css/style.css')}}">
    <!-- endinject -->
    <!-- Sweet Alert -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
    <!-- End Sweet Alert -->
    <!-- icon nts -->
    <link rel="shortcut icon" href="{{url('template/images/nts.png')}}" />
    <!-- end icon -->

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript">
     var siteUrl = "{{url('/')}}";
  </script>

    <!-- Ekspor Data -->
    <script src="{{url('template/js/jquery.min.js')}}"></script>
    <script src="{{url('template/js/jquery.table2excel.min.js')}}"></script>
  
    <!-- Script -->
    @vite(['resources/sass/app.css','resources/js/app.js'])
  </head>
  <body>

		<!-- partial:partials/_horizontal-navbar.html -->
    <div class="horizontal-menu" style="position: fixed; width: 100%;">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container">
        </div>
      </nav>
      
      <nav class="bottom-navbar navbar-fixed-top" style="justify">
        <div class="container row">
            <ul class="nav page-navigation">
            @auth
            
            @if(Auth::user()->type == 'user')
              <li class="nav-item">
                <a class="nav-link" href="{{url('home/index')}}">
                  <i class="mdi mdi-file-document-box menu-icon"></i>
                  <span class="menu-title">Home</span>
                </a>
              </li>
              
              <li class="nav-item">
                  <a href="{{url('project/index')}}" class="nav-link">
                    <i class="mdi mdi-database menu-icon"></i>
                    <span class="menu-title">Data</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>

              @endif

              @if(Auth::user()->type == 'admin')

              <li class="nav-item">
                <a class="nav-link" href="{{url('/home')}}">
                  <i class="mdi mdi-home menu-icon"></i>
                  <span class="menu-title">Home</span>
                </a>
              </li>

              <li class="nav-item">
                  <a href="{{route('project.index')}}" class="nav-link">
                    <i class="mdi mdi-database menu-icon"></i>
                    <span class="menu-title">Data</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>

              <li class="nav-item dropdown">
                  <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i class="mdi mdi-settings-outline menu-icon"></i>
                    <span class="menu-title">Konfigurasi</span>
                    <!-- <i class="menu-arrow"></i> -->
                  </a>
                  <div class="submenu">
                      <ul class="submenu-item scrollable-menu" role="menu">
                          <a class="dropdown-item nav-link" href="{{route('status.index')}}"><i class="mdi mdi-cogs"></i> Status</a>
                          <a class="dropdown-item nav-link" href="{{route('produk.index')}}"><i class="mdi mdi-cogs"></i> Produk</a>
                          <a class="dropdown-item nav-link" href="{{route('priority.index')}}"><i class="mdi mdi-cogs"></i> Prioritas</a>
                          <a class="dropdown-item nav-link" href="{{route('jobdesk.index')}}"><i class="mdi mdi-cogs"></i> Jobdesk</a>
                          <a class="dropdown-item nav-link" href="{{route('teknisi.index')}}"><i class="mdi mdi-cogs"></i> Teknisi</a>
                      </ul>
                  </div>
              </li>

              <li class="nav-item">
                  <a href="{{route('user.index')}}" class="nav-link">
                    <i class="mdi mdi-account menu-icon"></i>
                    <span class="menu-title">Akun</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>
              @endif
              
              <li class="nav-item dropdown">                       
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  <i class="mdi mdi-account-circle menu-icon"></i> 
                  <span class="menu-title">{{ Auth::user()->name }}</span>
                </a>

                <div class="submenu">
                  <ul class="submenu-item scrollable-menu" role="menu">
                    <a class="dropdown-item nav-link show-alert-logout-box pull-left" href="" name="_method" title="Logout">
                        <i class="mdi mdi-logout"></i>
                        <span class="menu-title" style="padding-top:1em;">{{ __('Logout') }}</span>
                      </a>                     
                  </ul>
                </div>
              </li>

              <!-- <li class="nav-item">
                <a class="nav-link show-alert-logout-box" href="" name="_method" title="Logout"><i class="mdi mdi-logout"></i>
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                    <span class="menu-title" style="padding-top:1em;">{{ __('Logout') }}</span>
                  </a>
                  
              </li> -->

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
              </form>
              </li>
              
              @else
              
                @if( Route::has('login'))
              <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link"><i class="mdi mdi-login"></i>Login</a>
              </li>
                @endif
                @endauth

            </ul>
        </div>
      </nav> 
    </div>

  
  @include('auth.alert')
	@yield('content')
    <!-- partial -->
		<!--  -->
				<!-- content-wrapper ends -->
				<!-- partial:partials/_footer.html -->
				<footer class="footer">
          <!-- <div class="footer-wrap">
            <div class="">
              <span class="">Copyright � <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com </a>2021</span>
            </div>
          </div> -->
        </footer>
				<!-- partial -->
			</div>
			<!-- main-panel ends -->
		</div>
		<!-- page-body-wrapper ends -->
    </div>
		<!-- container-scroller -->
    <!-- base:js -->
    <script src="vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="js/template.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/progressbar.js/progressbar.min.js"></script>
		<script src="vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
		<script src="vendors/justgage/raphael-2.1.4.min.js"></script>
		<script src="vendors/justgage/justgage.js"></script>
    <script src="js/jquery.cookie.js" type="text/javascript"></script>
    <!-- Custom js for this page-->
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page-->
    <!-- sweet alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- end sweet alert -->
    <script type="text/javascript">
      $('.show-alert-logout-box').click(function($event){
         /*var form = $(this).closest("form");
         var name = $(this).data("name");*/
         event.preventDefault();
         swal({
          title: "",
          text: "Apakah Anda yakin akan keluar dari aplikasi ini?",
          icon: "warning",
          type: "warning",
          buttons: ["Tidak","Ya!"],
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: "Yakin, keluar!"
         }).then((willLogout) => {
            if(willLogout) {
              document.getElementById('logout-form').submit();
            }
         });
      });
    </script>
    </body>
</html>