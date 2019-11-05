<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MyFunction;

use Illuminate\Http\Request;
use Storage;

use App\Page;
use App\Contact_message;
use App\Mail\ContactMsg;
use App\Mail\ContactMsgSender;

class PageController extends Controller
{
	public function __construct()
	{
		$this->myFunction = new MyFunction;
	}
    
	public function about()
	{
		$page = Page::where('name', 'about')->first();
		return view('about', compact('page'));
    }
    
    public function contact()
	{
		$page = Page::where('name', 'contact')->first();
		return view('contact', compact('page'));
    }
    
    public function send(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:2',
            'message' => 'required|string|min:5',
        ]);

        $post = $request->all();
        $msgObj = new Contact_message;

        $msgObj->name = $post['name'];
        $msgObj->email = $post['email'];
        $msgObj->message = $post['message'];

        if($msgObj->save()) {
            // Send Email to Admin
            Mail::to("akalodave@gmail.com")->send(new ContactMsg($msgObj));
            if(!empty($post['email'])) {
                // Send Email to Sender
                try{
                    Mail::to($post['email'])->send(new ContactMsgSender($msgObj->name));
                }catch(exception $e) {
                    //
                }
            }
        }
        request()->session()->flash('msg', 'Your Message has been sent successfully.. Thank You for contacting us');
        return back();
    }

}
