<?php

namespace App\Http\Controllers\Admin;

use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Models\SmsTemplate;
use Illuminate\Http\Request;

class SmsTemplateController extends Controller
{
    public function index()
    {
        $page_title = 'Templates de SMS';
        $empty_message = 'Sem dados encontrados.';
        $sms_templates = SmsTemplate::get();
        return view('admin.sms_template.index', compact('page_title', 'empty_message', 'sms_templates'));
    }

    public function edit($id)
    {
        $sms_template = SmsTemplate::findOrFail($id);
        $page_title = $sms_template->name;
        $empty_message = 'Sem dados encontrados.';
        return view('admin.sms_template.edit', compact('page_title', 'sms_template','empty_message'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sms_body' => 'required',
        ]);

        $sms_template = SmsTemplate::findOrFail($id);

        $sms_template->sms_body = $request->sms_body;
        $sms_template->sms_status = $request->sms_status ? 1 : 0;
        $sms_template->save();

        $notify[] = ['success', $sms_template->name . ' template atualizado.'];
        return back()->withNotify($notify);
    }


    public function smsSetting()
    {
        $page_title = 'SMS API';

        $general_setting = GeneralSetting::first('sms_api');

        return view('admin.sms_template.sms_setting', compact('page_title', 'general_setting'));
    }

    public function smsSettingUpdate(Request $request)
    {
        $request->validate([
            'sms_api' => 'required',
        ]);
        $general_setting = GeneralSetting::first();
        $general_setting->sms_api = $request->sms_api;
        $general_setting->save();

        $notify[] = ['success', 'SMS Template atualizado.'];
        return back()->withNotify($notify);
    }

    public function sendTestSMS(Request $request)
    {
        $request->validate(['mobile' => 'required']);
        $general = GeneralSetting::first(['sn', 'sms_api']);
        if ($general->sn == 1) {
            $message = shortCodeReplacer("{{number}}", $request->mobile, $general->sms_api);
            $message = shortCodeReplacer("{{message}}", 'This is a test sms', $message);
            $result = @file_get_contents($message);
        }

        $notify[] = ['success', 'Você deve receber um sms de teste em ' . $request->mobile . ' em breve.'];
        return back()->withNotify($notify);
    }
}
