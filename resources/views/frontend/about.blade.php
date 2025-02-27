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
                              <img src="{{ asset('admin/upload/team/'.$items->image) }}" class="img-fluid" alt="">
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
            <p id="skill_title"></p>
          </div>
  
          <div class="row skills-content">
            <div class="col-lg-6" data-aos="fade-up" id="leftbar">
            </div>
  
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100" id="rightbar">
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
                 @if (isset($about))
                 @foreach ($about['client'] as $items)
                  <div class="col-lg-3 col-md-4 col-6">
                    <div class="client-logo">
                      <img src="{{ asset('admin/upload/client/'.$items->client_logo) }}" class="img-fluid" alt="">
                      </div>
                    </div>
                  @endforeach
                 @else
                 <p class="text-center"> No Record Found</p>
                 @endif
          </div>
        </div><!-- End Our Clients Section -->
      </section>

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
      <script>

    $(document).ready(function() {
        var client = []; 
        function getSkills() {
            $.ajax({
                url: "{{ url('front-about-getSkills') }}",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                  $('#skill_title').html(response.data.skill.title);
                    client = response.data.skill.map(element => ({ 
                        skill_name: element.skill_name, 
                        skill_percentage: element.skill_percentage 
                    }));
                    processbar(); 
                },
                error: function(xhr) {
                    console.error('Error fetching skills:', xhr);
                }
            });
        }

        function processbar() {
          const middleIndex = Math.ceil(client.length / 2); 
          $('#leftbar').empty();
          $('#rightbar').empty();
            client.forEach((element, index) => {
                const progressBarId = `progressBar${index}`; 
                const progressBarHtml = `
                    <div class="mb-3">
                        <span>${element.skill_name} <i>${element.skill_percentage}%</i></span>
                        <div class="progress">
                            <div id="${progressBarId}" 
                                class="progress-bar" 
                                role="progressbar" 
                                style="width: 0%;" 
                                aria-valuenow="0" 
                                aria-valuemin="0" 
                                aria-valuemax="100">
                                <span class="visually-hidden">${element.skill_percentage}%</span>
                            </div>
                        </div>
                    </div>
                `;
                if (index<middleIndex) {
                  $('#leftbar').append(progressBarHtml);
                }else{
                  $('#rightbar').append(progressBarHtml);
                }
                animateProgressBar(progressBarId, element.skill_percentage);
            });
        }

        function animateProgressBar(progressBarId, targetWidth) {
            let width = 0; // Start from 0%
            const progressBar = document.getElementById(progressBarId);
            const interval = setInterval(() => {
                if (width >= targetWidth) {
                    clearInterval(interval);
                } else {
                    width++;
                    progressBar.style.width = width + '%';
                    progressBar.setAttribute('aria-valuenow', width);
                }
            }, 10); // Adjust timing for smoother/faster animation
        }
        getSkills(); // Initialize the process
    });
</script>
 
@endsection