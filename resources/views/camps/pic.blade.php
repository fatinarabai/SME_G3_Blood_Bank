@extends('layouts.app')

@section('content')
<div class="row">

    <div class="col-md-9  m-auto ">
        <div class="card">

            <div class="card-header"><h4>Change Camp Pic</h4>
            </div>


            <div class="card-body center">
                <div class="col-md-10">
                    <div class="card-img-top"><h4>{{$camps->title}}</h4></div>
                    
                        <div class="card-img">
                        </div>
                    </div>

                    <div class="col-md-9">
                        <form action="{{ route('camps.upload' , ['id' => $camps->id]) }}" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                        <div  class="form-group row">
                            

                            <div class="col-md-12">
                                <table class="col-md-12">
                                    <tr>
                                        <td class="col-md-12"><img src="/images/{{ $camps->camp_pic}}" style="float: center; text-align:center; max-height:100%; max-width:100%; overflow:fit;" >
                                        <input type="file" id="pic" name="pic" class="form-control" required/>
                                        <button type="submit" class="btn btn-primary">{{ __('Change') }}</button></td>
                                        
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div  style="text-align: right;" class="col-md-6 offset-md-4">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection