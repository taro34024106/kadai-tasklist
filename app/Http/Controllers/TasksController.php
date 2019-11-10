<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

use App\User;



class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        if(\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasks()->get();
            
        
            $data = [
                'user' => $user,
                'tasks' => $tasks
            ];
        }
        
        return view('welcome',$data);
        
          
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        if(\Auth::check()) {
            $user = \Auth::user();
        }  
        if(\Auth::id() == $user->id){
        return view('tasks.create',['user'=>$user]);
        }else{
            return redirect('/');
        }
            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::id() == $request->user()->id){
        $this->validate($request, ['status' => 'required|max:10']);
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status' =>$request->status
        ]);
        return redirect('/');
        }else{
           return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
         if(\Auth::check()) {
            $user = \Auth::user();
            $task = Task::find($id);
            
            $data = [
                'user'=>$user,
                'task'=>$task
                ];
         }
         
         if(\Auth::id() == $user->id){
       return view('tasks.show',$data);
         }else{
             return redirect('/');
         }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        if (\Auth::id() == $task->user_id) {
        return view('tasks.edit',['task' => $task,]);
        }else{
           return redirect('/');
        }
        
       
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
        $this->validate($request, ['status' => 'required|max:10']);
        $task = Task::find($id);
        $task->content = $request->content;
        $task->status = $request->status;
        $task->save();
        
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
        
        $task = Task::find($id);
        if (\Auth::id() === $task->user_id) {
        $task->delete();
        return redirect('/');
        }else{
           return redirect('/');
        }
    }
}
