<?php


namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    //Вывод всех невыполненных задач
    public function notFinishedTasks($id,  $column, $par)
    {
        $model = new Task();
        return $model->listFinished($id, $finished = false, $column, $par);
    }

    //Вывод всех выполненных задач
    public function finishedTasks($id,  $column, $par)
    {
        $model = new Task();
        return $model->listFinished($id, $finished = true, $column, $par);
    }

    //Вывод всех задач, относящихся к данному листу
    public function tasks($id, $column, $par) //ID пользователя
    {
        $model = new Task();
        return $model->myTasks($id, $column, $par);
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

    //Отметить задачу выполненной
    public function finished($id)
    {
        $model = new Task();
        return $model->isFinished($id, $finished = true);
    }

    //Отметить задачу невыполненной
    public function notFinished($id)
    {
        $model = new Task();
        return $model->isFinished($id, $finished = false);
    }

    //Удалить задачу
    public function delete($id)
    {
        $model = new Task();
        return $model->delTask($id);
    }
}
