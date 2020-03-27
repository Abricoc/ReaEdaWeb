<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => ['required', 'string', 'max:40'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ],[
            'firstname.required' => 'Имя пользователя обязательно для заполнения',
            'email.required' =>  'Email обязателен для заполнения',
            'email.email' => 'Необходимо ввести валидный Email адрес',
            'email.unique' => 'Пользователь с таким Email адресом уже существует',
            'password.required' => 'Пароль обязателен для заполнения',
            'password.min' => 'Пароль должен минимум состоять из 8 символов'
        ]);
        if ($validator->fails()) {
            $errors = [];
            $errors['firstname'] = $validator->errors()->first('firstname');
            $errors['email'] = $validator->errors()->first('email');
            $errors['password'] = $validator->errors()->first('password');
            return response()->json([
                'data' => '',
                'errors' => $errors
            ], 401);
        }
        $user = new User;
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->firstname = $request->input('firstname');
        $user->role = 1;
        $user->save();
        $token = $user->createToken($request->email)->plainTextToken;
        return response()->json([
            'data' => $token,
            'errors' => []
        ], 200);
    }

    public function token(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8']
        ], [
            'email.required' =>  'Email обязателен для заполнения',
            'email.email' => 'Необходимо ввести валидный Email адрес',
            'password.required' => 'Пароль обязателен для заполнения',
            'password.min' => 'Пароль должен минимум состоять из 8 символов'
        ]);
        if ($validator->fails()) {
            $errors = [];
            $errors['email'] = $validator->errors()->first('email');
            $errors['password'] = $validator->errors()->first('password');
            return response()->json([
                'data' => '',
                'errors' => $errors
            ], 401);
        }
        $user = User::where('email', $request->input('email'))->first();
        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            $errors = [];
            $errors['email'] = "Пользователя с таким Email и паролем не существует";
            return response()->json([
                'data' => '',
                'errors' => $errors
            ], 401);
        }
        return response()->json([
            'data' => $user->createToken($request->email)->plainTextToken,
            'errors' => []
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'data' => 'OK',
            'errors' => []
        ], 200);
    }

}
