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

                        <div class="form-group row">
                            <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Street') }}</label>

                            <div class="col-md-6">
                                <input id="street" type="text" class="form-control" name="street"   value="{{ $camps->Address->street }}"  required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stateId" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                            <div class="col-md-6">
                                <select name="stateId" class="state custom-select" id="stateId">
                                        <option value="{{ $camps->Address->AddressesState->id }}" selected="">{{ $camps->Address->AddressesState->state }}</option>
                                        @foreach($states as $state)
                                        <option value={{ $state["id"] }}>{{ $state["state"] }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>

                      

                        <div class="form-group row">
                            <label for="districtId" class="col-md-4 col-form-label text-md-right">{{ __('District') }}</label>

                            <div class="col-md-6">
                                <select name="districtId" class="district custom-select" id="districtId">
                                                <option value="{{ $camps->Address->AddressesDistrict->id }}" selected="">{{ $camps->Address->AddressesDistrict->name }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postcode" class="col-md-4 col-form-label text-md-right">{{ __('Postcode') }}</label>

                            <div class="col-md-6">
                                <input id="postcode" type="text" class="form-control" name="postcode"   value="{{ $camps->Address->postcode }}"  required>
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

@section('footer')
<script type="text/javascript">
    $(document).ready(function() {
        var state_id =  $('.state').val();
        $('#districtId').find('option').not(":first").remove();
        $.ajax({
            url:'/getDistrict/'+state_id,
            type:'get',
            dataType:'json',
            success:function(response){
                var len = 0;

                if(response!=null){
                    len = response.length;
                }

                if(len>0){
                    for(var i=0;i<len;i++){
                        var id=response[i]["id"];
                        var district = response[i]["district"];

                        var option  = "<option value="+id+"> "+district+"</option>";

                        $("#districtId").append(option);
                    }
                }
            }
        })

        $(document).on('change', '.state', function() {
        var state_id =  $('.state').val();     // get id the value from the select
       // set the textbox value

        $('#districtId').find('option').remove();

        $.ajax({
            url:'/getDistrict/'+state_id,
            type:'get',
            dataType:'json',
            success:function(response){
                var len = 0;

                if(response!=null){
                    len = response.length;
                }

                if(len>0){
                    for(var i=0;i<len;i++){
                        var id=response[i]["id"];
                        var district = response[i]["district"];

                        var option  = "<option value="+id+"> "+district+"</option>";

                        $("#districtId").append(option);
                    }
                }
            }
        })
        // if you want the selected text instead of the value
        // var air_text = $('.aircraftsName option:selected').text(); 
        });
    });
		</script>
@endsection