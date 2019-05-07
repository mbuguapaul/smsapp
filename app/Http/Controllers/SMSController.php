<?php

namespace App\Http\Controllers;

use App\Helpers\SMSTemplate;
use Config;
use Validator;
use App\Http\Requests;
use App\Models\Contact;
use App\Models\Sms;
use Illuminate\Http\Request;

class SMSController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSentSmses()
    {
        $data = [];
        $data['smses'] = Sms::where('status',1)->orderBy('created_at','desc')->get();

        return view('sent_sms', $data);
    }

    public function createNewSmses()
    {
        $contacts = Contact::all();
        $data = [];
        $data['contacts'] = $contacts;

       return view('new_sms', $data);
    }
    
    public function sendNewSmses(Request $request)
    {
        //var_dump($request->only('contacts','message'));
        $newsmsFields = Config::get('innovator.newsms_fields');
        $newsmsData = $request->only($newsmsFields);
        $validator = Validator::make($newsmsData, Config::get('innovator.newsms_fields_rules'));

        if($validator->fails())
        {
            return view('new_sms')->withErrors($validator->errors()->all());
        }
        if($request->only('contacts')['contacts'][0] == "ALL")
        {
            foreach(Contact::all() as $contact)
            {
                Sms::create([
                    'contact_id'=>$contact->id,
                    'sms_body'=>$this->messageCleanser($newsmsData['message'],$contact->id)
                ]);
            }
        }
        else
        {
            foreach($request->only('contacts')["contacts"] as $contact=>$id)
            {
                Sms::create([
                    'contact_id'=>(int)$id,
                    'sms_body'=>$this->messageCleanser($newsmsData['message'],$id)
                ]);
            }
        }

        return response()->redirectTo('smses/queued');
    }

    public function getQueuedSmses()
    {
        $data = [];
        $data['smses'] = Sms::where('status',0)->orderBy('created_at','desc')->get();
        return view('queued_sms', $data);
    }

    public function messageCleanser($message,$contact)
    {
        return SMSTemplate::parse($contact,$message);
    }
}