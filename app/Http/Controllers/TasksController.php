<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    // getでtasks/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        $tasks = Task::all(); //変数$tasksにTaskﾃｰﾌﾞﾙのﾚｺｰﾄﾞを代入する。
        
        
        // 第2引数の'tasks'がtasks.indexに飛ばされる、その先では$tasksと書くのでここの$tasksとは別
        return view('tasks.index', ['tasks' => $tasks,]);
        // 変数1に表示したいViewを指定、変数2では指定したViewに渡すデータを指定している
    }

    // getでtasks/createにアクセスされた場合の「新規登録画面処理」
    public function create()
    {
        $task = new Task;
        
        return view('tasks.create', ['task' => $task]);
    }

    // postでtasks/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        $this->validate($request, [
                'content' => 'required|max:191',
            ]);
        
        $task = new Task;
        $task->content = $request->content;
        $task->save();
        
        return redirect('/');
    }

    // getでtasks/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        $task = Task::find($id);
        
        return view('tasks.show', ['task' => $task]);
    }

    // getでtasks/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        $task = Task::find($id);
        
        return view('tasks.edit', ['task' => $task,]);
    }

    // putまたはpatchでtasks/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
                'content' => 'required|max:191',
            ]);
        
        $task = Task::find($id);
        $task->content = $request->content;
        $task->save();
        
        return redirect('/');
    }

    // deleteでtasks/idにアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        
        return redirect('/');
    }
}
