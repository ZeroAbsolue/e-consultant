<?php

namespace App\Http\Controllers;

use App\Mail\Contact\AccuseReception;
use App\Notifications\IncomingMessage;
use App\Notifications\MailNotSend;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            "name"=>"required",
            "email"=>"required|email",
            "subject"=>"required|string|min:5",
            "message"=>"required|string|min:5",
        ]);

        $users = User::find(1);

        $sender = $request->get('name');
        $email = $request->get('email');
        $subject = $request->get('subject');
        $message = $request->get('message');

        $accuse = new AccuseReception($sender,$subject,$message);
        try{
            Mail::to($email)->send($accuse);
            Notification::send($users, new IncomingMessage($sender,$email,$subject,$message));
            $request->session()->flash('succes-message','Mail envoyé avec succès');
        }catch (\Swift_TransportException $exception){
            if($exception->getCode() == 0 ){
                Notification::send($users, new MailNotSend($email,$message,$subject,[],"Accusé de reception du message","Vous n'êtes pas connecté à internet"));
                $request->session()->flash('error-message','Message non envoyé : Vérifier votre connexion internet');
            }
            else{
                Notification::send($users, new MailNotSend($email,$message,$subject,[],"Accusé de reception du message",$exception->getMessage()));
                $request->session()->flash('error-message','Message non envoyé : Erreur côté serveur');

            }
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
