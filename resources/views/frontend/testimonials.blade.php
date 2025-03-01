@extends('frontend.layout.master')

@section('title','team')
@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
          <div class="d-flex justify-content-between align-items-center">
            <h2>Testimonials</h2>
            <ol>
              <li><a href="{{ route('front.home') }}">Home</a></li>
              <li>Testimonials</li>
            </ol>
          </div>
        </div>
      </section><!-- End Breadcrumbs -->
  
      <!-- ======= Testimonials Section ======= -->
      <section id="testimonials" class="testimonials section-bg">
        <div class="container">
          <div class="row">
            @if (isset($testimonials))
              @foreach ($testimonials['getTestimonials'] as $items)
                <div class="col-lg-6 mb-3" data-aos="fade-up">
                  <div class="testimonial-item" id="box{{ $items->id }}"  style="border-radius: 2%">
                    <img src="{{ asset('admin/upload/testimonials/'.$items->image) }}" class="testimonial-img" alt="">
                    <h3>{{ $items->name }}</h3>
                    <h4>{{ $items->designation }}</h4>
                    <p>
                      <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                      @php
                        $limit = 150 ;
                        $strlent = Str::length($items->long_description)
                      @endphp
                         {{Str::limit($items->long_description, $limit, ' .... ') }} 
                         @if ($strlent >=  $limit )
                             <a href="#">Read More</a>
                         @endif
                      <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                  </div>
                </div>
              @endforeach
            @else
              <p class="text-center">No Record Found</p>
            @endif
          </div>
        </div>
      </section>
      <script>
        $(document).ready(function(){
              $("[id^='box']").on({
              mouseenter: function(){
                $(this).css({
                  "background-color": "#f2c993",
                  "transform": "scale(1.1)", // Zoom in
                  "transition": "transform 0.3s ease"
                });
              },  
              mouseleave: function(){
                $(this).css({
                  "background-color": "white",
                  "transform": "scale(1)", // Reset zoom
                  "transition": "transform 0.3s ease"
                });
              }, 
              click: function(){
                $(this).css("background-color", "yellow");
              }  
            });
            });

      </script>
      @endsection