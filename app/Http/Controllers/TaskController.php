<?php


namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //Вывод всех задач, относящихся к данному листу
    public function tasks($id) //ID пользователя
    {
        $model = new Task();
        return $model->myTasks($id);
    }

    //Создание новой задачи
    public function create(Request $request, $id) //ID пользователя
    {
        $model = new Task();
        return $model->newTask($request, $id);
    }

    //Редактирование существующей задачи
    public function edit(Request $request, $id) //ID ЗАПИСИ (!)
    {
        $model = new Task();
        return $model->editTask($request, $id);
    }

    public function finished($id)
    {
        $model = new Task();
        return $model->isFinished($id, $finished = true);
    }

    public function notFinished($id)
    {
        $model = new Task();
        return $model->isFinished($id, $finished = false);
    }

    public function delete($id)
    {
        $model = new Task();
        return $model->delTask($id);
    }
}
