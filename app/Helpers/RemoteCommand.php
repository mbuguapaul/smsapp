<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17/10/16
 * Time: 15:07
 */

namespace App\Helpers;


use App\Models\Contact;
use App\Models\Sms;

class RemoteCommand
{
    private $COUNTRY_CODE = "+254";
    public static function process(
        $command,
        Array $data
    )
    {
        $runner = new RemoteCommand();
        switch(strtoupper($command))
        {
            case Command::SETNAME:
                $contact = Contact::where('phone_number', 'like','%'.$data["phone_number"])->get()->first();
                if($contact == null && $runner->isINTLformat($data["phone_number"]))
                    $contact = Contact::where('phone_number','like','%'.$runner->getINTLformat($data["phone_number"]))->get()->first();
                if($contact != null)
                {
                    $_contact = Contact::find($contact->id);
                    $_contact->full_name = $data["value"];
                    $_contact->save();
                    Sms::create(
                        [
                            'contact_id'=>$contact->id,
                            'status' => 0,
                            'sms_body'=>$runner->getNameUpdateText($_contact->id)
                        ]
                    );
                }
                else
                {
                    echo "not_found";
                }
                break;
        }
    }

    public function getNameUpdateText($contact)
    {
        $msg = "Hi {name}, Your name has been successfully updated to {name}";
        return SMSTemplate::parse($contact,$msg);
    }
    public function getINTLformat($number)
    {
       return str_replace_first("0",$this->COUNTRY_CODE,$number);
    }

    public function isINTLformat($number)
    {
        return (substr($number,0,3) != $this->COUNTRY_CODE || str_contains($number,$this->COUNTRY_CODE));
    }
}