@extends('layouts.app')

@section('content')
    <div class="row">

    <div class="col-md-9  m-auto ">
        <div class="card">

            <div class="card-header"><h4>Change Camp Pic</h4></div>


                <div class="card-body">
                    <div class="col-md-10">
                    <div class="card-img-top"><h4>{{$camps->title}}</h4></div>
                    <div class="card-img"><img src="/images/{{ $camps->camp_pic}}" style="float: center; text-align:center; height: 250px; width: 60%;"></div>
                    </div>

                    <div class="col-md-9">


                        <form action="{{ route('camps.upload' , ['id' => $camps->id]) }}" method="post" enctype="multipart/form-data">

                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                                    <div class="form-group row">
                                        <label for="pic" class="col-md-4 col-form-label text-md-right">{{ __('Choose a pic') }}</label>

                                        <div class="col-md-8">
                                            <input type="file" id="pic" name="pic" class="form-control" required/>

                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Change') }}
                                            </button>
                                        </div>
                                    </div>

                        </form>
                    </div>
                </div>
        </div>
    </div>
    </div>


@endsection