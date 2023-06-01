<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    function addTransaction($userId, Request $request)
    {
        $user = User::where("id", $userId)->first();
        $time = strtotime($request->date);
        $user->transactions()->create([
            'type' => $request->type,
            'amount' => $request->amount,
            'narration' => $request->narration,
            'date' => date('Y-m-d', $time),
            'account' => $request->account,
        ]);

        if ($request->type == "credit") {
            return  $this->updateAccount($user, $request);
        } else {
            return  $this->updateAccount($user, $request);
        }
    }

    function updateAccount(User $user, Request $request)
    {
        $accounts = $user->account;
        $account = "";

        switch ($request->account) {
            case 'shareCapital':
                if ($request->type == 'credit') {
                    $user->account()->update([
                        $request->account =>  $accounts->shareCapital + $request->amount
                    ]);
                } else {
                    $user->account()->update([
                        $request->account => $accounts->shareCapital - $request->amount
                    ]);
                }
                $account = "Share Capital";
                break;
            case 'thriftSavings':
                if ($request->type == 'credit') {
                    $user->account()->update([
                        $request->account => $accounts->thriftSavings + $request->amount
                    ]);
                } else {
                    $user->account()->update([
                        $request->account => $accounts->thriftSavings - $request->amount
                    ]);
                }
                $account = "Thrift Savings";
                break;
            case 'specialDeposit':
                if ($request->type == 'credit') {
                    $user->account()->update([
                        $request->account => $accounts->specialDeposit + $request->amount
                    ]);
                } else {
                    $user->account()->update([
                        $request->account => $accounts->specialDeposit - $request->amount
                    ]);
                }
                $account = "Special Deposit";
                break;
            case 'commodityTrading':
                if ($request->type == 'credit') {
                    $user->account()->update([
                        $request->account => $accounts->commodityTrading + $request->amount
                    ]);
                } else {
                    $user->account()->update([
                        $request->account => $accounts->commodityTrading - $request->amount
                    ]);
                }
                $account = "Commodity Trading";
                break;
            case 'fine':
                if ($request->type == 'credit') {
                    $user->account()->update([
                        $request->account => $accounts->fine + $request->amount
                    ]);
                } else {
                    $user->account()->update([
                        $request->account => $accounts->fine - $request->amount
                    ]);
                }
                $account = "Fine";
                break;
            case 'loan':
                if ($request->type == 'credit') {
                    $user->account()->update([
                        $request->account => $accounts->loan + $request->amount
                    ]);
                } else {
                    $user->account()->update([
                        $request->account => $accounts->loan - $request->amount
                    ]);
                }
                $account = "Loan";
                break;
            case 'projectFinancing':
                if ($request->type == 'credit') {
                    $user->account()->update([
                        $request->account => $accounts->projectFinancing + $request->amount
                    ]);
                } else {
                    $user->account()->update([
                        $request->account => $accounts->projectFinancing - $request->amount
                    ]);
                }
                $account = "Project Financing";
                break;
            default:

                break;
        }

        $response =
            [
                "user" => User::where('id', $user->id)->with('account')->first(),
                "message" => "$account Account credited successfully"
            ];

        return response($response, 200);
    }

    function getAllTransactions()
    {
        //orders all transactions from newest to oldest transactions
        return Transaction::orderBy('date', 'desc')->get();
    }

    function getAllTransactionsByUserId($userId)
    {
        return Transaction::orderBy('date', 'desc')->where('userId', $userId)->get();
    }

    function deleteTransactionsById($transactionId)
    {
        $transaction = Transaction::find($transactionId);

        if ($transaction == null) {
            return response([
                "message" => "Transaction record not found",
            ], 400);
        }

        switch ($transaction->account) {
            case 'shareCapital':
                if ($transaction->type == 'credit') {
                    $transaction->user->account->update(
                        [
                            "shareCapital" => $transaction->user->account->shareCapital - $transaction->amount
                        ]
                    );
                } else {
                    $transaction->user->account->update([
                        "shareCapital" => $transaction->user->account->shareCapital + $transaction->amount
                    ]);
                }

                break;
            case 'thriftSavings':
                if ($transaction->type == 'credit') {
                    $transaction->user->account->update(
                        [
                            "thriftSavings" => $transaction->user->account->thriftSavings - $transaction->amount
                        ]
                    );
                } else {
                    $transaction->user->account->update([
                        "thriftSavings" => $transaction->user->account->thriftSavings + $transaction->amount
                    ]);
                }
                break;
            case 'specialDeposit':
                if ($transaction->type == 'credit') {
                    $transaction->user->account->update(
                        [
                            "specialDeposit" => $transaction->user->account->specialDeposit - $transaction->amount
                        ]
                    );
                } else {
                    $transaction->user->account->update([
                        "specialDeposit" => $transaction->user->account->specialDeposit + $transaction->amount
                    ]);
                }
                break;
            case 'commodityTrading':
                if ($transaction->type == 'credit') {
                    $transaction->user->account->update(
                        [
                            "commodityTrading" => $transaction->user->account->commodityTrading - $transaction->amount
                        ]
                    );
                } else {
                    $transaction->user->account->update([
                        "commodityTrading" => $transaction->user->account->commodityTrading + $transaction->amount
                    ]);
                }
                break;
            case 'fine':
                if ($transaction->type == 'credit') {
                    $transaction->user->account->update(
                        [
                            "fine" => $transaction->user->account->fine - $transaction->amount
                        ]
                    );
                } else {
                    $transaction->user->account->update([
                        "fine" => $transaction->user->account->fine + $transaction->amount
                    ]);
                }
                break;
            case 'loan':
                if ($transaction->type == 'credit') {
                    $transaction->user->account->update(
                        [
                            "loan" => $transaction->user->account->loan - $transaction->amount
                        ]
                    );
                } else {
                    $transaction->user->account->update([
                        "loan" => $transaction->user->account->loan + $transaction->amount
                    ]);
                }
                break;
            case 'projectFinancing':
                if ($transaction->type == 'credit') {
                    $transaction->user->account->update(
                        [
                            "projectFinancing" => $transaction->user->account->projectFinancing - $transaction->amount
                        ]
                    );
                } else {
                    $transaction->user->account->update([
                        "projectFinancing" => $transaction->user->account->projectFinancing + $transaction->amount
                    ]);
                }
                break;
            default:

                break;
        }

        $transaction->delete();

        return response([
            "message" => "Transaction record deleted successfully",
        ], 200);
    }
}
