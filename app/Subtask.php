<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use \DB;
use Validator;

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

    public function rules()
    {
        return [

            'title'=>'required|max:50|min:1',
            'details'=>'max:100',
        ];

    }
    public function mySubtasks($id, $column, $par)
    {
        return DB::table('subtasks')
            ->select(['id', 'title', 'details', 'hard', 'finished', 'created_at', 'updated_at',])
            ->where('task_id', $id)
            ->orderBy($column, $par)
            ->get();
    }


    public function newSubtask(Request $request, $id)
    {
        $subtask = new Subtask();
        $subtask->task_id = $id;
        $subtask->title=$request->input('title');
        $subtask->details=$request->input('details');
        $subtask->hard=$request->input('hard');

        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else $subtask->save();



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

    public function isFinished($id, $finished)
    {
        return DB::table('subtasks')
            ->where('id', $id)
            ->update(['finished' => $finished]);
    }

    public function delSubtask($id)
    {
        return DB::table('subtasks')
            ->where('id', $id)
            ->delete();

    }

}
