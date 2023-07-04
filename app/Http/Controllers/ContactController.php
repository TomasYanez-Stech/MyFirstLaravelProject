<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function __construct() {
        $this->middleware("auth");
    }
    
    public function store(Request $request) {
        /* // return [
        //     "status" => 200,
        //     "message" => $request
        // ];
        return [
            "status" => 200,
            "_token" => request("_token"),
            "email" => $request->get("email"),
        ];
        // return $request; */

        $msg = $request->validate([
            "name" => ["required"],
            "email" => ["required", "email"],
            "subject" => ["required", "min:3"],
            "content" => ["required"]
        ],
        /* [
            "subject.min" => "El :Attribute debe contener al menos :min caracteres."
        ] */
        );

        // Mail::to("tomas@stech.guru")->send(new ContactMail($msg)); // Not the best practice
        Mail::to("tomas@stech.guru")->queue(new ContactMail($msg)); // Falta configurar.
        
        // return [
        //     "status" => 200,
        //     "message" => $request
        // ];

        return back()->with("status", __("We received your message and will get back to you within 48 hours."));
    }
}
