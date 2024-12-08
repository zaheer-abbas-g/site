<style>
      /* Active Link Background Color */
    .sidenav-item-link.active {
    background-color: #007bff; /* Set your preferred active background color */
    color: #fff; /* Change the text color when active */
    }

    /* Hover Effect */
    .sidenav-item-link:hover {
    background-color: #0056b3; /* Set your preferred hover background color */
    color: #fff; /* Change the text color when hovered */
    }

    /* Submenu Active State */
    .sidenav-item-link.active-link {
    background-color: #007bff; /* Active background for submenu items */
    color: #fff; /* Text color for active submenu items */
    }

</style>

<header class="main-header " id="header">
    <nav class="navbar navbar-static-top navbar-expand-lg">
      <!-- Sidebar toggle button -->
      <button id="sidebar-toggler" class="sidebar-toggle">
        <span class="sr-only">Toggle navigation</span>
      </button>
      <!-- search form -->
      <div class="search-form d-none d-lg-inline-block">
        <div class="input-group">
          <button type="button" name="search" id="search-btn" class="btn btn-flat">
            <i class="mdi mdi-magnify"></i>
          </button>
          <input type="text" name="query" id="search-input" class="form-control" placeholder="'product', 'category' etc."
            autofocus autocomplete="off" />
        </div>
        <div id="search-results">
        
        </div>
      </div>

      <div class="navbar-right ">
        <ul class="nav navbar-nav">
        
          <!-- User Account -->
          <li class="dropdown user-menu">
            <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <img src="{{ asset('admin/assets/img/user/user.png') }}" class="user-image" alt="User Image" />
              <span class="d-none d-lg-inline-block">{{ auth()->user()->name }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
              <!-- User image -->
              <li class="dropdown-header">
                <img src="{{ asset('admin/assets/img/user/user.png') }}" class="img-circle" alt="User Image" />
                <div class="d-inline-block">
                  {{ auth()->user()->name }} <small class="pt-1">{{ auth()->user()->email  }}</small>
                </div>
              </li>

             
             
             
              <li>
                <a href="{{ route('profile.edit') }}"> <i class="mdi mdi-settings"></i> User Profile </a>
              </li>

              <li class="dropdown-footer">
                  <!-- Authentication -->
                  {{-- <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form> --}}
                <a href="{{ route('user.logout') }}"> <i class="mdi mdi-logout"></i> Log Out </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>


  </header>
