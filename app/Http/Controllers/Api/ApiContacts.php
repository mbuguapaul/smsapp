<?php

namespace App\Http\Controllers\Api;

use Config;
use Validator;
use App\Models\Contact;
use App\Models\Community;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Http\Requests;

class ApiContacts extends Controllers\Controller
{
    public function getContacts()
    {
        $data = Contact::all()->load('community');
        return response()->json($data);
    }

    public function storeContacts(Request $request)
    {
        $contactData = $request->only('phone_number','full_name','community');
        $contactData = json_decode(json_encode($contactData));

        $community = Community::where('name','like',$contactData->community->name)->get()->first();
        if($community == null)
        {
            $community = Community::create(['name'=>$contactData->community->name]);
        }
        if(!$this->contactExists($contactData->phone_number))
            $contact = Contact::create([
                'community_id'=>$community->id,
                'full_name'=>$contactData->full_name,
                'phone_number'=>$contactData->phone_number
            ]);
        return response()->json($contact);
    }

    public function contactExists($phone_number)
    {
        $_phone_number = Contact::where('phone_number',$phone_number)->get()->first();
        return ($_phone_number != null);
    }
}
