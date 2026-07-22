
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Panchagar | Budget Management</title>
  <link rel = "icon" href ="./logo.png" 
                type = "image/x-icon">
                

    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
  
  
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
           
              <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
              </li>
              
            </ul>
            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </form>
          </nav>
          <!-- /.navbar -->
        
          <!-- Main Sidebar Container -->
          <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="/logo.png" alt="Panchagar Zilla Parishad" class="brand-image " style="">
               <h6 id="ed" class="brand-text font-weight-light" style="margin-top: 5px">Panchagar Zilla Parishad</h6>
              </a>
        
            <!-- Sidebar -->
            <div class="sidebar">
              <!-- Sidebar user panel (optional) -->
              
        
              <!-- Sidebar Menu -->
              <nav class="mt-2" style="font-size: 14px;">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
                  <li class="nav-item" style="margin-left: -5px">
                 
                  <a href="/home" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt" style="color:rgb(145, 210, 27);"></i>
                    <p>
                      Dashboard
                 
                    </p>
                  </a>
                </li>
                  <li class="nav-item nav-item has-treeview">
                    <a href="" class="nav-link ">
                        <i class="fas fa-coins" style= "color:#be4bdb;"></i>
                      <i class="right fas fa-angle-left"></i>
                      <p>
                        Income Management
                    
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="/income" class="nav-link">
                         
                            <p style="margin-left: 22px">Income</p>
                          </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="/income-category" class="nav-link">
                          
                            <p style="margin-left: 22px">Income Category</p>
                          </a>
                        </li>
                    </ul>
                  </li>
                  <li class="nav-item nav-item has-treeview">
                    <a href="" class="nav-link ">
                        <i class="fas fa-luggage-cart" style= "color:#fd7e14;"></i>
                      <i class="right fas fa-angle-left"></i>
                      <p>
                        Expense Management
                      
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="/farmer/products" class="nav-link">
                           
                            <p style="margin-left: 22px">Expense</p>
                          </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="/farmer/producthistory" class="nav-link">
                         
                            <p style="margin-left: 22px">Expense Category</p>
                          </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="/farmer/category" class="nav-link">
                          <i class="fas fa-clipboard-list" style= "color:#fd7e14;"></i>
                          <p>Category</p>
                        </a>
                      </li>
                     </ul>
                  </li>

                  <li class="nav-item nav-item has-treeview">
                    <a href="" class="nav-link ">
                        <i class="fas fa-users-cog" style="color:rgb(48, 189, 97);"></i>
                      <i class="right fas fa-angle-left"></i>
                      <p>
                       Human Resource 
                      
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="/farmer/products" class="nav-link">
                           
                            <p style="margin-left: 22px">Human Resource</p>
                          </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="/farmer/producthistory" class="nav-link">
                         
                            <p style="margin-left: 22px">Human Resource Category</p>
                          </a>
                        </li>
                    </ul>
                  </li>
        
        
                <li class="nav-item">
                    <a href="/farmer/delivery" class="nav-link ">
                        <i class="fas fa-chart-pie" style="color:rgb(100, 179, 216);"></i>
                      <p>
                        Report
                        
                      </p>
                    </a>
                  </li>
        
                  <li  class="nav-item">
                    <a href="/farmer/profile" class="nav-link">
                      <i class="fas fa-id-card-alt"style="color:rgb(255, 223, 97);"></i>
                      <p>
                     Profile
                       
                      </p>
                    </a>
                  </li>
                  
                    <li class="nav-item" >
                        <a class="dropdown-item" style="margin-left: -7px" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        
                            
                            <i class="fas fa-sign-out-alt"style="color:rgb(255, 150, 55);"></i>    {{ __('Logout') }}</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        
                    </li>
               
              
                </ul>
              </nav>
              <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
          </aside>
        
          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper" style="font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol"">
        
            <!-- Main content -->
            <div class="content">
              <div class="container-fluid">
                 <!--Here  will use the content of layout -->
                
                @yield('content')
                
        
                 
              </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
          </div>
    </div>
        <!-- ./wrapper -->
        
        <!-- REQUIRED SCRIPTS -->
    
      
        <script src="/js/app.js"></script>
      
      
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
        <script  src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

        <!-- jQuery -->
        {{-- <script src="https://adminlte.io/themes/dev/AdminLTE/plugins/jquery/jquery.min.js"></script> --}}
        <!-- Bootstrap 4 -->
        <script src="https://adminlte.io/themes/dev/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="https://adminlte.io/themes/dev/AdminLTE/dist/js/adminlte.min.js"></script>
    
       @yield('js')
    </body>
</html>
