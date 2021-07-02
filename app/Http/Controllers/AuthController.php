<?php


namespace App\Http\Controllers;


use App\Models\User;
use EasyWeChat\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function qrcodeToken(){
        $token = md5(uniqid(microtime()));
        Cache::put($token, time(), 300);
        return $this->response($token);
    }

    public function qrcodeVerify(Request $request){
        $loginData = Cache::get($request->input('token').'_login_data');
        if ($loginData){
            return $this->response($loginData);
        }
        $time = (int)Cache::get($request->input('token'));
        if (!$time || ($time + 300) < time()){
            abort(1021);
        }
        abort(1022);
    }

    public function qrcodeLogin(Request $request){
        $time = (int)Cache::get($request->input('token'));
        if (!$time || ($time + 300) < time()){
            abort(1021);
        }
        $loginData = [
            'token' => $request->bearerToken(),
            'userInfo' => $request->user(),
        ];
        Cache::put($request->input('token').'_login_data', $loginData, 60);
        return $this->response(null, '登录成功');
    }

    public function wxLogin(Request $request)
    {
        if (!$request->input('code')){
            abort(5003);
        }
        $wxAuth = [];
        $openid = $session_key = null;
        try {
            $app = Factory::miniProgram(config('wechat'));
            $wxAuth = $app->auth->session($request->input('code'));
            $openid = $wxAuth['openid'];
            $session_key = $wxAuth['session_key'];
        } catch (\Exception $e) {
            Log::error("wx-auth", $wxAuth);
            abort(5003);
        }
        if (!$user = User::where('openid', $openid)->first()) {
            $user = new User();
            $params['keyword'] = uniqid();
        }
        $params['openid'] = $openid;
        $params['session_key'] = $session_key;
        if ($request->input('userInfo')) {
            $params['nickname'] = $request->input('userInfo')['nickName'];
            $params['avatar'] = $request->input('userInfo')['avatarUrl'];
            $params['driver'] = 'wx';
        }
        return $this->response($this->doLogin($user, $params));
    }

    public function index ($data = null) {
        JavaScriptFacade::put(compact('data'));
        return view('login' , ['ok'=> $data ? 1 : 0]);
    }
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
        $user->driver = $driver;
        $user->save();
        $data = $this->doLogin($user);
        return $this->index($data);
    }

    public function doLogin($user, $params = []){
        if ($user->status != 0) {
            abort(5001, User::$EnumStatus[$user->status]);
        }
        $params['last_login_time'] = date("Y-m-d H:i:s", time());
        $user->fill($params);
        if (!$user->save()) {
            abort(5001);
        }
        $token = $user->createToken($user->id);
        return [
            'token' => $token->plainTextToken,
            'userInfo' => $user
        ];
    }

    public function login(Request $request)
    {
        $user = User::where('id', 1)
            ->first();
        if (!is_object($user)) {
            abort(5002);
        }

        $data = $this->doLogin($user);
        return $this->response($data);
    }


    public function loginOut(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->response();
    }
}
