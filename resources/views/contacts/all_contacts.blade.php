@extends('layouts.root')

@section('content')
<div class="container" >
<div  class="section">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Members</span>
                          <table class=" table  table-hover table-condensed">
                                       <thead>
                                          <tr>
                                              <th data-field="id">Device</th>
                                              <th data-field="name">Name</th>
                                              <th data-field="price">Phone number</th>
                                               <th data-field="price">Edit</th>
                                               <th data-field="price">Delete</th>
                                          </tr>
                                        </thead>
                            
                                         
                            @foreach($contacts as $contact)
                            
                               <tr>
                                    <td><a class="btn-floating btn-large waves-effect waves-light "><i class="material-icons">phone</i></a></td>
                                    <td><b><span class="title">{{$contact->full_name}}</span></b></td>
                                    <td><p class="push-m4">{{$contact->phone_number}}</p></td>
                                    <td> <a><span class="label label-primary" style="cursor:pointer;">Edit</span></a></td>
                                    <td> <a><span class="label label-danger" style="cursor:pointer;">Delete</span></a></td>
                               </tr>
                               
                             @endforeach
                            
                        
                    </table>
                </div>
                {{--<div class="card-action">--}}
                {{--</div>--}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection