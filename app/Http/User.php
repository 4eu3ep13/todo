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

            'login'=>'required|max:32|unique:users|min:6',
            'password'=>'required|max:32|min:6|confirmed',
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
