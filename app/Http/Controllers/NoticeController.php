<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    //

    function createNotice(Request $request)
    {

        $request->validate(
            [
                'title' => 'required',
                'description' => 'required',
                'date' => 'required',
            ]
        );
        $time = strtotime($request->date);
        $notice =  Notice::create([
            "title" => $request->title,
            "description" => $request->description,
            "date" =>  date('Y-m-d', $time)
        ]);
        return response(
            [
                "message" => "Notice has been created successfully",
                "notice" => $notice
            ],
            200
        );
    }

    function deleteNotice($noticeId)
    {
        $notice = Notice::find($noticeId);
        if ($notice == null) {
            return  response([
                "message" => "Notice not found"
            ], 400);
        } else {
            $notice->delete();
            return response(
                [
                    "message" => "Notice deleted successfully",
                ],
                200
            );
        }
    }

    function getAllNotices()
    {
        return response(
            Notice::orderBy('date','desc')->get()
        , 200);
    }
}
