<?php

namespace App\Http\Controllers;

use App\Group;
use App\User_Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{

    public function create(Request $request){
        if ($request->isMethod('post')){

            $request->flashOnly('name');

            $validateRules = [
                'name' => 'required|min:2|max:128|unique:groups',
                'intro' => 'required|min:6'
            ];

            $this->validate($request,$validateRules);

            $formData = $request->all();
            $formData['create_man_id'] = Auth::id();

            $group = Group::create($formData);

            User_Group::create(['user_id'=>$formData['create_man_id'],'group_id'=>$group->id]);

            return redirect()->to('group/content/'.$group->id.'/article');

        }else{
            return view('web.group.create');
        }
    }

    /**
     * @param $id
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 判断用户是否加入小组
     */
    private function is_in($group_id){
        if (User_Group::where(['user_id'=>Auth::id(),'group_id'=>$group_id])->first()){
            return true;
        }else {
            return false;
        }
    }

    public function getGroupContent($id,$type){
        $group = Group::find($id);
        if ('article'===$type){
            $types = $group->articles()->where('status_id',2)->get();
        }
        if ('question'===$type){
            $types = $group->questions;
        }
        if ('user'===$type){
            $types = $group->users;
        }

        return view('web.group.content.index',
            [
                'group'=>$group,
                'types'=>$types,
                'type'=>$type,
                'is_in'=>$this->is_in($id)
            ]);
    }

    /**获取小组列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function grouplist(){
        return view('web.group.list',['groups'=>Group::get()]);
    }

    /**
     * 用户加入或退出小组
     */
    public function in_or_out($group_id){
        $user_id = Auth::id();
        if (User_Group::where(['user_id'=>$user_id,'group_id'=>$group_id])->first()){
            User_Group::where(['user_id'=>$user_id,'group_id'=>$group_id])->delete();
            return ['button_value'=>'加入'];
        }else{
            User_Group::create(['user_id'=>$user_id,'group_id'=>$group_id]);
            return ['button_value'=>'退出'];
        }



    }
}
