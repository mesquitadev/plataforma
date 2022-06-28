<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BvLog;
use App\Models\Transaction;
use App\Models\UserLogin;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function bvLog(Request $request)
    {

        if ($request->type) {
            if ($request->type == 'leftBV') {
                $data['page_title'] = "Left BV";
                $data['logs'] = BvLog::where('position', 1)->where('trx_type', '+')->orderBy('id', 'desc')->with('user')->paginate(config('constants.table.default'));
            } elseif ($request->type == 'rightBV') {
                $data['page_title'] = "Right BV";
                $data['logs'] = BvLog::where('position', 2)->where('trx_type', '+')->orderBy('id', 'desc')->with('user')->paginate(config('constants.table.default'));
            }elseif ($request->type == 'cutBV') {
                $data['page_title'] = "Cut BV";
                $data['logs'] = BvLog::where('trx_type', '-')->orderBy('id', 'desc')->with('user')->paginate(config('constants.table.default'));
            } else {
                $data['page_title'] = "All Paid BV";
                $data['logs'] = BvLog::where('trx_type', '+')->orderBy('id', 'desc')->with('user')->paginate(config('constants.table.default'));
            }
        }else{
            $data['page_title'] = "BV LOG";
            $data['logs'] = BvLog::orderBy('id', 'desc')->paginate(config('constants.table.default'));
        }

        $data['empty_message'] = 'No data found';
        return view('admin.reports.bvLog', $data);
    }

    public function singleBvLog(Request $request, $id)
    {

        $user = User::findOrFail($id);
        if ($request->type) {
            if ($request->type == 'leftBV') {
                $data['page_title'] = $user->username . " - Left BV";
                $data['logs'] = BvLog::where('user_id', $user->id)->where('position', 1)->where('trx_type', '+')->orderBy('id', 'desc')->with('user')->paginate(config('constants.table.default'));
            } elseif ($request->type == 'rightBV') {
                $data['page_title'] = $user->username . " - Right BV";
                $data['logs'] = BvLog::where('user_id', $user->id)->where('position', 2)->where('trx_type', '+')->orderBy('id', 'desc')->with('user')->paginate(config('constants.table.default'));
            } elseif ($request->type == 'cutBV') {
                $data['page_title'] = $user->username . " - All Cut BV";
                $data['logs'] = BvLog::where('user_id', $user->id)->where('trx_type', '-')->orderBy('id', 'desc')->with('user')->paginate(config('constants.table.default'));
            } else {
                $data['page_title'] = $user->username . " - All Paid BV";
                $data['logs'] = BvLog::where('user_id', $user->id)->where('trx_type', '+')->orderBy('id', 'desc')->with('user')->paginate(config('constants.table.default'));
            }
        }else{
            $data['page_title'] = $user->username . " - All  BV";
            $data['logs'] = BvLog::where('user_id', $user->id)->orderBy('id', 'desc')->with('user')->paginate(config('constants.table.default'));

        }

        $data['empty_message'] = 'No data found';
        return view('admin.reports.bvLog', $data);
    }



    public function refCom(Request $request)
    {
        if ($request->userID)
        {
            $user = User::findOrFail($request->userID);
            $page_title = $user->username . ' - Comissão por Indicação';
            $transactions = Transaction::where('user_id', $user->id)->where('remark', 'referral_commission')->with('user')->latest()->paginate(getPaginate());
        }else {
            $page_title = 'Logs de Comissão por Indicação';
            $transactions = Transaction::where('remark', 'referral_commission')->with('user')->latest()->paginate(getPaginate());
        }

        $empty_message = 'Sem dados encontrados.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }

    public function binary(Request $request)
    {
        if ($request->userID)
        {
            $user = User::findOrFail($request->userID);
            $page_title = $user->username . ' - Logs de Comissão Binária';
            $transactions = Transaction::where('user_id', $user->id)->where('remark', 'binary_commission')->with('user')->latest()->paginate(getPaginate());
        }else {
            $page_title = 'Logs de Comissão por Indicação';
            $transactions = Transaction::where('remark', 'binary_commission')->with('user')->latest()->paginate(getPaginate());
        }

        $empty_message = 'Sem dados encontrados.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }
    public function invest(Request $request)
    {
        if ($request->userID)
        {
            $user = User::findOrFail($request->userID);
            $page_title = $user->username . ' - Logs de Investimento';
            $transactions = Transaction::where('user_id', $user->id)->where('remark', 'purchased_plan')->with('user')->latest()->paginate(getPaginate());
        }else {
            $page_title = 'Log de Investimento';
            $transactions = Transaction::where('remark', 'purchased_plan')->with('user')->latest()->paginate(getPaginate());
        }

        $empty_message = 'Sem dados encontrados.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }
    public function transaction()
    {
        $page_title = 'Logs de Transação';
        $transactions = Transaction::with('user')->orderBy('id','desc')->paginate(getPaginate());
        $empty_message = 'Sem dados encontrados.';
        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }

    public function transactionSearch(Request $request)
    {
        $request->validate(['search' => 'required']);
        $search = $request->search;
        $page_title = 'Buscar Transações - ' . $search;
        $empty_message = 'Sem dados encontrados.';

        $transactions = Transaction::with('user')->whereHas('user', function ($user) use ($search) {
            $user->where('username', 'like',"%$search%");
        })->orWhere('trx', $search)->orderBy('id','desc')->paginate(getPaginate());

        return view('admin.reports.transactions', compact('page_title', 'transactions', 'empty_message'));
    }

    public function loginHistory(Request $request)
    {
        if ($request->search) {
            $search = $request->search;
            $page_title = 'Busca de Histórico de Login - ' . $search;
            $empty_message = 'Sem dados encontrados.';
            $login_logs = UserLogin::whereHas('user', function ($query) use ($search) {
                $query->where('username', $search);
            })->orderBy('id','desc')->paginate(getPaginate());
            return view('admin.reports.logins', compact('page_title', 'empty_message', 'search', 'login_logs'));
        }
        $page_title = 'Histórico de Login do Usuário';
        $empty_message = 'Sem dados encontrados.';
        $login_logs = UserLogin::orderBy('id','desc')->paginate(getPaginate());
        return view('admin.reports.logins', compact('page_title', 'empty_message', 'login_logs'));
    }

    public function loginIpHistory($ip)
    {
        $page_title = 'Login Por - ' . $ip;
        $login_logs = UserLogin::where('user_ip',$ip)->orderBy('id','desc')->paginate(getPaginate());
        $empty_message = 'Sem dados encontrados.';
        return view('admin.reports.logins', compact('page_title', 'empty_message', 'login_logs'));

    }


}
