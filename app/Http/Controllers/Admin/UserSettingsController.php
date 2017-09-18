<?php

namespace Cookie\Http\Controllers\Admin;

use Cookie\Forms\UserSettingsForm;
use Cookie\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{

    public function edit(){
        $form = \FormBuilder::create(UserSettingsForm::class,[
           'url' => route('admin.users.settings.update'),
            'method' => 'PUT'
        ]);

        return view('admin.users.settings',compact('form'));
    }

    public function update(Request $request){

        $form = \FormBuilder::create(UserSettingsForm::class);

        if(!$form->isValid()){
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $data = $form->getFieldValues();
        $data['password'] = bcrypt($data['password']);
        \Auth::user()->update($data);
        $request->session()->flash('message','Senha alterada com sucesso');
        return redirect()->route('admin.users.settings.edit');
    }
}
