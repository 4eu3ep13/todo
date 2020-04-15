<?php

namespace App;

use Validator;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function rules()
    {
        return [

            'login'=>'required|alpha_dash|max:20|min:3|unique:users|regex: /^(?!.*А.*$)(?!.*Б.*$)(?!.*В.*$)(?!.*Г.*$)(?!.*Д.*$)(?!.*Е.*$)(?!.*Ё.*$)(?!.*Ж.*$)(?!.*З.*$)(?!.*И.*$)(?!.*Й.*$)(?!.*К.*$)(?!.*Л.*$)(?!.*М.*$)(?!.*Н.*$)(?!.*О.*$)(?!.*П.*$)(?!.*Р.*$)(?!.*С.*$)(?!.*Т.*$)(?!.*У.*$)(?!.*Ф.*$)(?!.*Х.*$)(?!.*Ц.*$)(?!.*Ч.*$)(?!.*Ш.*$)(?!.*Щ.*$)(?!.*Ъ.*$)(?!.*Ы.*$)(?!.*Ь.*$)(?!.*Э.*$)(?!.*Ю.*$)(?!.*Я.*$)(?!.*а.*$)(?!.*б.*$)(?!.*в.*$)(?!.*г.*$)(?!.*д.*$)(?!.*е.*$)(?!.*ё.*$)(?!.*ж.*$)(?!.*з.*$)(?!.*и.*$)(?!.*й.*$)(?!.*к.*$)(?!.*л.*$)(?!.*м.*$)(?!.*н.*$)(?!.*о.*$)(?!.*п.*$)(?!.*р.*$)(?!.*с.*$)(?!.*т.*$)(?!.*у.*$)(?!.*ф.*$)(?!.*х.*$)(?!.*ц.*$)(?!.*ч.*$)(?!.*ш.*$)(?!.*щ.*$)(?!.*ъ.*$)(?!.*ы.*$)(?!.*ь.*$)(?!.*э.*$)(?!.*ю.*$)(?!.*я.*$)(.*)$/',       //regex: /^(?![-а-яА-ЯёЁ-])(.*)$/'
            'password'=>'required|alpha_num|max:25|min:6|confirmed|regex: /(^([a-zA-Z]+)(\d+)?$)/u',
        ];

    }

    public function registerUser(Request $request)
    {
        $user = new User();

        $user->login = $request->input('login');
        $user->password = bcrypt($request->input('password'));

        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else $user->save();

        return $user;
    }


}
