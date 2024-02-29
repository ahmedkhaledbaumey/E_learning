@extends('Front.layout') 
@section('content') 

   <!-- breadcrumb start-->
   <section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>Course Details</h2>
                        <p>Homepage<span>/</span>Courses<span>{{ $courses->cat->name }}</span><span>{{ $courses->name }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->

<!--================ Start Course Details Area =================-->
<section class="course_details_area section_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 course_details_left">
                <div class="main_image">
                    <img class="img-fluid" src="{{ asset('upload/courses/'.$courses->img)}}" alt="">
                </div>
                <div class="content_wrapper py-5">
               {!! $courses->desc !!}
                </div>
            </div>


            <div class="col-lg-4 right-contents">
                <div class="sidebar_top">
                    <ul>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Trainer’s Nam</p>
                                <span class="color">{!! $courses->trainer->name !!}</span>
                            </a>
                        </li>
                        <li>
                            <a class="justify-content-between d-flex" href="#">
                                <p>Course Free </p>
                                <span> ${!! $courses->price!!}</span>
                            </a>
                        </li>
                       </ul>
                </div>  
                <div my-5>
                @include('Front.inc.errors') 
                <form class="form-contact contact_form" action="{{ route('Front.message.enroll') }}"  enctype="multipart/form-data" method="post" id="contactForm" > 
                  @csrf
                  <div class="row">
                 <input type="hidden" name="course_id" value="{{ $courses->id }}">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <input class="form-control" name="name"  type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder = 'Enter your name'>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <input class="form-control" name="email"  type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder = 'Enter email address'>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <input class="form-control" name="phone"  type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter tour speciality'" placeholder = 'Enter tour phone'>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <input class="form-control" name="spec"  type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter tour speciality'" placeholder = 'Enter tour speciality'>
                      </div>
                    </div>
                  </div>  

            <div class="col-12">
            <div class="form-group">
                <input class="form-control" name="img" type="file" accept="image/*">
            </div>
        </div>
    </div>

                  <div class="form-group mt-3">
                    <button type="submit" class="button button-contactForm btn_1">Enroll Course</button>
                  </div>
                </form> 
            </div>
            </div> 
        </div>
    </div>
</section>
<!--================ End Course Details Area =================-->

@endsection
