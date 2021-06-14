<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{

    /**
     * 将用户重定向到 GitHub 的授权页面
     */
    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    /**
     * 从 GitHub 获取用户信息
     */
    public function handleProviderCallback($driver)
    {
        $soUser = Socialite::driver($driver)->user();
        $user = User::where('openid', $soUser->getId())->first();
        if (!is_object($user)){
            $user = new User();
        }
        $user->openid = $soUser->getId();
        $user->username = $soUser->getName();
        $user->mail = $soUser->getEmail();
        $user->avatar = $soUser->getAvatar();
        $user->nickname = $soUser->getNickname();
        $user->save();
        return $this->doLogin($user);
    }

    public function login(Request $request)
    {
        $user = User::where('id', 1)
            ->first();
        if (!is_object($user)) {
            abort(5002);
        }

        return $this->doLogin($user);
    }

    public function doLogin($user, $params = [])
    {
        if ($user->status != 0) {
            abort(5001, User::$EnumStatus[$user->status]);
        }
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


    public function loginOut(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->response();
    }
}
