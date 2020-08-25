  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('public/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
  <!--     <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        @if((Auth::user()->ticketit_admin==1))
        <li class="treeview">
          <a href="{{ url('/dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>      
        </li>

            <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Cms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ url('/cms-list') }}"><i class="fa fa-circle-o"></i> Cms List</a></li>
            <li><a href="{{ url('/addcms') }}"><i class="fa fa-circle-o"></i> Add Cms</a></li>
            
          </ul>
        </li>


         <li class="treeview">
          <a href="#">
            <i class="fa fa-user-circle-o"></i><span>Users List</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ url('/admins') }}"><i class="fa fa-circle-o"></i> Admins List</a></li>
            <li class="active"><a href="{{ url('/users') }}"><i class="fa fa-circle-o"></i> Users List</a></li>
            <li class="active"><a href="{{ url('/agents') }}"><i class="fa fa-circle-o"></i> Agent List</a></li>
            <li class="active"><a href="{{ url('/agency') }}"><i class="fa fa-circle-o"></i> Agency List</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Packages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ url('/allpackages') }}"><i class="fa fa-circle-o"></i> Packages List</a></li>
            <li><a href="{{ url('/addpackage') }}"><i class="fa fa-circle-o"></i> Add Package</a></li>
            
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-tasks"></i><span>Activities List</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ url('/allactivities') }}"><i class="fa fa-circle-o"></i> Activities List</a></li>           
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-hotel"></i><span>Hotels</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ url('/allhotels') }}"><i class="fa fa-circle-o"></i> Hotels List</a></li>
            <li><a href="{{ url('/hotel-add') }}"><i class="fa fa-circle-o"></i> Add Hotel</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Tours</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ url('/alltours') }}"><i class="fa fa-circle-o"></i> Tours List</a></li>
            <li><a href="{{ url('/addtour') }}"><i class="fa fa-circle-o"></i> Add Tour</a></li>
          </ul>
        </li>
      @endif

      @if((Auth::user()->trip_agency==1))
        <li class="treeview">
          <a href="{{ url('/dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>      
        </li>        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Packages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ url('/packages-list') }}"><i class="fa fa-circle-o"></i> Packages List</a></li>
            <li><a href="{{ url('/addpackage') }}"><i class="fa fa-circle-o"></i> Add Package</a></li>
            
          </ul>
        </li>  
    
        <li class="treeview">
          <a href="#">
            <i class="fa fa-hotel"></i><span>Hotels</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ url('/hotels-list') }}"><i class="fa fa-circle-o"></i> Hotels List</a></li>
            <li><a href="{{ url('/hotel-add') }}"><i class="fa fa-circle-o"></i> Add Hotel</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Tours</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{ url('/tours-list') }}"><i class="fa fa-circle-o"></i> Tours List</a></li>
            <li><a href="{{ url('/addtour') }}"><i class="fa fa-circle-o"></i> Add Tour</a></li>
          </ul>
        </li>

        
      @endif
 
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>