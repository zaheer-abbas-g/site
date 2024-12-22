<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto" class="{{ request()->routeIs('front.home')?'active':'' }}"><a href="{{ route('front.home') }}"><span>Com</span>pany</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
    
          <li class="{{ request()->routeIs('front.home')?'active':'' }}"><a href="{{ route('front.home') }}">Home</a></li>

          <li class="drop-down"><a href="">About</a>
            <ul>
              <li><a href="{{ route('front.about') }}">About Us</a></li>
              <li><a href="{{ route('front.about.team') }}">Team</a></li>
              <li><a href="{{ route('front.about.testimonials') }}">Testimonials</a></li>
              {{-- <li class="drop-down"><a href="#">Deep Drop Down</a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li> --}}
            </ul>
          </li>
          <li class="{{ request()->routeIs('front.services')? 'active':'' }}"><a href="{{ route('front.services') }}">services </a></li>
          {{-- <li><a href="services.html">Services</a></li> --}}
          <li><a href="{{ route('front.portfolio') }}">Portfolio</a></li>
          <li><a href="{{ route('front.pricing') }}">Pricing</a></li>
          <li><a href="{{ route('front.blog') }}">Blog</a></li>
          <li><a href="{{ route('front.contact') }}">Contact</a></li>
        </ul>
      </nav><!-- .nav-menu -->

      <div class="header-social-links">
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
      </div>

    </div>
  </header>