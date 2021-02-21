<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Tarif;
use App\Subscription;

class SiteController extends Controller
{
    public function show(Request $request)
    {
        //Получаем тарифы
        $tarifs = Tarif::all();
        //Получаем абонементы
        $subscriptions = Subscription::all();

        return view('layouts.site', ['tarifs' => $tarifs, 'subscriptions' => $subscriptions]);
    }

    public function save(Request $request)
    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'userlname' => 'required',
                'useremail' => 'email',
                'userphone' => 'required',
                'usertarif' => 'required',
                'usersubscription' => 'required',
            ]);

            if ($validator->fails()) {
                echo "<div style='margin-left:auto;margin-right:auto;font-family: \"ProbaPro\", sans-serif;max-width: 750px;max-height: 60px;margin-bottom: 35px;text-align: center;padding: 10px;border: 1px solid red; color: red;border-radius: 7px;text-align: center;'> Данные не провалидированы</div>";
                return;
            }

            $passUser = Str::random(20);

            $user = User::create([
                'name' => (string)$request->username,
                'lastname' => (string)$request->userlname,
                'phone' => (string)$request->userphone,
                'email' => $request->useremail,
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
                'password' => Hash::make($passUser),
                'tarif_id' => (int)$request->usertarif,
                'subscription_id' => (int)$request->usersubscription,
            ]);

            echo "<script>alert('Данные пользователя успешно добавлены!');</script>";
            return redirect('/');
        }
        echo "Ошибка";
    }
}
