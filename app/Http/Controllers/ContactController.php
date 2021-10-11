<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact;
use App\Mail\ContacMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return "mensaje enviado amigo :)";
    }

    public function store(Contact $request)
    {
        $email = new ContacMailable($request->all());

        Mail::to($request['correo'])->send($email);

        return 'Mensaje enviado';
    }
}
