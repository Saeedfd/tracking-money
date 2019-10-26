<?php


namespace App\Http\Controllers\V1\Accounts\Actions;


use App\Http\Controllers\V1\Actions\BaseAction;
use App\Models\Accounts;
use Illuminate\Http\Request;

class RemoveAccount extends BaseAction
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function validation($id = null)
    {
        if (($errors = parent::validation()) !== true) {
            return $errors;
        }

        $validate = Accounts::where(['id' => $id, 'user_id' => $this->request->user()->id])->first();
        if(!isset($validate)) {
            return [
                'error' => 'شما دسترسی به این قسمت ندارید.'
            ];
        }

        // Check Transaction First

        return true;
    }

    public function execute($id = null)
    {
        $account = Accounts::where('id', $id)->delete();

        return true;
    }

    public function rules()
    {
        return [

        ];
    }
}