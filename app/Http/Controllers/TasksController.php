<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;    // 追加

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         // メッセージ一覧を取得
        $task = Task::all();
      

        // メッセージ一覧ビューでそれを表示
        return view('tasks.index', [
            'task' => $task
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $task = new Task;

        // メッセージ作成ビューを表示
        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:255',
            'status' => 'required | max:10'
        ]);
        //
        // メッセージを作成
        //$task = new Task;
        //$task->content = $request->content;
        //$task->status = $request->status;
        //$task->save();
        
        
        $request->user()->tasks()->create([  //user_idのカラムに自動的にuser_idをいれるために、モデルファイルで定義したbelongToのメソッドを呼び出している
            'content' => $request->content,
            'status' => $request->status
        ]);
       

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
        
        $task = Task::findOrFail($id);
        $login_id = \Auth::id();
        
        if($login_id != $task->user_id){
            return redirect('/');
            
        };
        
        // idの値でメッセージを検索して取得
        

        // メッセージ詳細ビューでそれを表示
        
        return view('tasks.show', [
            'task' => $task,
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
 
        $login_id = \Auth::id();
        
        if($login_id != $task->user_id){
            return redirect('/');
            
        };

        // メッセージ編集ビューでそれを表示
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|max:255',
            'status' => 'required | max:10'
        ]);
        //
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
        $login_id = \Auth::id();
        
        if($login_id != $task->user_id){
            return redirect('/');
            
        };
        
        // メッセージを更新
        $task->content = $request->content;
        $task->status = $request->status; 
        $task->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
  
        $login_id = \Auth::id();
        
        if($login_id != $task->user_id){
            return redirect('/');
            
        };
        // メッセージを削除
        $task->delete();

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}
