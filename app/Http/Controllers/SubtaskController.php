<?php


namespace App\Http\Controllers;

use App\Subtask;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    //Вывод всех подзадач, относящихся к данной задаче, в обратном хронологическом порядке
    public function subtasks($column, $par, ) //ID пользователя
    {
        $model = new Subtask();
        return $model->mySubtasks($id, $column = 'created_at', $par = 'desc');
    }

    //Создание новой подзадачи
    public function create(Request $request, $id) //ID пользователя
    {
        $model = new Subtask();
        return $model->newSubtask($request, $id);
    }

    //Редактирование существующей подзадачи
    public function edit(Request $request, $id) //ID ЗАПИСИ (!)
    {
        $model = new Subtask();
        return $model->editSubtask($request, $id);
    }

    public function finished($id)
    {
        $model = new Subtask();
        return $model->isFinished($id, $finished = true);
    }

    public function notFinished($id)
    {
        $model = new Subtask();
        return $model->isFinished($id, $finished = false);
    }

    public function delete($id)
    {
        $model = new Subtask();
        return $model->delTask($id);
    }


}
