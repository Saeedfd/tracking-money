<?php
/**
 * Created by PhpStorm.
 * User: saeed
 * Date: 10/26/19
 * Time: 12:06 AM
 */

namespace App\Http\Controllers\V1\Accounts\Actions;


use App\Http\Controllers\V1\Actions\BaseAction;
use App\Models\Accounts;
use Illuminate\Http\Request;

class CreateAccount extends BaseAction
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
        $name = $this->request->input('name');
        $desc = $this->request->input('description', null);

        $account = new Accounts();
        $account->title =   $name;
        if($desc != null) {
            $account->description = $desc;
        }
        $account->user_id = $this->request->user()->id;
        $account->save();

        return true;
    }

    public function rules()
    {
        return [
            'name' =>  'required|string|min:3|max:50',
            'description'   => 'string'
        ];
    }
}