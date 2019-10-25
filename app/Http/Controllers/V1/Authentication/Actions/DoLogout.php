<?php
/**
 * Created by PhpStorm.
 * User: saeed
 * Date: 10/25/19
 * Time: 5:57 PM
 */

namespace App\Http\Controllers\V1\Authentication\Actions;


use App\Http\Controllers\V1\Actions\BaseAction;
use Illuminate\Http\Request;

class DoLogout extends BaseAction
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

    public function execute()
    {
        $this->request->user()->token()->revoke();
        return true;
    }

    public function rules()
    {
        return [

        ];
    }
}