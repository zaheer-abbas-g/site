<aside class="left-sidebar bg-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">
      <!-- Aplication Brand -->
      <div class="app-brand">
        <a href="/index.html">
          <svg
            class="brand-icon"
            xmlns="http://www.w3.org/2000/svg"
            preserveAspectRatio="xMidYMid"
            width="30"
            height="33"
            viewBox="0 0 30 33"
          >
            <g fill="none" fill-rule="evenodd">
              <path
                class="logo-fill-blue"
                fill="#7DBCFF"
                d="M0 4v25l8 4V0zM22 4v25l8 4V0z"
              />
              <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
            </g>
          </svg>
          <span class="brand-name">My Services Site</span>
        </a>
      </div>
      <!-- begin sidebar scrollbar -->
      <div class="sidebar-scrollbar">

        <ul class="nav sidebar-inner" id="sidebar-menu">

          <!-- Dashboard Section -->
          <li class="has-sub {{ request()->routeIs('users.index') ? 'active expand' : '' }}">
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#dashboard"
              aria-expanded="{{ request()->routeIs('users.index') ? 'true' : 'false' }}" aria-controls="dashboard">
              <i class="mdi mdi-view-dashboard-outline"></i>
              <span class="nav-text">Dashboard</span> <b class="caret"></b>
            </a>
            <ul class="collapse {{ request()->routeIs('users.index') ? 'show' : '' }}" id="dashboard" data-parent="#sidebar-menu">
              <div class="sub-menu">
                <li class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
                  <a class="sidenav-item-link" href="{{ route('users.index') }}">
                    <span class="nav-text">Users</span>
                  </a>
                </li>
              </div>
            </ul>
          </li>

        <!-- Home Section -->
        <li class="has-sub {{ request()->routeIs('admin-service.*') ? 'active expand' : '' }}">
          <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#home"
            aria-expanded="{{ request()->routeIs('admin-service.*') ? 'true' : 'false' }}" aria-controls="home">
            <i class="mdi mdi-view-dashboard-outline"></i>
            <span class="nav-text">Home</span> <b class="caret"></b>
          </a>
          <ul class="collapse {{ request()->routeIs('admin-service.create') ? 'show' : '' }}" id="home" data-parent="#sidebar-menu">
            <div class="sub-menu">
              <li class="{{ request()->routeIs('admin-service.create') ? 'active' : '' }}">
                <a class="sidenav-item-link" href="{{ route('admin-service.create') }}">
                  <span class="nav-text">Services</span>
                </a>
              </li>
            </div>
          </ul>
        </li>

        <!-- About Section -->
        <li class="has-sub {{ request()->routeIs('admin-about.*') ? 'active expand' : '' }}">
          <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#about"
            aria-expanded="{{ request()->routeIs('admin-about.*') ? 'true' : 'false' }}" aria-controls="about">
            <i class="mdi mdi-information-outline"></i>
            <span class="nav-text">About</span> <b class="caret"></b>
          </a>
          <ul class="collapse {{ request()->routeIs('admin-about.create') ? 'show' : '' }}" id="about" data-parent="#sidebar-menu">
            <div class="sub-menu">
              <li class="{{ request()->routeIs('admin-about.create') ? 'active' : '' }}">
                <a class="sidenav-item-link" href="{{ route('admin-about.create') }}">
                  <span class="nav-text">About</span>
                </a>
              </li>

              <li class="{{ request()->routeIs('admin-team.create') ? 'active' : '' }}">
                <a class="sidenav-item-link" href="{{ route('admin-team.create') }}">
                  <span class="nav-text">Team</span>
                </a>
              </li>

              <li class="{{ request()->routeIs('admin-skill.create') ? 'active' : '' }}">
                <a class="sidenav-item-link" href="{{ route('admin-skill.create') }}">
                  <span class="nav-text">Skills</span>
                </a>
              </li>

              <li>
                <a class="sidenav-item-link" href="{{ route('admin-client.create') }}">
                  <span class="nav-text">Clients</span>
                </a>
              </li>

              <li>
                <a class="sidenav-item-link" href="{{ route('admin-testimonial.create') }}">
                  <span class="nav-text">Testimonials</span>
                </a>
              </li>
            </div>
          </ul>
        </li>

            
        
          <!-- Categories Section -->
          <li class="has-sub {{ request()->routeIs('categories.*') ? 'active expand' : '' }}">
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#charts"
              aria-expanded="{{ request()->routeIs('categories.*') ? 'true' : 'false' }}" aria-controls="charts">
              <i class="mdi mdi-tag"></i>
              <span class="nav-text">Categories</span> <b class="caret"></b>
            </a>
            <ul class="collapse {{ request()->routeIs('categories.*') ? 'show' : '' }}" id="charts" data-parent="#sidebar-menu">
              <div class="sub-menu">
                <li class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">
                  <a class="sidenav-item-link" href="{{ route('categories.index') }}">
                    <span class="nav-text">Categories</span>
                  </a>
                </li>
              </div>
            </ul>
          </li>
        
          <!-- Brands Section -->
          <li class="has-sub {{ request()->routeIs('brands.*') ? 'active expand' : '' }}">
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#brands"
              aria-expanded="{{ request()->routeIs('brands.*') ? 'true' : 'false' }}" aria-controls="brands">
              <i class="mdi mdi-spin mdi-star"></i>
              <span class="nav-text">Brands</span> <b class="caret"></b>
            </a>
            <ul class="collapse {{ request()->routeIs('brands.*') ? 'show' : '' }}" id="brands" data-parent="#sidebar-menu">
              <div class="sub-menu">
                <li class="{{ request()->routeIs('brands.index') ? 'active' : '' }}">
                  <a class="sidenav-item-link" href="{{ route('brands.index') }}">
                    <span class="nav-text">Brands</span>
                  </a>
                </li>
              </div>
            </ul>
          </li>
        
          <!-- Multiple Images Section -->
          <li class="has-sub {{ request()->routeIs('multipleimages.*') ? 'active expand' : '' }}">
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#images"
              aria-expanded="{{ request()->routeIs('multipleimages.*') ? 'true' : 'false' }}" aria-controls="images">
              <i class="mdi mdi-image-multiple"></i>
              <span class="nav-text">Multiple Images</span> <b class="caret"></b>
            </a>
            <ul class="collapse {{ request()->routeIs('multipleimages.*') ? 'show' : '' }}" id="images" data-parent="#sidebar-menu">
              <div class="sub-menu">
                <li class="{{ request()->routeIs('multipleimages.index') ? 'active' : '' }}">
                  <a class="sidenav-item-link" href="{{ route('multipleimages.index') }}">
                    <span class="nav-text">Multiple Images</span>
                  </a>
                </li>
              </div>
            </ul>
          </li>
        
          <!-- Faq Section -->
          <li class="has-sub{{ request()->routeIs('admin-faq.*') ? 'active expand' : '' }}">
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#faq"
              aria-expanded="{{ request()->routeIs('admin-faq.*') ? 'true' : 'false' }}" aria-controls="faq">
              <i class="mdi mdi-view-dashboard-outline"></i>
              <span class="nav-text">Faq</span> <b class="caret"></b>
            </a>
            <ul class="collapse {{ request()->routeIs('admin-faq.create') ? 'show' : '' }}" id="faq" data-parent="#sidebar-menu">
              <div class="sub-menu">
                <li class="{{ request()->routeIs('admin-faq.create') ? 'active' : '' }}">
                  <a class="sidenav-item-link" href="{{ route('admin-faq.create') }}">
                    <span class="nav-text">Faq</span>
                  </a>
                </li>
              </div>
            </ul>
          </li>

          <!-- Price Section -->
          <li class="has-sub{{ request()->routeIs('admin-price.*') ? 'active expand' : '' }}">
          <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#price"
            aria-expanded="{{ request()->routeIs('admin-price.*') ? 'true' : 'false' }}" aria-controls="price">
            <i class="mdi mdi-view-dashboard-outline"></i>
            <span class="nav-text">Price</span> <b class="caret"></b>
          </a>
          <ul class="collapse {{ request()->routeIs('admin-price.create') ? 'show' : '' }}" id="price" data-parent="#sidebar-menu">
            <div class="sub-menu">
              <li class="{{ request()->routeIs('admin-price.create') ? 'active' : '' }}">
                <a class="sidenav-item-link" href="{{ route('admin-price.create') }}">
                  <span class="nav-text">Price</span>
                </a>
              </li>
            </div>
          </ul>
          </li>


          <!-- Section Contact -->
          <li class="has-sub{{ request()->routeIs('admin-contact.*') ? 'active expand' : '' }}">
            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#contact"
              aria-expanded="{{ request()->routeIs('admin-contact.*') ? 'true' : 'false' }}" aria-controls="contact">
              <i class="mdi mdi-view-dashboard-outline"></i>
              <span class="nav-text">Contact</span> <b class="caret"></b>
            </a>
            <ul class="collapse {{ request()->routeIs('admin-contact.create') ? 'show' : '' }}" id="contact" data-parent="#sidebar-menu">
              <div class="sub-menu">
                <li class="{{ request()->routeIs('admin-contact.create') ? 'active' : '' }}">
                  <a class="sidenav-item-link" href="{{ route('admin-contact.create') }}">
                    <span class="nav-text">Contact</span>
                  </a>
                </li>
              </div>
            </ul>
          </li>

        </ul>
        
      </div>

    </div>
  </aside>
