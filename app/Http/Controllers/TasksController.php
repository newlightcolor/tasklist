<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    // getでtasks/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = ['user' => $user, 'tasks' => $tasks,];
            }
            
            return view('welcome', $data);
        
        // 旧コード
        //$tasks = Task::all(); // --comment 変数$tasksにTaskﾃｰﾌﾞﾙのﾚｺｰﾄﾞを代入する。
        // --comment 第2引数の'tasks'がtasks.indexに飛ばされる、その先では"$tasks"と書くがここの"$tasks"ではなく'tasks'に$が付いたもの
        //return view('tasks.index', ['tasks' => $tasks,]);
        // --comment 変数1に表示したいViewを指定、変数2では指定したViewに渡すデータを指定している
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
        
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' => $request->status,
        ]);

        
        // redirect ｺﾝﾄﾛｰﾗｰからｺﾝﾄﾛｰﾗｰへ
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
                'status' => 'max:10',
                'content' => 'required|max:191',
            ]);
        
        $task = Task::find($id);
        $task->status = $request->status;
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
