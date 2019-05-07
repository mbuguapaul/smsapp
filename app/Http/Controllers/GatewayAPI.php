<?php

namespace App\Http\Controllers;

use App\Helpers\Command;
use App\Helpers\RemoteCommand;
use App\Models\Sms;
use Storage;
use App\Gateway;

class GatewayAPI extends Controller
{	
	protected $incoming;
	protected $PASSWORD = 'bct';
	protected $OUTGOING_DIR_NAME='incoming/';
	protected $MPESA = 'mpesa/';
	protected $TRANS_ID = 0;
	protected $TRANS_DETAIL_ID = 0;

	public function __construct() {
		 $this->TRANS_ID = rand(1, 1000);
	    $this->TRANS_DETAIL_ID = rand(1, 1000);
	}

	public function index()
	{
		
	}
    public function store()
    {
    	$request = Gateway\EnvayaSMS::get_request();

		header("Content-Type: {$request->get_response_type()}");

		if (!$request->is_validated($this->PASSWORD))
		{
		    header("HTTP/1.1 403 Forbidden");
		    error_log("Invalid password");
		    echo $request->render_error_response("Invalid password");
		    return;
		}

		$action = $request->get_action();

		switch ($action->type)
		{
		    case Gateway\EnvayaSMS::ACTION_INCOMING:
//		        $type = strtoupper($action->message_type);
//
//		        error_log("Received $type from {$action->from}");
//		        error_log(" message: {$action->message}");
//		        //Initiate the outgoing message object.
//		        $message = new Gateway\EnvayaSMS_OutgoingMessage();
//		        $message->id = uniqid("");
//
//		    	$message->to = $action->from;
//		        $message->message = 'Received';
//		   		Storage::put($this->OUTGOING_DIR_NAME.$message->id.'.json', json_encode($message));
//
//		    	//Reply object for debugging purposes.
//		        $reply = new Gateway\EnvayaSMS_OutgoingMessage();
//		        $reply->message = "{$action->from}: {$action->message}";
//		        error_log("Sending reply: {$reply->message}");
//
//		        echo $request->render_response(array(
//					new Gateway\EnvayaSMS_Event_Send(array($reply))
//				));
				foreach(Command::$ALL as $COMMAND) {
					if (starts_with($action->message, $COMMAND) && str_contains($action->message,"#"))
					{
						$value = explode("#",$action->message);
						$data = [
							'phone_number'=>$action->from,
							'value' =>(last($value) != null && last($value) != $COMMAND) ? last($value) : "COULD_NOT_GET_NAME"
						];
						RemoteCommand::process($COMMAND, $data);
					}
				}
				return response()->json(array(
					"events"=>null
				));
		        
		    case Gateway\EnvayaSMS::ACTION_OUTGOING:
		        $messages = array();

//		        $dir = Storage::allFiles($this->OUTGOING_DIR_NAME);
//
//			   	for ($i=0; $i < count($dir) ; $i++) {
//			   		$file = Storage::get($dir[$i]);
//
//		                $data = json_decode(Storage::get($dir[$i]));
//		                if ($data)
//		                {
//		                    $sms = new EnvayaSMS_OutgoingMessage();
//		                    $sms->id = $data->id;
//		                    $sms->to = $data->to;
//		                    $sms->message = $data->message;
//		                    $messages[] = $sms;
//		                }
//			   	}
				$smses = Sms::where('status',0)->get();
		        foreach($smses as $_sms)
				{
					$sms = new Gateway\EnvayaSMS_OutgoingMessage();
					$sms->id = $_sms->id;
					$sms->to = $_sms->contact->phone_number;
					$sms->message = $_sms->sms_body;
					$sms->type = Gateway\EnvayaSMS::MESSAGE_TYPE_SMS;
					$sms->priority = 1;
					$messages[] = $sms;
				}
		        $events = array();
		        
		        if ($messages)
		        {
		            $events[] = new Gateway\EnvayaSMS_Event_Send($messages);
		        }
		        
		        echo $request->render_response($events);
		        return response()->json(array('events'=>$events));
		        
		    case Gateway\EnvayaSMS::ACTION_SEND_STATUS:
		    
		        $id = $action->id;
		       
		        error_log("message $id status: {$action->status}");
		
		        try {
		        	 // delete file with matching id    
//				       if (preg_match('#^\w+$#', $id))
//				       {
//			            Storage::delete($this->OUTGOING_DIR_NAME.$id.'.json');
//			           }
					if($sms = Sms::find($id))
					{
						$sms->status = 1;
						$sms->save();
					}
		        } catch (\Exception $e) {
		        	error_log("message not available for deletion".$e);
		        }
		        //echo $request->render_response();
		        return response()->json(array('events'=>null));
		    case Gateway\EnvayaSMS::ACTION_DEVICE_STATUS:
		        error_log("device_status = {$action->status}");
		        echo $request->render_response();
		        return response()->json(array('events'=>null));;
		    case Gateway\EnvayaSMS::ACTION_TEST:
		        //echo $request->render_response();
		        return response()->json(array('events'=>null));;
		    default:
		        header("HTTP/1.1 404 Not Found");
		        echo $request->render_error_response("The server does not support the requested action.");
		        return;
		}
    }
}
