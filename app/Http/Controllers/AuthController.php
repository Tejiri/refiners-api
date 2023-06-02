<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //

    function registerUser(Request $request)
    {
        $this->validate(
            $request,
            [
                'nextOfKinName' => 'required',
                'nextOfKinPhoneNumber' => 'required',
                'nextOfKinAddress' => 'required',
                'occupation' => 'required',
                'gender' => 'required',
                'address' => 'required',
                'phoneNumber' => 'required',
                'accountStatus' => 'required',
                'lastName' => 'required',
                'firstName' => 'required',
                'title' => 'required',
                'dateOfBirth' => 'required',
                'role' => 'required',
                'username' => 'required|unique:users,username',
                'email' => 'required|unique:users,email',
                'password' => 'required'
            ]
        );

        $time = strtotime($request->dateOfBirth);
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'bank' => Crypt::encrypt($request->bank),
            'accountNumber' => Crypt::encrypt($request->accountNumber),
            'nextOfKinName' => $request->nextOfKinName,
            'nextOfKinPhoneNumber' => $request->nextOfKinPhoneNumber,
            'nextOfKinAddress' => $request->nextOfKinAddress,
            'occupation' => $request->occupation,
            'gender' => $request->gender,
            'address' => $request->address,
            'phoneNumber' => $request->phoneNumber,
            'loanApplicationStatus' => $request->loanApplicationStatus,
            'accountStatus' => $request->accountStatus,
            'middleName' => $request->middleName,
            'lastName' => $request->lastName,
            'firstName' => $request->firstName,
            'title' => $request->title,
            'dateOfBirth' => date('Y-m-d', $time),
            'role' => $request->role,
        ]);

        $this->createUserAccounts($user);

        $token =  $user->createToken('refiners-Token')->plainTextToken;

        return response(
            [
                'user' => $user,
                'token' => $token
            ],
            200
        );
    }

    function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = User::where('email', $request->email)->with('account')->first();
            $token =   $user->createToken('refiners-Token')->plainTextToken;

            if ($user->bank == null || $user->accountNumber == null) {
                $user->bank = null;
                $user->accountNumber = null;
            } else {
                $user->bank = Crypt::decrypt($user->bank);
                $user->accountNumber = Crypt::decrypt($user->accountNumber);
            }
            
           
            $response = [
                "user" => $user,
                'token' => $token
            ];
            return response()->json($response, 200);
        } else {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

    function createUserAccounts(User $user)
    {
        $user->account()->create(
            [
                'shareCapital' => 0.00,
                'thriftSavings' => 0.00,
                'specialDeposit' => 0.00,
                'commodityTrading' => 0.00,
                'fine' => 0.00,
                'loan' => 0.00,
                'projectFinancing' => 0.00,
                'userId' => $user->id,
            ]
        );
        # code...
    }
}
