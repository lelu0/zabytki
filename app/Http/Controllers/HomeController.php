<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\Moderation;
use App\Monument;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard($mode = '1')
    {
        $user = auth()->user();

        return view('dashboard')->with('mode', $mode)->with('user', $user)->with('moderation', Moderation::where(array('status' => 0)))->with('toConfirm', Monument::where(array('confirmed' => 0)));
    }

    public function msgForm($id)
    {
        return view('home.msgform')->with('user', User::find($id));
    }

    public function send(Request $request, $id)
    {
        $this->validate($request, [
            'topic' => 'required|string|max:190',
            'content' => 'required|string',
        ]);

        $msg = new Message();
        $msg->topic = $request->topic;
        $msg->content = $request->content;
        $msg->sender_id = auth()->user()->id;
        $msg->user_id = $id;
        $msg->save();

        return redirect()->action('HomeController@dashboard');
    }

    public function moderate($id)
    {
        $moderation = new Moderation();
        $moderation->monument_id = $id;
        $moderation->user_id = auth()->user()->id;
        $moderation->status = 0;
        $moderation->save();

        return view('home.thankyou');
    }

    public function moderateDone($id)
    {
        $moderation = Moderation::find($id);
        $moderation->delete();

        return redirect()->action('HomeController@dashboard');
    }
}
