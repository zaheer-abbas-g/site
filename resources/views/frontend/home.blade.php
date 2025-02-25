@extends('frontend.layout.master')


@section('title','Home')


@section('content')
      <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url({{ asset('frontend/assets/img/slide/slide-1.jpg') }});">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
              <h2>Welcome to <span>Company</span></h2>
              <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
              <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url({{ asset('frontend/assets/img/slide/slide-2.jpg') }});">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
              <h2>Lorem Ipsum Dolor</h2>
              <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
              <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url({{ asset('frontend/assets/img/slide/slide-3.jpg') }});">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
              <h2>Sequi ea ut et est quaerat</h2>
              <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
              <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
            </div>
          </div>
        </div>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
  </section>
  <!-- End Hero -->

  
    <!-- ======= About Us Section ======= -->
    <section id="about-us" class="about-us">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
            <h2>About Us</strong></h2>
          </div>
  
          <div class="row content">
            <div class="col-lg-6" data-aos="fade-right">
              <h2 id="about_title"></h2>
              <h3 id="about_short_description"></h3>
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left" id="about_long_description">
            
            </div>
          </div>
  
        </div>
    </section>
    <!-- End About Us Section -->
  
      <!-- ======= Services Section ======= -->
      <section  class="services section-bg" >
       <div class="container" data-aos="fade-up" >
  
          <div class="section-title">
            <h2>Services</strong></h2>
            <p>Laborum repudiandae omnis voluptatum consequatur mollitia ea est voluptas ut</p>
          </div>
          <div class="row"  id="services">

          </div>
        </div>
      </section><!-- End Services Section -->
  
      <!-- ======= Portfolio Section ======= -->
      <section id="portfolio" class="portfolio">
        <div class="container">
  
          <div class="section-title" data-aos="fade-up">
            <h2>Portfolio</h2>
          </div>
  
          <div class="row" data-aos="fade-up">
            <div class="col-lg-12 d-flex justify-content-center">
              <ul id="portfolio-flters">
                <li data-filter="*" class="filter-active">All</li>
                <li data-filter=".filter-app">App</li>
                <li data-filter=".filter-card">Card</li>
                <li data-filter=".filter-web">Web</li>
              </ul>
            </div>
          </div>
  
          <div class="row portfolio-container" data-aos="fade-up">
  
            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{asset('frontend/assets/img/portfolio/portfolio-1.jpg')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>App 1</h4>
                <p>App</p>
                <a href="{{asset('frontend/assets/img/portfolio/portfolio-1.jpg')}}" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
  
            <div class="col-lg-4 col-md-6 portfolio-item filter-web">
              <img src="{{asset('frontend/assets/img/portfolio/portfolio-2.jpg')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Web 3</h4>
                <p>Web</p>
                <a href="{{asset('frontend/assets/img/portfolio/portfolio-2.jpg')}}" data-gall="portfolioGallery" class="venobox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
  
            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{asset('frontend/assets/img/portfolio/portfolio-3.jpg')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>App 2</h4>
                <p>App</p>
                <a href="{{asset('frontend/assets/img/portfolio/portfolio-3.jpg')}}" data-gall="portfolioGallery" class="venobox preview-link" title="App 2"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
  
            <div class="col-lg-4 col-md-6 portfolio-item filter-card">
              <img src="{{asset('frontend/assets/img/portfolio/portfolio-4.jpg')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Card 2</h4>
                <p>Card</p>
                <a href="{{asset('frontend/assets/img/portfolio/portfolio-4.jpg')}}" data-gall="portfolioGallery" class="venobox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
  
            <div class="col-lg-4 col-md-6 portfolio-item filter-web">
              <img src="{{asset('frontend/assets/img/portfolio/portfolio-5.jpg')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Web 2</h4>
                <p>Web</p>
                <a href="{{asset('frontend/assets/img/portfolio/portfolio-5.jpg')}}" data-gall="portfolioGallery" class="venobox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
  
            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <img src="{{asset('frontend/assets/img/portfolio/portfolio-6.jpg')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>App 3</h4>
                <p>App</p>
                <a href="{{asset('frontend/assets/img/portfolio/portfolio-6.jpg')}}" data-gall="portfolioGallery" class="venobox preview-link" title="App 3"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
  
            <div class="col-lg-4 col-md-6 portfolio-item filter-card">
              <img src="{{asset('frontend/assets/img/portfolio/portfolio-7.jpg')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Card 1</h4>
                <p>Card</p>
                <a href="{{asset('frontend/assets/img/portfolio/portfolio-7.jpg')}}" data-gall="portfolioGallery" class="venobox preview-link" title="Card 1"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
  
            <div class="col-lg-4 col-md-6 portfolio-item filter-card">
              <img src="{{asset('frontend/assets/img/portfolio/portfolio-8.jpg')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Card 3</h4>
                <p>Card</p>
                <a href="{{asset('frontend/assets/img/portfolio/portfolio-8.jpg')}}" data-gall="portfolioGallery" class="venobox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
  
            <div class="col-lg-4 col-md-6 portfolio-item filter-web">
              <img src="{{asset('frontend/assets/img/portfolio/portfolio-9.jpg')}}" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Web 3</h4>
                <p>Web</p>
                <a href="{{asset('frontend/assets/img/portfolio/portfolio-9.jpg')}}" data-gall="portfolioGallery" class="venobox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
  
          </div>
  
        </div>
      </section>
      <!-- End Portfolio Section -->
  

      <!-- ======= Our Clients Section ======= -->
         <!-- ======= Our Clients Section ======= -->
    <section  class="clients">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Clients</h2>
        </div>

        <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up" id="clients">

        </div>
      </div>
    </section>
      <!-- End Our Clients Section -->
  
    
      @push('script')
        <script src="{{ asset('frontend/assets/js/home/home.js') }}"></script>
      @endpush
@endsection