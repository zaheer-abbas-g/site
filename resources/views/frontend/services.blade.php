@extends('frontend.layout.master')

@section('title','services')
@section('content')

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
  
          <div class="d-flex justify-content-between align-items-center">
            <h2>Services</h2>
            <ol>
              <li><a href="{{ route('front.home') }}">Home</a></li>
              <li>Services</li>
            </ol>
          </div>
  
        </div>
    </section><!-- End Breadcrumbs -->
  
      <!-- ======= Services Section ======= -->
      <section id="services" class="services section-bg">

        <div class="container" data-aos="fade-up">
          <div class="row">
            @if (isset($data['service']))
            @foreach ($data['service'] as $items)
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon-box iconbox-blue mt-3">
                  <div class="icon " >
                      <!-- Web Development Icon -->
                      <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                          {!!  $items->service_icon !!}
                      </svg>
                      <i class="bx bxl-dribbble"></i> <!-- Placeholder icon for web development -->
                  </div>
                  <h4><a href="#">{{ $items->service_title }}</a></h4>
                  <p>{{ $items->short_description }}</p>
              </div>
          </div>
          @endforeach
            @else
                <p class="text-center">No Record Found</p>
            @endif
            
          </div>
        </div>

      </section>
      <!-- End Services Section -->
  
      <!-- ======= Features Section ======= -->
      <section id="features" class="features">
        <div class="container" data-aos="fade-up">

          <div class="section-title">
            <h2>Features</h2>
            <p>{{ $data['service_long_description']  }}</p>
          </div>
  
          <div class="row">
              @if (isset($data))
                @foreach ($data['service'] as $items)
                <div class="col-lg-3 col-md-4 mt-4">
                  <div class="icon-box">
                    {!! $items->featur_icon !!}
                    <h3><a href="#"></a>{{  $items->feature_title }}</h3>
                  </div>
                </div>  
                @endforeach
              @else
                  <p class="text-center">No Data found</p>
              @endif
          </div>

        </div>
      </section>
      <!-- End Features Section -->
@endsection