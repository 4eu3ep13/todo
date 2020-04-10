<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use \DB;

class Subtask extends Model
{
    protected $fillable = [
        'id',
        'task_id',
        'title',
        'details',
        'hard',
        'finished',
        'created_at',
        'updated_at',
    ];

    public function mySubtasks($id)
    {
        return DB::table('subtasks')
            ->select(['id', 'title', 'details', 'hard', 'finished', 'created_at', 'updated_at',])
            ->where('task_id', $id)
            ->get();
    }


    public function newSubtask(Request $request, $id)
    {
        $subtask = new Subtask();
        $subtask->task_id = $id;
        $subtask->title=$request->input('title');
        $subtask->details=$request->input('details');
        $subtask->hard=$request->input('hard');

        $subtask->save();

        return response()->json($subtask);
    }

    public function editSubtask (Request $request, $id)
    {
        $subtask = Subtask::find($id);
        $subtask->title=$request->input('title');
        $subtask->details=$request->input('details');
        $subtask->hard=$request->input('hard');
        $subtask->finished=$request->input('finished');


        $subtask->save();

        return response()->json($subtask);
    }

}
