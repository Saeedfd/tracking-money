<?php


namespace App\Http\Controllers\V1\Accounts\Actions;


use App\Http\Controllers\V1\Actions\BaseAction;
use App\Models\Accounts;
use Illuminate\Http\Request;

class EditAccount extends BaseAction
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

        return true;
    }

    public function execute($id = null)
    {
        $name = $this->request->input('name', null);
        $desc = $this->request->input('description', null);

        $account = Accounts::where('id', $id)->first();
        if($name != null) {
            $account->title =   $name;
        }
        if($desc != null) {
            $account->description = $desc;
        }
        $account->save();

        return true;
    }

    public function rules()
    {
        return [
            'name' =>  'string|min:3|max:50',
            'description'   => 'string'
        ];
    }
}