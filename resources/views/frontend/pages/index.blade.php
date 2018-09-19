@extends('frontend.layouts.master')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <h3 style="margin-left: 50px"><b><i>Rate`My`Teachers</i></b></h3>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div id="my-slider" class="carousel slide" data-ride="carousel">

          <ol class="carousel-indicators">
            <li data-target="#my-slider" data-slide-to="0" class="active"></li>
            <li data-target="#my-slider" data-slide-to="1"></li>
            <li data-target="#my-slider" data-slide-to="2"></li>
          </ol>


          <div class="carousel-inner" role="listbox">
            <div class="item active">
              <img src="{{ asset('public/image/u.jpg') }}" alt="u"/>
              <div class="carousel-caption">
                <h1>Welcome to RateMyTeachers</h1>
              </div>
            </div>

            <div class="item">
              <img src="{{ asset('public/image/p.jpg') }}" alt="p" />
              <div class="carousel-caption">
                <h1>Helping students to express their opinion</h1>
              </div>
            </div>

            <div class="item">
              <img src="{{ asset('public/image/d.jpg') }}" alt="d" />
              <div class="carousel-caption">
                <h1>Helping teachers to make themselves more active</h1>
              </div>
            </div>
          </div>

          <a class="left carousel-control" href="#my-slider" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>

          <a class="right carousel-control" href="#my-slider" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
        </div>
      </div>
    </div>

    <div class="row" style="background-color: #002E63">
      <div class="col-md-12">
        <div class="row" style="margin-left: 80px">
          <div class="col-md-11" style="background-color: #FFBF00">
            <div class="row" style="margin-left: 130px">
              <div class="col-md-10" style="background-color: #702963">
                <div class="row" style="margin-left: 130px">
                  <div class="col-md-9" style="background-color: #779ECB">
                    <h1><font color="#FFF"></font></h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      @foreach($departments as $department)
      <div class="col-md-3" style="margin-top: 10px">
        <div class="panel panel-primary" style="background-color: #008B8B">
         <div class="panel-body single-link" onclick="location.href='{!! route('departmentCourse', $department->short_name) !!}'">
          <style>
          .rounded{
                 width: 120px;
                 margin:auto;
                }
                .rounded img {
                  border-radius: 50%;
                }
                 
         </style>
        
          <div class="rounded">
              <img src="{{ asset('public/dep.jpg') }}" alt="dep" width="120px" height="120px" />
              
            </div>
            <h3><b>{{ $department->name }}</b></h3> 
           </div>
          </div>
                
        </div>
       @endforeach
    </div>
  </div>


@endsection
