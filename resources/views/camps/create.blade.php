@extends('layouts.app')


@section('content')

    <div class="row ">

        <div class="col-md-10 m-auto">

            <div class="card sm-hidden">

                <h4 class="card-header">{{ __('Create a camp') }}</h4>

                <div class="card-body">
                    <form method="post" action="{{ route('camps.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title of the camp') }}</label>

                            <div class="col-md-6">
                                <input name="title" class="form-control" id="title"/>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="contents" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-sm-7">
                                <textarea id="contents" type="text" cols="20" rows="10" class="form-control{{ $errors->has('contents') ? ' is-invalid' : '' }}" name="contents"  required autofocus></textarea>

                                @if ($errors->has('contents'))
                                    <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('contents') }}</strong>
                                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="camp_date" class="col-md-4 col-form-label text-md-right">{{ __('Camp Date') }}</label>

                            <div class="col-sm-6">
                                <input id="camp_date" type="date" class="form-control{{ $errors->has('camp_date') ? ' is-invalid' : '' }}" name="camp_date" placeholder="eg. 29th august,2018" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Street') }}</label>

                            <div class="col-md-6">
                            <input id="street" type="text" class="form-control" name="street" value="{{ old('street') }}"  required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stateId" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>
                            <div class="col-md-6">
                                <select name="stateId" class="state custom-select" id="stateId">
                                        <option value="0" selected="" disabled>Choose One</option>
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
                                        <option value="0" selected="" disabled>Choose One</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postcode" class="col-md-4 col-form-label text-md-right">{{ __('Postcode') }}</label>

                            <div class="col-md-6">
                            <input id="postcode" type="text" class="form-control" name="postcode" value="{{ old('postcode') }}"  required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="pic" class="col-md-4 col-form-label text-md-right">{{ __('Choose a pic') }}</label>

                            <div class="col-md-8">
                                <input type="file" id="pic" name="pic" class="form-control" required/>

                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success pull-right" type="submit">Submit</button>
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
        $(document).on('change', '.state', function() {
        var state_id =  $('.state').val();     // get id the value from the select
        console.log(state_id);   // set the textbox value

        $('#districtId').find('option').not(":first").remove();

        $.ajax({
            url:'/getDistrict/'+state_id,
            type:'get',
            dataType:'json',
            success:function(response){
                console.log(response[0]["id"]);
                console.log(response.length);
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