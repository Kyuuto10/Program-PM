<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Newtronic Solution</title>

    <!-- ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- end ionicons -->

    <!-- icon bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- end icon -->

    <!-- My Style -->
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <!-- end my style -->

    <!-- base:css -->
    <link rel="stylesheet" href="{{url('template/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{url('template/vendors/base/vendor.bundle.base.css')}}">
    <!-- endinject -->
    
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{url('template/css/style.css')}}">
    <!-- endinject -->

    <!-- icon nts -->
    <link rel="shortcut icon" href="{{url('template/images/nts.png')}}" />
    <!-- end icon -->

    <!-- Script -->
    @vite(['resources/sass/app.css','resources/js/app.js'])

  </head>
  <body>

		<!-- partial:partials/_horizontal-navbar.html -->
    <div class="horizontal-menu">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container">
        </div>
      </nav>
      <nav class="bottom-navbar navbar-fixed-top">
        <div class="container row">
            <ul class="nav page-navigation">
              <li class="nav-item">
                <a class="nav-link" href="{{url('/')}}">
                  <i class="mdi mdi-file-document-box menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>

              @auth
              @if(Auth::user()->type == 'admin' || Auth::user()->type == 'manager')
              

              <li class="nav-item">
                  <a href="{{route('project.index')}}" class="nav-link">
                    <i class="mdi mdi-cube-outline menu-icon"></i>
                    <span class="menu-title">Data</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>
                
              @endif

              @if(Auth::user()->type == 'admin')
              <li class="nav-item dropdown">
                  <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i class="mdi mdi-codepen menu-icon"></i>
                    <span class="menu-title">Lainnya</span>
                    <!-- <i class="menu-arrow"></i> -->
                  </a>
                  <div class="submenu">
                      <ul class="submenu-item scrollable-menu" role="menu">
                          <li><a class="nav-item nav-link" href="{{route('status.index')}}">Status</a></li>
                          <li><a class="nav-item nav-link" href="{{route('produk.index')}}">Produk</a></li>
                          <li><a class="nav-item nav-link" href="{{route('priority.index')}}">Priority</a></li>
                          <li><a class="nav-item nav-link" href="{{route('jobdesk.index')}}">Jobdesk</a></li>
                          <li><a class="nav-item nav-link" href="{{route('teknisi.index')}}">Teknisi</a></li>
                      </ul>
                  </div>
              </li>
              @endif
              
              <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-left"></i>
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
              </form>
              </li>
              
              @else
              
                @if( Route::has('login'))
              <li class="nav-item">
                <a href="{{ route('login') }}" class="nav-link"><i class="bi bi-box-arrow-in-left"></i>Login</a>
              </li>
                @endif
                @endauth

              <!-- <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                    <span class="menu-title">Teknisi</span></a>
              </li> -->
            </ul>
        </div>
      </nav> 
    </div>

	@yield('content')
    <!-- partial -->
		<!--  -->
				<!-- content-wrapper ends -->
				<!-- partial:partials/_footer.html -->
				<footer class="footer">
          <!-- <div class="footer-wrap">
            <div class="">
              <span class="">Copyright © <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com </a>2021</span>
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
	
  </body>
</html>