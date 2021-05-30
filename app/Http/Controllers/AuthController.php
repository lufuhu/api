<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('id', 1)
            ->first();
        if (!is_object($user)) {
            abort(5002);
        }
        if ($user->status != 0) {
            abort(5001, User::$EnumStatus[$user->status]);
        }
        return $this->doLogin($user);
    }


    public function loginOut(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->response();
    }

    public function doLogin($user, $params = [])
    {
        $params['last_login_time'] = date("Y-m-d H:i:s", time());
        $user->fill($params);
        if (!$user->save()) {
            abort(5001);
        }
        $token = $user->createToken($user->id);
        return $this->response([
            'token' => $token->plainTextToken,
            'userInfo' => $user
        ]);
    }

    public function updateUserInfo(Request $request)
    {
        $keys = ['nickname', 'avatarurl', 'gender'];
        $params = [];
        foreach ($keys as $item) {
            if ($request->input($item)) {
                $params[$item] = $request->input($item);
            }
        }
        return $this->doLogin($request->user(), $params);
    }
}
