<?php

namespace App\Http\Controllers;

use App\Models\BvLog;
use App\Models\GeneralSetting;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserExtra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{

    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    function planIndex()
    {
        $data['page_title'] = "Planos";
        $data['plans'] = Plan::whereStatus(1)->get();
        return view($this->activeTemplate . '.user.plan', $data);

    }

    function planStore(Request $request)
    {

        $this->validate($request, ['plan_id' => 'required|integer']);
        $plan = Plan::where('id', $request->plan_id)->where('status', 1)->firstOrFail();
        $gnl = GeneralSetting::first();

        $user = User::find(Auth::id());

        if ($user->balance < $plan->price) {
            $notify[] = ['error', 'Saldo insuficiente'];
            return back()->withNotify($notify);
        }

        $oldPlan = $user->plan_id;
        $user->plan_id = $plan->id;
        $user->balance -= $plan->price;
        $user->total_invest += $plan->price;
        $user->save();

        $trx = $user->transactions()->create([
            'amount' => $plan->price,
            'trx_type' => '-',
            'details' => 'Purchased ' . $plan->name,
            'remark' => 'purchased_plan',
            'trx' => getTrx(),
            'post_balance' => getAmount($user->balance),
        ]);

        notify($user, 'plan_purchased', [
            'plan' => $plan->name,
            'amount' => getAmount($plan->price),
            'currency' => $gnl->cur_text,
            'trx' => $trx->trx,
            'post_balance' => getAmount($user->balance) . ' ' . $gnl->cur_text,
        ]);
        if ($oldPlan == 0) {
            updatePaidCount($user->id);
        }
        $details = Auth::user()->username . ' Subscribed to ' . $plan->name . ' plan.';


        if ($plan->tree_com > 0) {
            treeComission($user->id, $plan->tree_com, $details);
        }

        referralComission($user->id, $details);

        $notify[] = ['success', 'Comprado ' . $plan->name . ' com sucesso'];
        return redirect()->route('user.home')->withNotify($notify);

    }

    public function bvlog(Request $request)
    {

        $data['page_title'] = "Meu Volume";
        $data['logs'] = BvLog::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(config('constants.table.default'));
        $data['empty_message'] = 'Sem dados encontrados.';
        return view($this->activeTemplate . '.user.bvLog', $data);
    }

    public function myRefLog()
    {
        $data['page_title'] = "Meus Indicados";
        $data['empty_message'] = 'Sem dados encontrados.';
        $data['logs'] = User::where('ref_id', auth()->id())->latest()->paginate(config('constants.table.default'));
        return view($this->activeTemplate . '.user.myRef', $data);
    }

    public function myTree()
    {
        $data['tree'] = showTreePage(Auth::id());
        $data['page_title'] = "Minha Rede";
        return view($this->activeTemplate . 'user.myTree', $data);
    }


    public function otherTree(Request $request, $username = null)
    {
        if ($request->username) {
            $user = User::where('username', $request->username)->first();
        } else {
            $user = User::where('username', $username)->first();
        }
        if ($user && treeAuth($user->id, auth()->id())) {
            $data['tree'] = showTreePage($user->id);
            $data['page_title'] = "Rede do " . $user->fullname;
            return view($this->activeTemplate . 'user.myTree', $data);
        }

        $notify[] = ['error', 'Árvore não encontrada ou você não tem permissão para ver isso!!'];
        return redirect()->route('user.my.tree')->withNotify($notify);

    }

}
