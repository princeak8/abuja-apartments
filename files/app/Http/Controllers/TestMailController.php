<?php 

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class TestMailController extends Controller
{
    /**
     * Ship the given order.
     *
     * @param  Request  $request
     * @param  int  $orderId
     * @return Response
     */
    public function index()
    {
        $msg = "This is a test mail. Hope you like it";
        $mail = Mail::to("akalodave@gmail.com")->send(new TestMail($msg));
        dd($mail);
    }
}

?>