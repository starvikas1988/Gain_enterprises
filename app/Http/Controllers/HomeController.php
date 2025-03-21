<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Mail\SentMail;
use File;
use Session;
use Exception;
use Auth;
use Mail;
use Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {		
        echo '<h4>Welcome to Gain Restaurant</h4>';
    }
    
    public function testMail()
    {
        $details = [
            'name' => 'John Doe',
            'reset_link' => url('/password/reset?token=some-random-token')
        ];

        // Send the email
        $resp = Mail::to('kishoremondal205@gmail.com')->send(new SentMail($details));
        dd($resp);

        return "Password reset email sent!";
    }
}
