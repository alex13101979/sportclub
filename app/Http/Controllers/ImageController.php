<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        if (!empty($request->file('image'))) {
            $fileName = $request->userid . "." . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images'), $fileName);
            User::where('id', $request->userid)
                ->update([
                    'photo' => (string)asset('/images') . '/' . $fileName,
                ]);
            echo "<script>alert('Фото успешно загружено!');</script>";
        } else {
            echo "<script>alert('Фото не загружено!');</script>";
        }
        return view('layouts.admin');
    }
}
