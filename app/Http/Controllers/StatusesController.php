<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Status;
class StatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //显示页面
    public function create()
    {
        return view('statuses.create');
    }

    //创建逻辑
    public function store()
    {
        dd(1);
        $this->validate(request(),[
            'content' => 'required|max:140',
        ]);
        Auth::user()->statuses()->create([
            'content' => request('content')
        ]);
        session()->flash('success','发布成功');
        return redirect()->back();

    }

    public function destroy(Status $status)
    {
        // dd(2);
        $this->authorize('destroy', $status);
        $status->delete();
        session()->flash('success', '微博已被成功删除！');
        return redirect()->back();
    }
}
