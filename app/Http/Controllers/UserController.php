<?php

namespace App\Http\Controllers;

use App\Handlers\Passport;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public function preregister(Request $request)
    {
        // 常规数据验证
        $validator = Validator::make($request->post(), [
            "username" => "required|unique:users,name",
            "password" => "required",
        ], [
            "username.required" => "用户名不能为空",
            "username.unique"   => "用户名已存在",
            "password.required" => "用户密码不能为空",
        ]);

        if ($validator->fails()) {
            return $this->returnJson([], $validator->errors()->first(), 400);
        }

        // 创建用户
        $user = new User();

        $user->name     = $request->post("username");
        $user->password = bcrypt($request->post("password"));
        $user->phone    = "1894988" . mt_rand(1000, 9999);
        $user->is_admin = 0;

        $user->save();

        // 从passport handler创建新的token
        $passport = new Passport();
        $token    = $passport->createToken($user->name, $user->password);
        return $this->returnJson($token, "注册成功");
    }

    // 刷新Token
    public function refreshToken(Request $request)
    {
        $validator = Validator::make($request->post(), [
            "refresh_token" => "required",
        ], [
            "refresh_token.required" => "刷新token不能为空"
        ]);

        if ($validator->fails()) {
            return $this->returnJson([], $validator->errors()->first(), 400);
        }

        $passport = new Passport();
        $token    = $passport->refreshToken($request->post("refresh_token"));
        return $this->returnJson($token, "刷新成功");
    }

    // 获取用户信息
    public function getDetails()
    {
        $data = Auth::user();
        return $this->returnJson($data);
    }

    public function nameLogin()
    {
        return response("Unauthorized", 401);
    }

    // 用户登录
    public function login(Request $request)
    {

    }
}
