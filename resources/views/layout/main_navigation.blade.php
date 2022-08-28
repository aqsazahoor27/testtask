<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <span class="brand-logo">
                        <img src="/images/new_logo.png" alt="" height="28" >
                    </span>
                    <h2 class="brand-text">AdminPanel</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item dashboard"><a class="d-flex align-items-center" href="{{url('admin/home')}}"><i data-feather="home"></i><span class="menu-title text-truncate">Dashboard</span></a>
            <li class="nav-item"><a class="d-flex align-items-center tariningR" href="#"><i data-feather="folder"></i><span class="menu-title text-truncate">Product Management</span></a>
                <ul class="menu-content">
                    <li class="classrooms"><a class="d-flex align-items-center" href="{{ url('admin/product-categories') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"> Categories</span></a>
                    </li>
					<li class="post"><a class="d-flex align-items-center" href="{{ url('admin/products') }}"><i data-feather="circle"></i><span class="menu-item text-truncate">Products</span></a>
                    </li>
                </ul>
            </li>
         
          

        </ul>
    </div>
</div>
<!-- END: Main Menu-->
