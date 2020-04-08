<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use \DB;

class Docket extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'finished',
        'created_at',
        'updated_at',
        ];

    public function myDockets($id)
    {
        return DB::table('dockets')
            ->select(['id', 'title', 'finished', 'created_at', 'updated_at',])
            ->where('user_id', $id)
           ->get();
    }


    public function newDocket(Request $request, $id)
    {
        $docket = new Docket();
        $docket->user_id = $id;
        $docket->title=$request->input('title');

        $docket->save();

        return response()->json($docket);
    }

    public function editDocket (Request $request, $id) //ID ЗАПИСИ (!)
    {
        $docket = Docket::find($id);
        $docket->title = $request->input('title');

        $docket->save();

        return response()->json($docket);
    }

}
