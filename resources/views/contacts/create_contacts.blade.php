@extends('layouts.root')

@section('content')
    <div class="container"  >
        <div  class="section"style="background-image:url('img/2.jpg');">
            <div class="row">
                <div class="col s12">
                    <div class="card hoverable">
                        <div class="card-content">
                            <div class="card-title">Create New Contact</div>
                            <div class="row">
                                <form class="col s12" action="{{url('/contacts/add')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="input-field col s12">
                                            
                                            <input type="text" name="phone_number" id="icon_prefix1" class="input" length="12">
                                            <label for="icon_prefix1">Phone</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                           
                                            <input type="text" name="fullname" id="icon_prefix2" class="input">
                                            <label for="icon_prefix2">Full Name</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            
                                            <input type="text" name="community" id="icon_prefix3" class="input">
                                            <label for="icon_prefix3">Community</label>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-primary pull-right">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection