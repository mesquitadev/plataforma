<?php

namespace App\Http\Controllers;

use App\Models\BvLog;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserReportController extends Controller
{

    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function bvBonusLog(Request $request)
    {

        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Busca dos Pontos : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'matching_bonus')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Bonus de Correspondência';
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'matching_bonus')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;

        $data['empty_message'] = 'No data found.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function investLog(Request $request)
    {

        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Buscar Investimentos : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'purchased_plan')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Meus Investimentos';
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'purchased_plan')->latest()->paginate(getPaginate());
            $data['amount_invest'] = Transaction::where('remark', 'purchased_plan')->with('user')->sum('amount');

            $data['totalDeposit']       = Deposit::where('user_id', auth()->id())->where('status', 1)->sum('amount');
            $data['totalWithdraw']      = Withdrawal::where('user_id', auth()->id())->where('status', 1)->sum('amount');
            $data['completeWithdraw']   = Withdrawal::where('user_id', auth()->id())->where('status', 1)->count();
            $data['pendingWithdraw']    = Withdrawal::where('user_id', auth()->id())->where('status', 2)->count();
            $data['rejectWithdraw']     = Withdrawal::where('user_id', auth()->id())->where('status', 3)->count();
            $data['total_ref']          = User::where('ref_id', auth()->id())->count();
            $data['totalBvCut']         = BvLog::where('user_id', auth()->id())->where('trx_type', '-')->sum('amount');
        }
        $data['search'] = $search;

        $data['empty_message'] = 'No data found.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function binaryCom(Request $request)
    {

        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Binary Commissions search : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'binary_commission')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Binary Commissions';
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'binary_commission')->latest()->paginate(getPaginate());

        }
        $data['search'] = $search;

        $data['empty_message'] = 'No data found.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function refCom(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Busca de Comissão por Indicação : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'referral_commission')->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Comissões de Indicação';
            $data['transactions'] = auth()->user()->transactions()->where('remark', 'referral_commission')->latest()->paginate(getPaginate());

            $data['totalDeposit']       = Deposit::where('user_id', auth()->id())->where('status', 1)->sum('amount');
            $data['totalWithdraw']      = Withdrawal::where('user_id', auth()->id())->where('status', 1)->sum('amount');
            $data['completeWithdraw']   = Withdrawal::where('user_id', auth()->id())->where('status', 1)->count();
            $data['pendingWithdraw']    = Withdrawal::where('user_id', auth()->id())->where('status', 2)->count();
            $data['rejectWithdraw']     = Withdrawal::where('user_id', auth()->id())->where('status', 3)->count();
            $data['total_ref']          = User::where('ref_id', auth()->id())->count();
            $data['totalBvCut']         = BvLog::where('user_id', auth()->id())->where('trx_type', '-')->sum('amount');
        }
        $data['search'] = $search;
        $data['empty_message'] = 'Sem dados Encontrados.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function transactions(Request $request)
    {

        $search = $request->search;
        if ($search) {
            $data['page_title'] = "Buscar Transações : " . $search;
            $data['transactions'] = auth()->user()->transactions()->where('trx', 'like', "%$search%")->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Log de Transação';
            $data['transactions'] = auth()->user()->transactions()->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = 'Sem dados encontrados.';
        return view($this->activeTemplate . 'user.transactions', $data);

    }

    public function depositHistory(Request $request)
    {

        $search = $request->search;

        if ($search) {
            $data['page_title'] = "Buscar Depósito : " . $search;
            $data['logs'] = auth()->user()->deposits()->where('trx', 'like', "%$search%")->with(['gateway'])->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = 'Log de Depósitos';
            $data['logs'] = auth()->user()->deposits()->with(['gateway'])->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = 'No history found.';


        return view($this->activeTemplate . 'user.deposit_history', $data);
    }


    public function withdrawLog(Request $request)
    {
        $search = $request->search;

        if ($search) {
            $data['page_title'] = "Buscar Saques : " . $search;
            $data['withdraws'] = auth()->user()->withdrawals()->where('trx', 'like', "%$search%")->with('method')->latest()->paginate(getPaginate());
        } else {
            $data['page_title'] = "Log de Saques";
            $data['withdraws'] = auth()->user()->withdrawals()->with('method')->latest()->paginate(getPaginate());
        }
        $data['search'] = $search;
        $data['empty_message'] = "No Data Found!";
        return view($this->activeTemplate . 'user.withdraw.log', $data);
    }


}
