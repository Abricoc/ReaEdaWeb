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
            'firstname' => 'required|string|max:40',
            'email' => 'required|email:rfc,dns|max:255|unique:users',
            'password' => 'required|string|min:8'
        ],[
            'firstname.required' => 'Имя пользователя обязательно для заполнения',
            'email.required' =>  'Email обязателен для заполнения',
            'email.email' => 'Необходимо ввести валидный Email адрес',
            'email.unique' => 'Пользователь с таким Email адресом уже существует',
            'password.required' => 'Пароль обязателен для заполнения',
            'password.min' => 'Пароль должен минимум состоять из 8 символов'
        ]);
        $errors = [];
        if ($validator->fails()) {
            $errors['firstname'] = $validator->errors()->first('firstname');
            $errors['email'] = $validator->errors()->first('email');
            $errors['password'] = $validator->errors()->first('password');
            return response()->json([
                'data' => '',
                'errors' => $errors
            ], 200);
        }
        $user = new User;
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->firstname = $request->input('firstname');
        $user->role = 1;
        $user->save();
        $token = $user->createToken($request->email)->plainTextToken;
        $errors['firstname'] = '';
        $errors['email'] = '';
        $errors['password'] = '';
        return response()->json([
            'data' => $token,
            'errors' => $errors
        ], 200);
    }

    public function token(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email:rfc,dns|max:255',
            'password' => 'required|string|min:8'
        ], [
            'email.required' =>  'Email обязателен для заполнения',
            'email.email' => 'Необходимо ввести валидный Email адрес',
            'password.required' => 'Пароль обязателен для заполнения',
            'password.min' => 'Пароль должен минимум состоять из 8 символов'
        ]);
        $errors = [];
        if ($validator->fails()) {
            $errors['email'] = $validator->errors()->first('email');
            $errors['password'] = $validator->errors()->first('password');
            return response()->json([
                'data' => '',
                'errors' => $errors
            ], 200);
        }
        $user = User::where('email', $request->input('email'))->first();
        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            $errors['email'] = "Пользователя с таким Email и паролем не существует";
            $errors['password'] = '';
            return response()->json([
                'data' => '',
                'errors' => $errors
            ], 200);
        }
        $errors['email'] = '';
        $errors['password'] = '';
        return response()->json([
            'data' => $user->createToken($request->email)->plainTextToken,
            'errors' => $errors
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
