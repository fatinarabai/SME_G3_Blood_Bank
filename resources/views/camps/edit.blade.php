@extends('layouts.app')

@section('content')
    <div class="col-md-10 m-auto">
        <div class="card sm-hidden">

            <div class="card">

            <h4 class="card-header">{{ __('Update a camp') }}</h4>


                <div class="card-body">

                    <div class="form-group row col-md-10 ">
                        <div class="card-img"><img src="/images/{{ $camps->camp_pic}}" style="float: center; text-align:center; height: 250px; width: 60%;"></div>
                        <a href="{{ route('camps.pic' , ['id' => $camps->id]) }}" class="btn btn-outline-primary btn-pill btn-sm pull-right"> Change Image</a>
                    </div>

                    <form action="{{ route('camps.update' , ['id' => $camps->id]) }}" method="post">

                        {{ csrf_field() }}

                        
                        <div class="form-group row">
                            
                            <lable for="title" class="col-md-4 col-form-label text-md-right">Title</lable>

                            <div class="col-md-6">
                                <input type="text" id="title"  name="title" value ="{{ $camps->title  }}" class="form-control"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <lable for="contents" class="col-md-4 col-form-label text-md-right">Description</lable>

                            <div class="col-md-6">
                                <textarea name="contents"  id="contents" cols="30" rows="10"  class="form-control">{{ $camps->contents }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <lable for="camp_date" class="col-md-4 col-form-label text-md-right">Camp Date</lable>

                            <div class="col-md-6">
                                <input type="date" id="camp_date" name="camp_date" value ="{{ $camps->camp_date  }}" class="form-control"/>
                            </div>
                        </div>



                        <div class="form-group">

                            <button class="btn btn-success pull-right" type="submit">Update a camp</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection