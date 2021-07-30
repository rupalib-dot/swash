<!-- Main Sidebar Container -->
<style>
    .sidebarLi{
       height: 40px; ''
    }
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('public/styles/admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Pannel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('public/styles/admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin User </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library --> 
          <li href="{{route('dashboard')}}" data-active="{{ Request::is('admin/dashboard') ? 'true' : 'false' }}" aria-expanded="false" class="dropdown-toggle sidebarLi">
            <a href="{{route('dashboard')}}" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p> Dashboard</p></a>
          </li>

          <li class="menu">
              <a href="#customers" data-toggle="collapse" data-active="{{ Request::is('admin/customers*') ? 'true' : 'false' }}" aria-expanded="{{ Request::is('admin/customers*') ? 'true' : 'false' }}" class="dropdown-toggle {{ Request::is('admin/customers*') ? '' : 'collapsed' }}">
                  <div class="">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                      <span>Customers</span>
                  </div>
                  <div>
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                  </div>
              </a>
              <ul class="collapse submenu list-unstyled {{ Request::is('admin/customers*') ? 'collapse show' : '' }}" id="customers" data-parent="#accordionExample">
                  <li class="{{ Request::is('admin/customers/create') || Request::is('admin/customers/*/edit') ? 'active' : '' }}">
                      <a href="{{route('customers.create')}}"> Create Customer  </a>
                  </li>                           
                  <li class="{{ Request::is('admin/customers') ? 'active' : '' }}">
                      <a href="{{route('customers.index')}}"> Customer List  </a>
                  </li>                           
              </ul>
          </li>

          <!-- <li href="{{route('customers.index')}}" data-active="{{ Request::is('customers*') ? 'true' : 'false' }}" aria-expanded="false" class="dropdown-toggle sidebarLi">
            <a href="{{route('customers.index')}}" class="nav-link"><i class="fas fa-user-friends"></i><p> Customers</p></a>
          </li>  -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
