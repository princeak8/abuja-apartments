<?php

namespace App\Http\Controllers\Realtor;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MyFunction;

use Illuminate\Http\Request;
use App\Http\Requests\TicketRequest;
use Storage;
use File;
use Intervention\Image\ImageManager;

use App\Ticket;
use App\Realtor;

class TicketController extends Controller
{
	public function __construct()
	{
		$this->middleware('realtorAuth');
		$this->myFunction = new MyFunction;
    }
    
    public function index()
    {
        $tickets = Ticket::all();
        return view('realtor/tickets', compact('tickets'));
    }

    public function create_ticket()
    {
        return view('realtor/create_ticket');
    }

    
	public function save(TicketRequest $request)
	{
		$ticketObj = new Ticket;
        $post = $request->all();
        
		$ticketObj->title = $post['title'];
        $ticketObj->description = $post['description'];
        $ticketObj->realtor_id = Auth::user()->id;

        $filePath = storage_path('images/tickets/'); //Set the path to the full images

		if(!is_dir($filePath)) { //if the full images file does not exist
			File::makeDirectory($filePath, 0777); // create full images file with the required permission
        }
        
        if(!empty($request->file('image'))) {
			$Intervention_img = new ImageManager(); //make an instance of the Image manager Class
			$original_name = $request->file('image')->getClientOriginalName(); //get the name of the photo
			$filename = time() . '-'.$original_name; //create a unique name for the photo
			$img = $Intervention_img->make($request->file('image')->getRealPath());//re-create the image using the Image manager object
					
			if($img->save($filePath.$filename, 80)) { //Save the full image 
				$ticketObj->image = $filename;
			}
		}
        
		if($ticketObj->save()) {
            $msg = '<b>Ticket Successfully Sent</b>';
            request()->session()->flash('msg', $msg);
            return redirect('realtor/tickets');
		}else{
            $msg = '<b>Sorry, Ticket Could not be created...  Please try again later or contact the administrator</b>';
			return back();
		}
	}

	public function messages()
	{
		$messages = Message::orderBy('created_at', 'DESC')->get();
		$unread_messages = Message::Unread()->get();
		return view('realtor/messages', compact('messages', 'unread_messages'));
	}

	public function message($id)
	{
		$message = Message::find($id);
		if(!empty($message)) {
			$message->unread = 0;
			$message->save();
			return view('admin/message', compact('message'));
		}else{
			return redirect('realtor/messages');
		}
		
	}

	public function mark_read(Request $request)
	{
        $data = Input::all();

        if(isset($data['id'])) {
			$message_id = $data['id'];
			$messageObj = Message::find($message_id);
			if(!empty($messageObj)) {
				$messageObj->unread = 0;
			
				if($messageObj->save()) {
					$data = array(
                    	"status" => "success",
                    	"code"   => 200,
               		 );
				}else{
					$data = array(
                    	"status" => "error",
                    	"code"   => 500,
                    	"message"=> "Could not be marked as read"
               		 );
				}
			}else{
				$data = array(
                    "status" => "success",
                   	"code"   => 404,
                   	"message"=> "Message not found"
           	    );
			}
		}else{
			$data = array(
                "status" => "success",
                "code"   => 404,
                "message"=> "id Was not found"
           	);
		}
	}

	public function delete($id)
	{
		//Check if its an admin and its logged in

		$messageObj = Message::find($id);
		if(!empty($messageObj)) {
			DB::beginTransaction();
			try{
				$deleted = $messageObj->delete();
	            DB::commit();
	        } catch (\Exception $e) {
    			DB::rollback();
	        }
		}

		return back();
	}

}
