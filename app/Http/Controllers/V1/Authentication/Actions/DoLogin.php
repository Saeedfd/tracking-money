<?php
/**
 * Created by PhpStorm.
 * User: saeed
 * Date: 10/25/19
 * Time: 5:21 PM
 */

namespace App\Http\Controllers\V1\Authentication\Actions;


use App\Http\Controllers\V1\Actions\BaseAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoLogin extends BaseAction
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function validation()
    {
        if (($errors = parent::validation()) !== true) {
            return $errors;
        }

        return true;
    }

    public function execute($data = null)
    {
        $email  =   (isset($data['email'])) ?: $this->request->input('email');
        $password   =   (isset($data['password'])) ?: $this->request->input('password');

        if(!Auth::attempt(['email' => $email, 'password' => $password])) {
            return [
                'error' => "Unauthorized",
                'message' => 'ایمیل یا پسورد اشتباه است.',
            ];
        }

        $user = $this->request->user();

        $token = $user->createToken('money-tracker')->accessToken;

        return [
            'user_id'   => $user->id,
            'token' =>  $token,
            'name'  =>  $user->name
        ];
    }

    public function rules()
    {
        return [
            'email' =>  'required|email|exists:users,email',
            'password'  =>  'required|string'
        ];
    }
}