<?php


namespace App\Http\Controllers;

use App\Docket;
use Illuminate\Http\Request;

class DocketController extends Controller
{
    //Вывод всех списков дел этого пользователя
    public function dockets($id) //ID пользователя
    {
        $model = new Docket();
        return $model->myDockets($id);
    }

    //Создание нового списка
    public function create(Request $request, $id) //ID пользователя
    {
        $model = new Docket();
        return $model->newDocket($request, $id);
    }

    //Редактирование существующего списка
    public function edit(Request $request, $id) //ID СПИСКА (!)
    {
        $model = new Docket();
        return $model->editDocket($request, $id);
    }
}
