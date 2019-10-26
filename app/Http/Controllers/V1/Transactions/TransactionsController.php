<?php


namespace App\Http\Controllers\V1\Transactions;


use App\Http\Controllers\Controller;
use App\Http\Controllers\V1\Traits\Returner;
use App\Http\Controllers\V1\Transactions\Actions\SubmitTransactions;

class TransactionsController extends Controller
{
    protected $returner;

    public function __construct(Returner $returner)
    {
        $this->returner = $returner;
    }

    public function submitTransactions(SubmitTransactions $transactions)
    {
        // Do Validating
        if (($errors = $transactions->validation()) !== true) {
            return $this->returner->failureReturner(
                400,
                30001,
                $errors,
                "اشکال در مقادیر ورودی"
            );
        }

        $result = $transactions->execute();

        if(isset($result['error'])) {
            return $this->returner->failureReturner(
                400,
                30002,
                $result['error'],
                null
            );
        }

        return $this->returner->successReturner(
            200,
            $result,
            'تراکنش با موفقیت اضافه شد.'
        );
    }
}