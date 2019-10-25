<?php
/**
 * Created by PhpStorm.
 * User: saeed
 * Date: 10/26/19
 * Time: 12:03 AM
 */

namespace App\Http\Controllers\V1\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Controllers\V1\Traits\Returner;
use App\Http\Controllers\V1\Accounts\Actions\CreateAccount;

class AccountsController extends Controller
{
    protected $returner;

    public function __construct(Returner $returner)
    {
        $this->returner = $returner;
    }

    public function createAccount(CreateAccount $account)
    {
        // Do Validating
        if (($errors = $account->validation()) !== true) {
            return $this->returner->failureReturner(
                400,
                20001,
                $errors,
                "اشکال در مقادیر ورودی"
            );
        }

        $result = $account->execute();

        if(isset($result['error'])) {
            return $this->returner->failureReturner(
                400,
                20002,
                $result['error'],
                null
            );
        }

        return $this->returner->successReturner(
            200,
            $result,
            'کیف پول ایجاد شد.'
        );
    }
}