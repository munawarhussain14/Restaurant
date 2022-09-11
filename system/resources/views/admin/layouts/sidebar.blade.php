<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route("admin.dashboard")}}" class="brand-link text-center">
      {{-- <img src="{{asset('assets/admin/dist/img/logo.png')}}" alt="Moderate" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">Moderate</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/admin/dist/img/avatar3.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
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

          @can("read-restaurants")
          @include("admin.layouts.partials.navItem",
              [
                "page"=>"Restaurants",
                "icon"=>"nav-icon fas fa-hotel",
                "route"=>route('admin.restaurants.index'),
                "segment"=>"restaurants"
              ])
          @endcan

          @can("read-mtc-minutes")
          <li class="nav-item {{ (request()->segment(2) == 'minutes') ? 'menu-open' : '' }}">  
            <a href="#" class="nav-link {{ (request()->segment(2) == 'minutes') ? 'active' : '' }}">
              <i class="nav-icon fas fa-scroll"></i>
              <p>
                MTC Minutes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
            <ul class="nav nav-treeview">
              @can("create-mtc-minutes")
              <li class="nav-item">
                <a href="{{route('admin.minutes.create')}}" class="nav-link {{ (request()->is('admin/minutes/create')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Minutes</p>
                </a>
              </li>
              @endcan
              @can("read-mtc-minutes")
              <li class="nav-item">
                <a href="{{route('admin.minutes.index')}}" class="nav-link {{ (request()->is('admin/minutes')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Minutes</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcan
          
          @can("read-tenders")
          <li class="nav-item {{ (request()->segment(2) == 'tenders') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->segment(2) == 'tenders') ? 'active' : '' }}">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Tenders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              @can("create-tenders")
              <li class="nav-item">
                <a href="{{route('admin.tenders.create')}}" class="nav-link {{ (request()->is('admin/tenders/create')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Tender</p>
                </a>
              </li>
              @endcan
              @can("read-tenders")
              <li class="nav-item">
                <a href="{{route('admin.tenders.index')}}" class="nav-link {{ (request()->is('admin/tenders')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Tenders</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcan
          @can("read-auctions")
          @include("admin.layouts.partials.navItem",
              [
                "page"=>"Auctions",
                "icon"=>"nav-icon fas fa-gavel",
                "route"=>route('admin.auctions.index'),
                "segment"=>"auctions"
              ])
          @endcan

          @can("read-forms-and-templates")
          @include("admin.layouts.partials.navItem",
              [
                "page"=>"Forms and Templates",
                "icon"=>"nav-icon fas fa-file",
                "route"=>route('admin.forms-and-templates.index'),
                "segment"=>"forms-and-templates"
              ])
          @endcan
       
          @can("read-geological-reports")
          @include("admin.layouts.partials.navItem",
              [
                "page"=>"Geological Reports",
                "icon"=>"nav-icon fas fa-map",
                "route"=>route('admin.geological-reports.index'),
                "segment"=>"geological-reports"
              ])
          @endcan        

          @can("read-notifications")
          @include("admin.layouts.partials.navItem",
              [
                "page"=>"Notifications",
                "icon"=>"nav-icon fas fa-bell",
                "route"=>route('admin.notifications.index'),
                "segment"=>"notifications"
              ])
          @endcan

          @can("read-rules-and-policies")
          @include("admin.layouts.partials.navItem",
              [
                "page"=>"Rules and Policies",
                "icon"=>"nav-icon fas fa-file",
                "route"=>route('admin.rules-and-policies.index'),
                "segment"=>"rules-and-policies"
              ])
          @endcan

          @can("read-announcements")
          @include("admin.layouts.partials.navItem",
              [
                "page"=>"Announcements",
                "icon"=>"nav-icon fas fa-bullhorn",
                "route"=>route('admin.announcements.index'),
                "segment"=>"announcements"
              ])
          @endcan

          @can("read-test-types")
          @include("admin.layouts.partials.navItem",
              [
                "page"=>"Test Type",
                "icon"=>"nav-icon fas fa-vials",
                "route"=>route('admin.test-types.index'),
                "segment"=>"test-types"
              ])
          @endcan

          @can("read-test-elements")
          @include("admin.layouts.partials.navItem",
              [
                "page"=>"Test Elements",
                "icon"=>"nav-icon fab fa-battle-net",
                "route"=>route('admin.test-elements.index'),
                "segment"=>"test-elements"
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

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>