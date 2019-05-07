<?php

namespace App\Http\Controllers;

use Config;
use Validator;
use App\Http\Requests;
use App\Models\Community;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
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
    public function getContacts()
    {
        $data = [];
        $data['contacts'] = Contact::all();
        return view('contacts.all_contacts', $data);
    }

    public function createContacts()
    {
        return view('contacts.create_contacts');
    }

    public function storeContacts(Request $request)
    {
        $contactFields = Config::get('innovator.contact_fields');
        $contactData = $request->only($contactFields);

        $validator = Validator::make($contactData, Config::get('innovator.contact_fields_rules'));

        if($validator->fails())
        {
            return view('contacts.create_contacts')->withErrors($validator->errors()->all());
        }
        $community = Community::where('name','like',$contactData['community'])->get()->first();
        if($community == null)
        {
            $community = Community::create(['name'=>$contactData['community']]);
        }
        if(str_contains($contactData['phone_number'],","))
        {
            $nums = explode(',',$contactData['phone_number']);
            foreach($nums as $num)
            {
                if($this->contactExists($num))
                    continue;
                $contact = Contact::create([
                    'community_id'=>$community->id,
                    'full_name'=> str_random(6),
                    'phone_number'=>$num
                ]);
            }
        } else {
            if(!$this->contactExists($contactData["phone_number"]))
                $contact = Contact::create([
                    'community_id'=>$community->id,
                    'full_name'=>$contactData['fullname'],
                    'phone_number'=>$contactData['phone_number']
                ]);
        }
        return redirect('contacts');
    }

    public function contactExists($phone_number)
    {
        $_phone_number = Contact::where('phone_number','=',$phone_number)->get()->first();
        return ($_phone_number != null);
    }
}
