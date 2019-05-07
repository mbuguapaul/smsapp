@extends('layouts.root')

@section('content')
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 m12">
                    <div class="card hoverable">
                        <div class="card-content">
                            <div class="card-title">{{count($smses)}} - Queued SMS</div>
                            <ul class="collection">
                                @foreach($smses as $sms)
                                    <li class="collection-item avatar">
                                        <i class="material-icons circle red">textsms</i>
                                        <span class="title">{{$sms->contact->full_name.' - '.$sms->contact->phone_number}}</span>
                                        <p>{{$sms->sms_body}}<br>
                                        </p>
                                        <p class="push-m8 grey-text">Sent - {{$sms->created_at}}</p>
                                        <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection