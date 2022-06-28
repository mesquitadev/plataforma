<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
        $page_title = 'Gerenciar Assinantes';
        $empty_message = 'Sem dados encontrados.';
        $subscribers = Subscriber::latest()->paginate(getPaginate());
        return view('admin.subscriber.index', compact('page_title', 'empty_message', 'subscribers'));
    }

    public function sendEmailForm()
    {
        $page_title = 'Enviar Email para Assinantes';
        return view('admin.subscriber.send_email', compact('page_title'));
    }

    public function remove(Request $request)
    {
        $request->validate(['subscriber' => 'required|integer']);
        $subscriber = Subscriber::findOrFail($request->subscriber);
        $subscriber->delete();

        $notify[] = ['success', 'Assinante removido'];
        return back()->withNotify($notify);
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'body' => 'required',
        ]);
        if (!Subscriber::first()) return back()->withErrors(['No subscribers to send email.']);
        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber) {
            $receiver_name = explode('@', $subscriber->email)[0];
            sendGeneralEmail($subscriber->email, $request->subject, $request->body, $receiver_name);
        }
        $notify[] = ['success', 'O e-mail será enviado a todos os assinantes.'];
        return back()->withNotify($notify);
    }
}
