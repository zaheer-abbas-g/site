@extends('frontend.layout.master')


@section('title','about')

@section('content')

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
  
          <div class="d-flex justify-content-between align-items-center">
            <h2>About</h2>
            <ol>
              <li><a href="{{ route('front.home') }}">Home</a></li>
              <li>About</li>
            </ol>
          </div>
  
        </div>
      </section><!-- End Breadcrumbs -->
      <!-- ======= About Us Section ======= -->
      <section id="about-us" class="about-us">
        <div class="container" data-aos="fade-up">
          @isset($about)
          <div class="row content">
            <div class="col-lg-6" data-aos="fade-right">
              <h2>{{ $about['about']['about_title'] }}</h2>
              <h3>{{ $about['about']['about_short_description'] }} </h3>
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left">
              {!! $about['about']['about_long_description'] !!}
            </div>
          </div>
        </div>
        @endisset
        @empty($about)
        <p>No Data</p>
        @endempty
      </section><!-- End About Us Section -->
  
      <!-- ======= Our Team Section ======= -->
      <section id="team" class="team section-bg">
        <div class="container">
          
          <div class="section-title" data-aos="fade-up">
            <h2>Our <strong>Team</strong></h2>
            <p>{{ $about['team_description']['about_team_description'] }}</p>
          </div>
          
              @isset($about['team'])
                  <div class="row">
                  @foreach ($about['team'] as $items)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                          <div class="member" data-aos="fade-up">
                            <div class="">
                              <img src="{{ asset('frontend/assets/img/team/team-1.jpg') }}" class="img-fluid" alt="">
                              <div class="social">
                                <a href=""><i class="icofont-twitter"></i></a>
                                <a href=""><i class="icofont-facebook"></i></a>
                                <a href=""><i class="icofont-instagram"></i></a>
                                <a href=""><i class="icofont-linkedin"></i></a>
                              </div>
                            </div>
                            <div class="member-info">
                              <h4>{{ $items->name}}</h4>
                              <span>{{ $items->designation}}</span> 
                            </div>
                          </div>
                    </div>
                  @endforeach
                </div>
            @endisset
            @empty($about['team'])
              <p class="text-center">No Team Found</p>
            @endempty
        </div>
      </section><!-- End Our Team Section -->
  
      <!-- ======= Our Skills Section ======= -->
      <section id="skills" class="skills">
        <div class="container">
  
          <div class="section-title" data-aos="fade-up">
            <h2>Our <strong>Skills</strong></h2>
            <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
          </div>
  
          <div class="row skills-content">
  
            <div class="col-lg-6" data-aos="fade-up">
              <div class="mb-3">
                <span>HTML <i>100%</i></span>
                <div class="progress">
                  <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    <span class="visually-hidden">100%</span>
                  </div>
                </div>
              </div> 
            </div>
  
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
              <div class="mb-3">
                <span>Photoshop <i>55%</i></span>
                <div class="progress" id="myProgress">
                  <div id="myBar" class="progress-bar" role="progressbar" style="width: 55%" 
                       aria-valuenow="55" aria-valuemin="0" aria-valuemax="100">
                    <span class="visually-hidden">55%</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section><!-- End Our Skills Section -->
  
      <!-- ======= Our Clients Section ======= -->
      <section id="clients" class="clients">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
            <h2>Clients</h2>
          </div>
  
          <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">
  
            <div class="col-lg-3 col-md-4 col-6">
              <div class="client-logo">
                <img src="{{ asset('frontend/assets/img/clients/client-1.png') }}" class="img-fluid" alt="">
              </div>
            </div>
  
            <div class="col-lg-3 col-md-4 col-6">
              <div class="client-logo">
                <img src="{{ asset('frontend/assets/img/clients/client-2.png') }}" class="img-fluid" alt="">
              </div>
            </div>
  
            <div class="col-lg-3 col-md-4 col-6">
              <div class="client-logo">
                <img src="{{ asset('frontend/assets/img/clients/client-3.png') }}" class="img-fluid" alt="">
              </div>
            </div>
  
            <div class="col-lg-3 col-md-4 col-6">
              <div class="client-logo">
                <img src="{{ asset('frontend/assets/img/clients/client-4.png') }}" class="img-fluid" alt="">
              </div>
            </div>
  
            <div class="col-lg-3 col-md-4 col-6">
              <div class="client-logo">
                <img src="{{ asset('frontend/assets/img/clients/client-5.png') }}" class="img-fluid" alt="">
              </div>
            </div>
  
            <div class="col-lg-3 col-md-4 col-6">
              <div class="client-logo">
                <img src="{{ asset('frontend/assets/img/clients/client-6.png') }}" class="img-fluid" alt="">
              </div>
            </div>
  
            <div class="col-lg-3 col-md-4 col-6">
              <div class="client-logo">
                <img src="{{ asset('frontend/assets/img/clients/client-7.png') }}" class="img-fluid" alt="">
              </div>
            </div>
  
            <div class="col-lg-3 col-md-4 col-6">
              <div class="client-logo">
                <img src="{{ asset('frontend/assets/img/clients/client-8.png') }}" class="img-fluid" alt="">
              </div>
            </div>
  
          </div>
  
        </div>
      </section><!-- End Our Clients Section -->


      <style>
        .myProgress {
          width: 100%;
          background-color: #000000;
        }
        
        .myBar {
          width: 1%;
          height: 30px;
          background-color: #45ff07;
        }
      </style>

      <h1>JavaScript Progress Bar</h1>

      <script>
        $(document).ready(function(){
          
            let width = 1;
            const elem = document.getElementById("myBar");
            const id = setInterval(frame, 10);
        
            function frame() {
                if (width >= 60) {
                    clearInterval(id);
                } else {
                    width++;
                    elem.style.width = width + "%";
                }
            }
        });
        </script>
@endsection