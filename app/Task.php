<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use \DB;
use Validator;

class Task extends Model
{
    protected $fillable =
    [
        'id',
        'user_id',
        'title',
        'details',
        'hard',
        'finished',
        'created_at',
        'updated_at',
        'yes',
        'no',
    ];

    public function rules()
    {
        return [

            'title'=>'required|max:50|min:1',
            'details'=>'max:100',
        ];

    }

    public function listFinished($id, $finished, $column, $par)
    {
        return DB::table('tasks')
            ->select(['id', 'name', 'done', 'created_at', 'updated_at'])
            ->where('user_id', $id)
            ->where('finished', $finished)
            ->orderBy($column, $par)
            ->get();
    }

    public function myTasks($id, $column, $par)
    {

        return DB::table('tasks')
            ->select(['id', 'title', 'details', 'hard', 'finished', 'created_at', 'updated_at',])
            ->where('user_id', $id)
            ->orderBy($column, $par)
            ->get();
    }


    public function newTask(Request $request, $id)
    {
        $task = new Task();
        $task->user_id = $id;
        $task->title=$request->input('title');
        $task->details=$request->input('details');
        $task->hard=$request->input('hard');

        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else $task->save();



        return response()->json($task);
    }

    public function editTask (Request $request, $id)
    {
        $task = Task::find($id);
        $task->title=$request->input('title');
        $task->details=$request->input('details');
        $task->hard=$request->input('hard');
        $task->finished=$request->input('finished');


        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else $task->save();



        return response()->json($task);
    }

    public function isFinished($id, $finished)
    {
        return DB::table('tasks')
            ->where('id', $id)
            ->update(['finished' => $finished]);
    }

    public function delTask($id)
    {
        return DB::table('tasks')
            ->where('id', $id)
            ->delete();

    }

}
