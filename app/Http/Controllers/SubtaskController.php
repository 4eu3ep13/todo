<?php


namespace App\Http\Controllers;

use App\Subtask;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    //Вывод всех подзадач, относящихся к данной задаче
    public function subtasks($id) //ID пользователя
    {
        $model = new Subtask();
        return $model->mySubtasks($id);
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
}
