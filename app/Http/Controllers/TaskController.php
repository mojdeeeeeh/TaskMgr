<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Verta;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $relations = ['sender_user',
                        'functor_user',
                        'seconder_user',
                        'taskStatus'];
            
            $tasks = \App\Task::with($relations)
                        ->get();
        
            return $tasks;
        }

        return view('tasks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        // $startDateE = $request->start;
        $v = Verta::parse($request->persianStartDate);
        $start = $v->formatGregorian('Y-m-d H:i:s');

        $f = Verta::parse($request->persianFinishDate);
        $finish = $f->formatGregorian('Y-m-d H:i:s');

        $data = [
            'title' => $request->title,
            'body' => $request->body,
            'start' => $start,
            'finish' => $finish,
            'weight' => $request->weight,
            'sender_user_id' => \Auth::user()->id,
            'functor_user_id' => $request->functor_user_id,
            'seconder_user_id' => $request->seconder_user_id,
            'task_status_id' => $request->task_status_id,
            'task_status_id' => 1,
        ];

        $result = Task::create($data);

        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        
        $task->update([
            'title' => $request->title,
            'body' => $request->body,
            'start' => $request->start,
            'finish' => $request->finish,
            'weight' => $request->weight,
            'functor_user_id' => $request->functor_user_id,
            'seconder_user_id' => $request->seconder_user_id,
            'task_status_id' => $request->task_status_id,
        ]);
       

        return $task;
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
       $result = $task->delete();

        return ['status' => $result];
    }
}
