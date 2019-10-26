<?php


namespace App\Http\Controllers\V1\Accounts\Actions;


use App\Http\Controllers\V1\Actions\BaseAction;
use App\Models\Accounts;
use Illuminate\Http\Request;

class GetAllAccounts extends BaseAction
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
        $accounts = Accounts::select('title as name', 'id', 'description')->where('user_id', $this->request->user()->id)->get();

        return $accounts;
    }

    public function rules()
    {
        return [

        ];
    }
}