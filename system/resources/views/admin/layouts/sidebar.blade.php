<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route("admin.dashboard")}}" class="brand-link text-center">
      <h4>CMLW Portal</h4>
      {{-- <img src="{{asset('assets/images/logo.svg')}}" alt="Give Away Tips" width="150"> --}}
      {{-- <span class="brand-text font-weight-light">Give Away Tips</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex text-center">
        {{-- <div class="image">
          <img src="{{asset('assets/admin/dist/img/avatar3.png')}}" class="img-circle elevation-2" alt="User Image">
        </div> --}}
        <div class="info" style="margin:auto;">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link {{ (request()->segment(2) == 'dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          @can("read-labours")
          @include("admin.layouts.partials.navItem",
              [
                "page"=>"Labours",
                "icon"=>"nav-icon fas fa-users",
                "route"=>route('admin.labours.index'),
                "segment"=>"labours"
              ])
          @endcan

          @can("read-waiters")
          @include("admin.layouts.partials.navItem",
          [
            "page"=>"Waiters",
            "icon"=>"nav-icon fas fa-concierge-bell",
            "route"=>route('admin.waiters.index'),
            "segment"=>"waiters"
          ])
          @endcan

          @can("read-users")
          @include("admin.layouts.partials.navItem",
              [
                "page"=>"Users",
                "icon"=>"nav-icon fas fa-users",
                "route"=>route('admin.users.index'),
                "segment"=>"users"
              ])
          @endcan

          @can("read-roles")
          @include("admin.layouts.partials.navItem",
              [
                "page"=>"Roles",
                "icon"=>"nav-icon fas fa-user-tag",
                "route"=>route('admin.roles.index'),
                "segment"=>"roles"
              ])
          @endcan

          @can("read-permissions")
          @include("admin.layouts.partials.navItem",
              [
                "page"=>"Permissions",
                "icon"=>"nav-icon fas fa-key",
                "route"=>route('admin.permissions.index'),
                "segment"=>"permissions"
              ])
          @endcan

          @can("read-modules")
          @include("admin.layouts.partials.navItem",
          [
            "page"=>"Modules",
            "icon"=>"nav-icon fas fa-shapes",
            "route"=>route('admin.modules.index'),
            "segment"=>"modules"
          ])
          @endcan

          @can("read-setting")
          @include("admin.layouts.partials.navItem",
          [
            "page"=>"Setting",
            "icon"=>"nav-icon fas fa-shapes",
            "route"=>route('admin.setting.index'),
            "segment"=>"setting"
          ])
          @endcan

          <li class="nav-item">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>