@extends('frontend.layout.master')


@section('title','team')

@section('content')
 
 
 <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Team</h2>
          <ol>
            <li><a href="{{ route('front.home') }}">Home</a></li>
            <li>Team</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Our Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Our <strong>Team</strong></h2>
          <p>{{   $about['team_description']['team'] ? $about['team_description']['team'] : "";  }}</p>
        </div>

        <div class="row">
          @if (isset($about))
            @foreach ($about['team'] as $items)
              <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                <div class="member" data-aos="fade-up">
                  <div class="member-img">
                    <img src="{{ asset('admin/upload/team/'.$items->image) }}" class="img-fluid" alt="">
                    <div class="social">
                      <a href=""><i class="icofont-twitter"></i></a>
                      <a href=""><i class="icofont-facebook"></i></a>
                      <a href=""><i class="icofont-instagram"></i></a>
                      <a href=""><i class="icofont-linkedin"></i></a>
                    </div>
                  </div>
                  <div class="member-info">
                    <h4>{{ $items->name }}</h4>
                    <span>{{ $items->designation }}</span>
                  </div>
                </div>
              </div>
            @endforeach
          @else
            <p class="text-center">No Record Found</p>
          @endif
        </div>
      </div>
    </section>
    @endsection