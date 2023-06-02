<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{

    function updateUser($userId, Request $request)
    {
        $user = User::find($userId);

        if ($user == null) {
            return response(
                ["message" => "User not found"],
                400
            );
        } else {
            $time = strtotime($request->dateOfBirth);
            $user->update([
                "username" => $request->username,
                "email" => $request->email,
                "bank" => Crypt::encrypt($request->bank),
                "accountNumber" => Crypt::encrypt($request->accountNumber),
                "nextOfKinName" => $request->nextOfKinName,
                "nextOfKinPhoneNumber" => $request->nextOfKinPhoneNumber,
                "nextOfKinAddress" => $request->nextOfKinAddress,
                "occupation" => $request->occupation,
                "gender" => $request->gender,
                "address" => $request->address,
                "phoneNumber" => $request->phoneNumber,
                "accountStatus" => $request->accountStatus,
                "middleName" => $request->middleName,
                "lastName" => $request->lastName,
                "firstName" => $request->firstName,
                "title" => $request->title,
                "dateOfBirth" => date('Y-m-d', $time),
                "role" => $request->role
            ]);
        }


        return response(
            [
                "message" => "User updated successfully",
                "user" => $user
            ],
            200
        );
    }

    function suspendUser($userId)
    {
        $user = User::find($userId);

        if ($user == null) {
            return response(
                ["message" => "User not found"],
                400
            );
        } else {
            $user->update([
                "accountStatus" => "suspended"
            ]);
        }

        return response(
            [
                "message" => "User account suspended successfully",
                "user" => $user
            ],
            200
        );
    }

    function updatePassword($userId, Request $request)
    {
        $user = User::find($userId);

        if ($user == null) {
            return response(
                ["message" => "User not found"],
                400
            );
        } else if ($request->password == null || $request->password == "") {
            return response(
                ["message" => "Provided password cannot be empty"],
                400
            );
        } else {
            $user->update([
                "password" => Hash::make($request->password)
            ]);
        }

        return response(
            [
                "message" => "User password updated successfully",
                "user" => $user
            ],
            200
        );
    }
}
