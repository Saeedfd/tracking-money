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


    /**
     * @api {post} api/accounts/ Create Account
     * @apiName Create Account
     * @apiGroup Accounts
     * @apiVersion 1.0.0
     *
     * @apiParam {String} token     User token.
     * @apiParam {String} description  Account Description.
     * @apiParam {String} name      Account Name.
     *
     * @apiSuccess {String} message     Message of successfully created account.
     * @apiSuccess {Integer} id         Account ID.
     * @apiSuccess {String} name        Account Name.
     * @apiSuccess {String} description       Account Description.
     */
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


    /**
     * @api {edit} api/accounts/{id} Edit Account
     * @apiName Edit Account
     * @apiGroup Accounts
     * @apiVersion 1.0.0
     *
     * @apiParam {String} token     User token.
     * @apiParam {String} description  Account Description.
     * @apiParam {String} name      Account Name.
     *
     * @apiSuccess {String} message     Message of successfully edit account.
     */
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

    /**
     * @api {delete} api/accounts/{id} Remove Account
     * @apiName Remove Account
     * @apiGroup Accounts
     * @apiVersion 1.0.0
     *
     * @apiParam {String} token     User token.
     *
     * @apiSuccess {String} message     Message of successfully deleted account.
     */
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

    /**
     * @api {get} api/accounts/ Get Accounts
     * @apiName Get Accounts
     * @apiGroup Accounts
     * @apiVersion 1.0.0
     *
     * @apiParam {String} token     User token.
     *
     * @apiSuccess {String} message     true.
     * * array of accounts
     * @apiSuccess {Integer} id         Account ID.
     * @apiSuccess {String} name        Account Name.
     * @apiSuccess {String} description       Account Description.
     */
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