@extends('layouts.root')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m12">
                <div class="card  hoverable blue lighten-1">
                    <div class="card-content white-text">
                        <span class="card-title">Sent SMSes</span>
                        <p>Sent Community Notifications using this App.</p>
                    </div>
                    {{--<div class="card-action">--}}
                    {{--<a href="#" class="pull-right">Send</a>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m12">
                <div class="card hoverable">
                    <div class="card-content">
                        <div class="card-title">{{count($smses)}} - Sent SMS</div>
                        <ul class="collection">
                        @foreach($smses as $sms)
                            <li class="collection-item avatar">
                                <i class="material-icons circle red">textsms</i>
                                <span class="title">{{$sms->contact->phone_number}}</span>
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
@endsection
