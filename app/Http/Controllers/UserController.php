<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Notifications\SendSms;
use Notification;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create(Request $request)
    {
        # o disparo de sms para a versão trial tem que ser o mesmo numero de telefone

        $data = $request->all();

//        dd($request->tel);

//        Notification::route('nexmo', '5511930636369')->notify(new SendSms($data));

       $result = $this->user->create($data);


       $not = $this->user->find($result->id);
//       dd((object)$not);
        Notification::send($result, new SendSms($data));
        return response()->json(['success' => 'Registro criado com sucesso']);
    }
}
