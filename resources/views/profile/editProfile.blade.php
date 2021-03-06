@extends('layouts.app')

@section('content')
    <div class="row">

    <div class="col-md-10 ">
        <div class="card">

            <div class="card-header">Edit Your Profile</div>

            <div class="card-body">

            <form action="{{route('profile.update')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>


                <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $u->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="user_name" type="text" class="form-control" name="user_name" value="{{ $u->username }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select name="role" id="role" class="form-control">
                                    <option value = "Donor"  <?php echo ('Donor'== $u->role ? 'selected="selected"': ''); ?> >Donor</option>
                                    <option value = "Requestor"<?php echo ('Requestor'== $u->role ? 'selected="selected"': ''); ?> >Requestor</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="tel" class="form-control{{ $errors->has('mobile') ?' is-invalid' : '' }}" name="mobile" value="{{ $u->mobile }}" required>

                                @if ($errors->has('mobile'))
                                    <span class="invalid-feedback">
                                                <strong>{{ $errors->first('mobile','It must be at least 10 digits') }}</strong>
                                            </span>
                                @endif
                            </div>

                        </div>


                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date Of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control{{ $errors->has('dob') ?' is-invalid' : '' }}" name="dob" value="{{ $u->dob->format('Y-m-d') }}"  required>

                                @if ($errors->has('dob'))
                                    <span class="invalid-feedback">
                                                <strong>{{ $errors->first('dob','You must be 18 yrs old') }}</strong>
                                            </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Street') }}</label>

                            <div class="col-md-6">
                                <input id="street" type="text" class="form-control" name="street"   value="{{ $u->Address->street }}"  required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stateId" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                            <div class="col-md-6">
                                <select name="stateId" class="state custom-select" id="stateId">
                                        <option value="{{ $u->Address->AddressesState->id }}">{{ $u->Address->AddressesState->state }}</option>
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
                                                <option value="{{ $u->Address->AddressesDistrict->id }}" selected="">{{ $u->Address->AddressesDistrict->name }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="postcode" class="col-md-4 col-form-label text-md-right">{{ __('Postcode') }}</label>

                            <div class="col-md-6">
                                <input id="postcode" type="text" class="form-control" name="postcode"   value="{{ $u->Address->postcode }}"  required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
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
