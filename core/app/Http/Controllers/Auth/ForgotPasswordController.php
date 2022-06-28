<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Frontend;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showLinkRequestForm()
    {
        $page_title = "Esqueci a Senha";
        $content    = Frontend::where('data_keys', 'sign_in.content')->first();
        return view(activeTemplate() . 'user.auth.passwords.email', compact('page_title', 'content'));
    }

    public function sendResetLinkEmail(Request $request)
    {
        if ($request->type == 'email') {
            $validationRule = [
                'value'=>'required|email'
            ];
            $validationMessage = [
                'value.required'=>'Email field is required',
                'value.email'=>'Email must be an valide email'
            ];
        }elseif($request->type == 'username'){
            $validationRule = [
                'value'=>'required'
            ];
            $validationMessage = ['value.required'=>'Username é obrigatório'];
        }else{
            $notify[] = ['error','Seleção inválida'];
            return back()->withNotify($notify);
        }

        $request->validate($validationRule,$validationMessage);

        $user = User::where($request->type, $request->value)->first();

        if (!$user) {
            $notify[] = ['error', 'Usuário não encontrado.'];
            return back()->withNotify($notify);
        }

        PasswordReset::where('email', $user->email)->delete();
        $code = verificationCode(6);
        $password = new PasswordReset();
        $password->email = $user->email;
        $password->token = $code;
        $password->created_at = \Carbon\Carbon::now();
        $password->save();

        $userIpInfo = getIpInfo();
        $userBrowserInfo = osBrowser();
        sendEmail($user, 'PASS_RESET_CODE', [
            'code' => $code,
            'operating_system' => @$userBrowserInfo['os_platform'],
            'browser' => @$userBrowserInfo['browser'],
            'ip' => @$userIpInfo['ip'],
            'time' => @$userIpInfo['time']
        ]);

        $page_title = 'Recuperar Conta';
        $email = $user->email;
        session()->put('pass_res_mail',$email);
        $notify[] = ['success', 'Email de redefinição de senha enviado com sucesso'];
        return redirect()->route('user.password.code_verify')->withNotify($notify);
    }

    public function codeVerify(){
        $page_title = 'Recuperar Conta';
        $email = session()->get('pass_res_mail');
        if (!$email) {
            $notify[] = ['error','Opps! sessão expirada.'];
            return redirect()->route('user.password.request')->withNotify($notify);
        }

        $content    = Frontend::where('data_keys', 'sign_in.content')->first();
        return view(activeTemplate().'user.auth.passwords.code_verify',compact('page_title','email', 'content'));
    }

    public function verifyCode(Request $request)
    {
        $request->validate(['code.*' => 'required', 'email' => 'required']);
        $code =  str_replace(',','',implode(',',$request->code));

        if (PasswordReset::where('token', $code)->where('email', $request->email)->count() != 1) {
            $notify[] = ['error', 'Token inválido.'];
            return redirect()->route('user.password.request')->withNotify($notify);
        }
        $notify[] = ['success', 'Você pode alterar sua senha.'];
        session()->flash('fpass_email', $request->email);
        return redirect()->route('user.password.reset', $code)->withNotify($notify);
    }

}
