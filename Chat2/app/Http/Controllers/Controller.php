<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input as Input;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function welcome()
    {
        $isSignin = false;
        $rooms = DB::table('Rooms')->get();
        return view('welcome', compact('isSignin','rooms'));
    }

    public function signin(Request $req)
    {
        $name = $req->input('name');
        $psw = $req->input('psw');

        $data = array('Name' => $name,'Password' => $psw);

        DB::table('people')->insert($data);

        $rooms = DB::table('Rooms')->get();
        $isSignin = true;
        return view('welcome', compact('isSignin', 'rooms'));
    }

    public function addRoom(Request $req)
    {
        $rname = $req->input('name');
        $ispublic = $req->input('publicOrPrivate');

        $data = array('name' => $rname,'IsPublic' => $ispublic);
        DB::table('Rooms')->insert($data);

        $rooms = DB::table('Rooms')->get();

        $isSignin = true;
        return view("welcome", compact('isSignin', 'rooms'));
    }

    public function chatRoom($id)
    {
        $myid = $id;
        $RoomMessages = DB::table('Messages')->where('RoomId', $myid)->get();
        return view("chat", compact('RoomMessages','myid'));
    }

    public function addMessage(Request $req)
    {
        $sendData = $req->all();
        $name =  $sendData['author'];
        $msg =  $sendData['message'];
        $id = $sendData['id'];
        $data = array('Name' => $name, 'Message' => $msg, 'RoomId' => $id);
        DB::table('messages')->insert($data);
    }
}
