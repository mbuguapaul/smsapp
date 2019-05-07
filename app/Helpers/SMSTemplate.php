<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17/10/16
 * Time: 18:54
 */

namespace App\Helpers;

use App\Models\Contact;
class SMSTemplate
{
    public static function parse($contact,$message)
    {
        $person = Contact::find($contact);
        if(str_contains($message,"{name}"))
            $message = str_replace("{name}",$person->full_name,$message);
        if(str_contains($message,"{community}"))
            $message = str_replace("{community}",$person->community->name,$message);
        return $message;
    }

}