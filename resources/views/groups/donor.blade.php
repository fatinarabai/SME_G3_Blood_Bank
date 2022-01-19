@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card sm-hidden">

                <h4 class="card-header">
                    Search for a donor
                </h4>

                <div class="card-body">


                    <form action="{{ route('groups.donor') }}" method="get">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="groups_id">Blood Group : </label>
                                    <select name="groups_id" class="custom-select" id="groups_id">
                                    <option value="0" selected="" disabled>Choose One</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->b_group }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="State">State : </label>
                                            <select name="stateId" class="state custom-select" id="stateId">
                                            <option value="0" selected="" disabled>Choose One</option>
                                                @foreach($states as $state)
                                                <option value="{{ $state["id"] }}">{{ $state["state"] }}</option>
                                                @endforeach
                                            </select>
                                </div>
                            </div>

                        </div>



                        <input class="btn btn-primary btn-pill d-flex ml-auto mr-auto" type="submit" value="Search">


                    </form>


                    <button class="btn btn-sm btn-outline-danger"> Total Donors : &nbsp;&nbsp;<span class="badge-pill badge-outline-dark">{{ $users->count() }}</span></button>



                    <div class="card-body">


                        <table class="table table-hover table-sm">

                            <thead class="thead-light">

                            <th>
                                Name
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Blood Group
                            </th>


                            <th>
                                Gender
                            </th>

                            <th>
                                Age
                            </th>

                            <th>
                                Contact
                            </th>

                            <th>
                                Address
                            </th>


                            </thead>

                            <tbody>
                            @foreach($users as $user)
                                <tr>

                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->groups->b_group }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->getAge() }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>{{ $user->Address->street }}, {{ $user->Address->AddressesDistrict->name }}, {{ $user->Address->postcode }}, {{ $user->Address->AddressesState->state }}</td>

                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                    </div>


                </div>
            </div>
        </div>
    </div>









@endsection