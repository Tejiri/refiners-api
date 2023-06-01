<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //

    function getAllAccountsTotal()
    {
        $accounts =  Account::all();

        $shareCapitalTotal = 0;
        $thriftSavingsTotal = 0;
        $specialDepositTotal = 0;
        $commodityTradingTotal = 0;
        $fineTotal = 0;
        $loanTotal = 0;
        $projectFinancingTotal = 0;

        for ($i = 0; $i < count($accounts); $i++) {
            $shareCapitalTotal = $shareCapitalTotal + $accounts[$i]->shareCapital;
            $thriftSavingsTotal = $thriftSavingsTotal + $accounts[$i]->thriftSavings;
            $specialDepositTotal = $specialDepositTotal + $accounts[$i]->specialDeposit;
            $commodityTradingTotal = $commodityTradingTotal + $accounts[$i]->commodityTrading;
            $fineTotal = $fineTotal + $accounts[$i]->fine;
            $loanTotal = $loanTotal + $accounts[$i]->loan;
            $projectFinancingTotal = $projectFinancingTotal + $accounts[$i]->projectFinancing;
        }

        return response([
            "shareCapitalTotal" => number_format($shareCapitalTotal, 2, '.', ','),
            "thriftSavingsTotal" => number_format($thriftSavingsTotal, 2, '.', ','),
            "specialDepositTotal" => number_format($specialDepositTotal, 2, '.', ','),
            "commodityTradingTotal" => number_format($commodityTradingTotal, 2, '.', ','),
            "fineTotal" => number_format($fineTotal, 2, '.', ','),
            "loanTotal" => number_format($loanTotal, 2, '.', ','),
            "projectFinancingTotal" => number_format($projectFinancingTotal, 2, '.', ',')
        ], 200);
    }

    function getAllAccounts()
    {
        $accounts =  Account::with('user')->get();

        if ($accounts == null) {
            # code...
        } else {
            return response($accounts, 200);
        }
    }

    function getAccountByUserId($userId)
    {
        $account = Account::where('userId', $userId)->with('user')->get();
        if ($account == null) {
            # code...
        } else {
            return response($account, 200);
        }
    }
}
