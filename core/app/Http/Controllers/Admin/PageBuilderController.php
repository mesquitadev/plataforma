<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageBuilderController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function managePages()
    {
        //// HOME PAGE
        $count = Page::where('tempname',$this->activeTemplate)->where('slug','home')->count();
        if($count == 0){
            $page = new Page();
            $page->tempname = $this->activeTemplate;
            $page->name = 'HOME';
            $page->slug = 'home';
            $page->save();
        }

        $pdata = Page::where('tempname',$this->activeTemplate)->get();
        $page_title = 'Gerenciar Seção';
        $empty_message = 'Sem dados encontrados.';

        return view('admin.frontend.builder.pages', compact('page_title','pdata','empty_message'));
    }

    public function managePagesSave(Request $request){

        $request->validate([
            'name' => 'required|min:3',
            'slug' => 'required|min:3',
        ]);

        $exist = Page::where('tempname', $this->activeTemplate)->where('slug', str_slug($request->slug))->count();
        if($exist != 0){
            $notify[] = ['error', 'Esta página já existe em seu modelo atual. Por favor, mude o Slug.'];
            return back()->withNotify($notify);
        }
        $page = new Page();
        $page->tempname = $this->activeTemplate;
        $page->name = $request->name;
        $page->slug = str_slug($request->slug);
        $page->save();
        $notify[] = ['success', 'Salvo com sucesso.'];
        return back()->withNotify($notify);

    }

    public function managePagesUpdate(Request $request){

        $page = Page::where('id',$request->id)->first();
        $request->validate([
            'name' => 'required|min:3',
            'slug' => 'required|min:3'
        ]);

        $slug = str_slug($request->slug);

        $exist = Page::where('tempname', $this->activeTemplate)->where('slug',$slug)->first();
        if(($exist) && $exist->slug != $page->slug){
            $notify[] = ['error', 'Esta página já existe em seu modelo atual. Por favor, mude o Slug.'];
            return back()->withNotify($notify);
        }

        $page->name = $request->name;
        $page->slug = str_slug($request->slug);
        $page->save();


        $notify[] = ['success', 'Atualizado com sucesso.'];
        return back()->withNotify($notify);

    }

    public function managePagesDelete(Request $request){
        $page = Page::where('id',$request->id)->first();
        $page->delete();
        $notify[] = ['success', 'Deletado com sucesso.'];
        return back()->withNotify($notify);
    }



    public function manageSection($id)
    {
        $pdata = Page::findOrFail($id);
        $page_title = 'Gerenciar Seção de '.$pdata->name;
        $sections =  getPageSections(true);
        ksort($sections);
        return view('admin.frontend.builder.index', compact('page_title','pdata','sections'));
    }



    public function manageSectionUpdate($id, Request $request)
    {
        $request->validate([
            'secs' => 'nullable|array',
        ]);

        $page = Page::findOrFail($id);
        if (!$request->secs) {
            $page->secs = null;
        }else{
            $page->secs = json_encode($request->secs);
        }
        $page->save();
        $notify[] = ['success', 'Atualizado com sucesso.'];
        return back()->withNotify($notify);
    }
}
