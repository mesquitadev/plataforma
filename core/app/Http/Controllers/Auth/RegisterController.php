<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\Frontend;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\UserExtra;
use App\Models\UserLogin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('regStatus')->except('registrationNotAllowed');

        $this->activeTemplate = activeTemplate();
    }



    public function showRegistrationForm(Request $request)
    {
        $content = Frontend::where('data_keys', 'sign_up.content')->first();
        $info = json_decode(json_encode(getIpInfo()), true);
        $country_code = @implode(',', $info['code']);

        if ($request->ref && $request->position) {
            $ref_user = User::where('username', $request->ref)->first();
            if ($ref_user == null) {
                $notify[] = ['error', 'Link de indicação inválido'];
                return redirect()->route('home')->withNotify($notify);
            }

            $join_under = User::find($ref_user->id);


            $joining = "<span class='help-block2'><strong class='custom-green' >Your are joining under $join_under->username  </strong></span>";

            $page_title = "Criar Conta";
            return view($this->activeTemplate . 'user.auth.register', compact('page_title', 'ref_user', 'joining', 'content', 'country_code'));

        }

        $ref_user = null;
        $page_title = "Criar Conta";
        return view($this->activeTemplate . 'user.auth.register', compact('page_title', 'ref_user', 'content', 'country_code'));

    }



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        $validate = Validator::make($data, [
            'referral'      => 'required|string|max:160',
            'firstname'     => 'sometimes|required|string|max:60',
            'lastname'      => 'sometimes|required|string|max:60',
            'email'         => 'required|string|email|max:160|unique:users',
            'mobile'        => 'required|string|max:30|unique:users',
            'password'      => 'required|string|min:6|confirmed',
            'username'      => 'required|alpha_num|unique:users|min:6',
            'captcha'       => 'sometimes|required',
            'country_code'  => 'required'
        ]);

        return $validate;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $general = GeneralSetting::first();

        if ($general->secure_password) {
            $notify = $this->strongPassCheck($request->password);
            if ($notify) {
                return back()->withNotify($notify)->withInput($request->all());
            }
        }

        $exist = User::where('mobile',$request->country_code.$request->mobile)->first();
        if ($exist) {
            $notify[] = ['error', 'Telefone já cadastrado'];
            return back()->withNotify($notify)->withInput();
        }

        $userCheck = User::where('username', $request->referral)->first();

        if (!$userCheck)
        {
            $notify[] = ['error', 'Patrocinador não encontrado.'];
            return back()->withNotify($notify);
        }

        if (isset($request->captcha)) {
            if (!captchaVerify($request->captcha, $request->captcha_secret)) {
                $notify[] = ['error', "Captcha inválido."];
                return back()->withNotify($notify)->withInput();
            }
        }

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User|\App\User
     */
    protected function create(array $data)
    {

        $gnl = GeneralSetting::first();

        $userCheck = User::where('username', $data['referral'])->first();


        //User Create
        $user = new User();
        $user->ref_id       = $userCheck->id;
        $user->firstname    = isset($data['firstname']) ? $data['firstname'] : null;
        $user->lastname     = isset($data['lastname']) ? $data['lastname'] : null;
        $user->email        = strtolower(trim($data['email']));
        $user->password     = Hash::make($data['password']);
        $user->username     = trim($data['username']);
        $user->ref_id       = $userCheck->id;
        $user->mobile       = $data['country_code'].$data['mobile'];
        $user->address      = [
            'address' => '',
            'state' => '',
            'zip' => '',
            'country' => isset($data['country']) ? $data['country'] : null,
            'city' => ''
        ];
        $user->status = 1;
        $user->ev = $gnl->ev ? 0 : 1;
        $user->sv = $gnl->sv ? 0 : 1;
        $user->ts = 0;
        $user->tv = 1;
        $user->save();


        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'Novo usuário cadastrado';
        $adminNotification->click_url = route('admin.users.detail',$user->id);
        $adminNotification->save();


        //Login Log Create
        $ip = $_SERVER["REMOTE_ADDR"];
        $exist = UserLogin::where('user_ip',$ip)->first();
        $userLogin = new UserLogin();

        //Check exist or not
        if ($exist) {
            $userLogin->longitude =  $exist->longitude;
            $userLogin->latitude =  $exist->latitude;
            $userLogin->location =  $exist->location;
            $userLogin->country_code = $exist->country_code;
            $userLogin->country =  $exist->country;
        }else{
            $info = json_decode(json_encode(getIpInfo()), true);
            $userLogin->longitude =  @implode(',',$info['long']);
            $userLogin->latitude =  @implode(',',$info['lat']);
            $userLogin->location =  @implode(',',$info['city']) . (" - ". @implode(',',$info['area']) ."- ") . @implode(',',$info['country']) . (" - ". @implode(',',$info['code']) . " ");
            $userLogin->country_code = @implode(',',$info['code']);
            $userLogin->country =  @implode(',', $info['country']);
        }

        $userAgent = osBrowser();
        $userLogin->user_id = $user->id;
        $userLogin->user_ip =  $ip;

        $userLogin->browser = @$userAgent['browser'];
        $userLogin->os = @$userAgent['os_platform'];
        $userLogin->save();


        return $user;
    }

    protected function strongPassCheck($password){
        $capital = '/[ABCDEFGHIJKLMNOPQRSTUVWXYZ]/';
        $capital = preg_match($capital,$password);
        $notify = null;
        if (!$capital) {
            $notify[] = ['error','Minimo uma letra maiúscula.'];
        }
        $number = '/[123456790]/';
        $number = preg_match($number,$password);
        if (!$number) {
            $notify[] = ['error','Minimo de um numero'];
        }
        $special = '/[`!@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?~\']/';
        $special = preg_match($special,$password);
        if (!$special) {
            $notify[] = ['error','Minimo de um caractere especial.'];
        }
        return $notify;
    }

    public function registered(Request $request, $user)
    {
        $user_extras = new UserExtra();
        $user_extras->user_id = $user->id;
        $user_extras->save();
        return redirect()->route('user.home');
    }

}
