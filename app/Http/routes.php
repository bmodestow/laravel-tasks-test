<?php

use App\Task;
use Illuminate\Http\Request;

// display all tasks

Route::get('/', function() {
    //
    $tasks = Task::orderBy('created_at', 'asc')->get();
    //
    return view('tasks', [
        'tasks' => $tasks
    ]);
    //
});

// Add a new task

Route::post('/task', function (Request $request) {
    //
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);
    //
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    //
    $task = new Task;
    $task->name = $request->name;
    $task->save();
    //
    return redirect('/');
    //
});

// delete an existing task

Route::delete('/task/{id}', function ($id) {
    //
    Task::findOrFail($id)->delete();

    return redirect('/');
    //
});
