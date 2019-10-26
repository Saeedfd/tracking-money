<?php


namespace App\Http\Controllers\V1\Transactions\Actions;


use App\Http\Controllers\V1\Actions\BaseAction;
use App\Models\Transactions;
use Illuminate\Http\Request;

class SubmitTransactions extends BaseAction
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
        $accountId = $this->request->input('account_id');
        $type = $this->request->input('type');
        $amount = $this->request->input('amount');
        $categoryId = $this->request->input('category_id');
        $channel = $this->request->input('channel');
        $description = $this->request->input('description', null);

        $transactions = new Transactions();
        $transactions->type = $type;
        $transactions->amount = $amount;
        $transactions->category_id = $categoryId;
        $transactions->account_id = $accountId;
        $transactions->channel = $channel;
        $transactions->user_id = $this->request->user()->id;
        if($description !== null) {
            $transactions->description = $description;
        }

        $transactions->save();
        return true;
    }

    public function rules()
    {
        return [
            'type' =>  'required|string|in:input,output',
            'description'   => 'string',
            'amount' => 'required|integer|min:0|max:9999999999',
            'category_id' => 'required|integer|exists:categories,id',
            'channel' => 'required|string|in:regular,loan,cheque',
            'account_id' => 'required|integer|exists:accounts,id'
        ];
    }
}