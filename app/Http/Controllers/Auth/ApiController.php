<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswords;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
        $device = Device::where('user_id', $user->id)->where('device_token', $request->input('device_id'))->first();
        if($device == null && $request->has('device_id'))
        {
            $device = new Device;
            $device->user_id = $user->id;
            $device->device_token = $request->input('device_id');
            $device->save();
        }
        $token = $user->createToken($request->input('email'))->plainTextToken;
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
        if ($request->has('device_id')){
            $device = Device::where('user_id', $user->id)->where('device_token', $request->input('device_id'))->first();
            if($device == null && $request->has('device_id'))
            {
                $device = new Device;
                $device->user_id = $user->id;
                $device->device_token = $request->input('device_id');
                $device->save();
            }
        }
        $user->save();
        return response()->json([
            'data' => $user->createToken($request->input('email'))->plainTextToken,
            'errors' => $errors
        ], 200);
    }

    public function ResetPassword(Request $request){
        $user = User::where('email', $request->input('email'))->first();
        $newPassword = Str::random(8);
        $user->password = bcrypt($newPassword);
        $user->save();
        Mail::to($request->input('email'))->send(new ResetPasswords($newPassword));
        return response(null, 200);
    }

    public function ChangeName(Request $request){
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:40',
        ],[
            'firstname.required' => 'Имя пользователя обязательно для заполнения',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => '',
                'errors' => [
                    'firstname' => $validator->errors()->first('firstname'),
                    'email' => '',
                    'password' => ''
                ]
            ], 200);
        }
        $user = $request->user();
        $user->firstname = $request->input('firstname');
        $user->save();
        return response()->json([
            'data' => '',
            'errors' => [
                'firstname' => '',
                'email' => '',
                'password' => ''
            ]
        ], 200);
    }

    public function ChangePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8'
        ],[
            'password.required' => 'Пароль обязателен для заполнения',
            'password.min' => 'Пароль должен минимум состоять из 8 символов'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => '',
                'errors' => [
                    'firstname' => '',
                    'email' => '',
                    'password' => $validator->errors()->first('password')
                ]
            ], 200);
        }
        $user = $request->user();
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return response()->json([
            'data' => '',
            'errors' => [
                'firstname' => '',
                'email' => '',
                'password' => ''
            ]
        ], 200);
    }

    public function ChangeEmail(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc,dns|max:255|unique:users',
        ],[
            'email.required' =>  'Email обязателен для заполнения',
            'email.email' => 'Необходимо ввести валидный Email адрес',
            'email.unique' => 'Пользователь с таким Email адресом уже существует',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'data' => '',
                'errors' => [
                    'firstname' => '',
                    'email' => $validator->errors()->first('email'),
                    'password' => ''
                ]
            ], 200);
        }

        $user = $request->user();
        $user->email = $request->input('email');
        $user->save();
        return response()->json([
            'data' => '',
            'errors' => [
                'firstname' => '',
                'email' => '',
                'password' => ''
            ]
        ], 200);
    }

    public function Profile(Request $request){
        return $request->user()->only(['firstname', 'email']);
    }
}
