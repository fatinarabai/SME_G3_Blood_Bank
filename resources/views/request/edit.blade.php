@extends('layouts.app')

@section('content')
    <div class="col-md-10 m-auto">
        <div class="card sm-hidden">

            <div class="card">

                <div class="card-header">

                    Update a request

                </div>

                <div class="card-body">

                    <form action="{{ route('request.update' , ['id' => $requests->id]) }}" method="post">

                        {{ csrf_field() }}





                        <div class="form-group row">
                            <label for="contents" class="col-md-4 col-form-label text-md-right">{{ __('Reason') }}</label>

                            <div class="col-sm-7">
                                <textarea id="contents" type="text" cols="20" rows="10" class="form-control{{ $errors->has('contents') ? ' is-invalid' : '' }}" name="contents" required autofocus>{{ $requests->contents}}</textarea>
                                @if ($errors->has('contents'))
                                    <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('contents') }}</strong>
                                                        </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="required_till" class="col-md-4 col-form-label text-md-right">{{ __('Required Date') }}</label>

                            <div class="col-sm-6">
                                <input id="required_till" type="date" class="form-control{{ $errors->has('required_till') ? ' is-invalid' : '' }}" name="required_till" value="{{ $requests->required_till }}" required autofocus>

                                @if ($errors->has('required_till'))
                                    <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('required_till' , 'Entered date is invalid') }}</strong>
                                                        </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Street') }}</label>

                            <div class="col-md-6">
                                <input id="street" type="text" class="form-control" name="street"   value="{{ $requests->Address->street }}"  required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stateId" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                            <div class="col-md-6">
                                <select name="stateId" class="state custom-select" id="stateId">
                                        <option value="{{ $requests->Address->AddressesState->id }}">{{ $requests->Address->AddressesState->state }}</option>
                                        @foreach($states as $state)
                                        <option value="{{ $state["id"] }}">{{ $state["state"] }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="districtId" class="col-md-4 col-form-label text-md-right">{{ __('District') }}</label>

                            <div class="col-md-6">
                                <select name="districtId" class="district custom-select" id="districtId">
                                                <option value="{{  $requests->Address->AddressesDistrict->id }}" selected="">{{  $requests->Address->AddressesDistrict->name }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postcode" class="col-md-4 col-form-label text-md-right">{{ __('Postcode') }}</label>

                            <div class="col-md-6">
                                <input id="postcode" type="text" class="form-control" name="postcode"   value="{{ $requests->Address->postcode }}"  required>
                            </div>
                        </div>

                        <div class="form-group">

                            <button class="btn btn-success pull-right" type="submit">Update Request</button>

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