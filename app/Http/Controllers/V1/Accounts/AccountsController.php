<?php
/**
 * Created by PhpStorm.
 * User: saeed
 * Date: 10/26/19
 * Time: 12:03 AM
 */

namespace App\Http\Controllers\V1\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Controllers\V1\Accounts\Actions\EditAccount;
use App\Http\Controllers\V1\Accounts\Actions\GetAllAccounts;
use App\Http\Controllers\V1\Accounts\Actions\RemoveAccount;
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

    public function editAccount(EditAccount $account, $id)
    {
        // Do Validating
        if (($errors = $account->validation($id)) !== true) {
            return $this->returner->failureReturner(
                400,
                20003,
                $errors,
                "اشکال در مقادیر ورودی"
            );
        }

        $result = $account->execute($id);

        if(isset($result['error'])) {
            return $this->returner->failureReturner(
                400,
                20004,
                $result['error'],
                null
            );
        }

        return $this->returner->successReturner(
            200,
            $result,
            'تغییرات انجام شد.'
        );
    }

    public function removeAccount(RemoveAccount $account, $id)
    {
        // Do Validating
        if (($errors = $account->validation($id)) !== true) {
            return $this->returner->failureReturner(
                400,
                20005,
                $errors,
                "اشکال در مقادیر ورودی"
            );
        }

        $result = $account->execute($id);

        if(isset($result['error'])) {
            return $this->returner->failureReturner(
                400,
                20006,
                $result['error'],
                null
            );
        }

        return $this->returner->successReturner(
            200,
            $result,
            'کیف پول با موفقیت حذف شد.'
        );
    }

    public function getAccounts(GetAllAccounts $accounts)
    {
        // Do Validating
        if (($errors = $accounts->validation()) !== true) {
            return $this->returner->failureReturner(
                400,
                20007,
                $errors,
                "اشکال در مقادیر ورودی"
            );
        }

        $result = $accounts->execute();

        if(isset($result['error'])) {
            return $this->returner->failureReturner(
                400,
                20008,
                $result['error'],
                null
            );
        }

        return $this->returner->successReturner(
            200,
            $result,
            true
        );
    }
}