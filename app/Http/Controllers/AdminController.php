<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\Tarif;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function show(Request $request)
    {
        return view('layouts.admin');
    }

    public function getusers(Request $request)
    {
        User::chunk(200, function ($users) {
            echo "<table border=\"1\" align='center' >";
            echo "<style>
                    table {
                     width: 100%; /* Ширина таблицы */
                     background: white; /* Цвет фона таблицы */
                     color: maroon; /* Цвет текста */
                     border-spacing: 1px; /* Расстояние между ячейками */
                    }
                    td, th {
                     background: #a0cede; /* Цвет фона ячеек */
                     padding: 5px; /* Поля вокруг текста */
                    }
                  </style>";
                echo "<tr>";
                    echo "<th>Клиент</th>";
                    echo "<th>E-mail клиента</th>";
                    echo "<th>Телефон клиента</th>";
                    echo "<th>Действие</th>";
                    echo "<th>Фото</th>";
                echo "</tr>";
            foreach ($users as $user) {
                echo "<tr>";
                    echo "<td>" . $user->lastname . " " . $user->name . "</td>";
                    echo "<td>" . $user->email . "</td>";
                    echo "<td>" . $user->phone . "</td>";
                    echo "<td> <a href='" . url("/admin/edituser/") . "/" . $user->id . "'>Редактировать</a> </td>";
                    if (isset($user->photo) && !empty($user->photo)) {
                        echo "<td> <a target='_blank' href='" . $user->photo . "'>Фото</a></td>";
                    } else {
                        echo "<td>Фото отсутствует</td>";
                    }
                echo "</tr>";
            }
            echo "</table>";
        });
        return;
    }

    public function edituser(Request $request, $id)
    {
        //Получаем тарифы
        $tarifs = Tarif::all();
        //Получаем абонементы
        $subscriptions = Subscription::all();
        //Данные юзера по которому обновляем информацию
        $user = User::find($id);

        return view('layouts.adminedituser', ['tarifs' => $tarifs, 'subscriptions' => $subscriptions, 'user' => $user]);
    }

    public function update(Request $request)
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

            //Обновляем пользователя
            User::where('id', $request->userid)
                ->update([
                    'name' => (string)$request->username,
                    'lastname' => (string)$request->userlname,
                    'phone' => (string)$request->userphone,
                    'email' => $request->useremail,
                    'tarif_id' => (int)$request->usertarif,
                    'subscription_id' => (int)$request->usersubscription,
                ]);

            echo "<script>alert('Данные пользователя успешно обновлены!');</script>";
            return redirect()->route('adminshow');
        }
        echo "Ошибка";
    }
}
