<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Rest;
use App\Models\User;
use Carbon\Carbon;

class AtteController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $dt = new Carbon();
        $attendance = Attendance::where('user_id',$user->id)->where('work_day', $dt -> format('Y-m-d')) ->latest('id') -> first();
        
        //ログイン時エラーになる。attendanceがないから？ログイン後attendanceテーブルが作成された後にコメントアウトを外すとエラーは出ない。
        $rest = Null;
        if(isset($attendance))
        $rest = Rest::where('attendance_id', $attendance -> id) -> latest('id') -> first();
    
        
        $clockout = false;
        //ログイン時エラーになる。25~27をコメントアウトしてログインし、勤務開始を押した後にコメントアウトを外すと正常に退勤が押せる。
        if(isset($attendance) && $attendance -> clock_out == Null){
            $clockout = true;
        }

        $restend = false;
        if(isset($rest) && $rest -> rest_end == Null){
            $restend = true;
        }

        $clockin = true;
        if(isset($attendance) && $attendance -> clock_out != Null){
            $clockin = false;
        }

        $param = ['user' => $user, 'clock_out' => $clockout, 'rest_end' => $restend, 'clock_in' => $clockin];
        return view('stamp', $param);
    }

    public function clockin(Request $request)
    {
        $form = new Attendance();
        $user = Auth::user();
        //$form = ['user_id' => $user -> id,];
        $created_at = $request -> created_at;
        $dt = new Carbon();
        $form = ['user_id' => $user -> id, 'work_day' => $dt -> format('Y-m-d')];
        Attendance::create($form);
        return redirect('/');
    }

    public function clockout(Request $request)
    {
        //$form = $request -> all();
        //$form = $request -> id;
        $user = Auth::user();
        $updated_at = $request -> updated_at;
        $dt = new Carbon();
        $form = ['clock_out' => $dt -> format('Y-m-d H:i:s')];
        Attendance::where('user_id',$user->id)->where('work_day', $dt -> format('Y-m-d')) ->latest('id') -> first() -> update($form);
        return redirect('/');
    }

    public function reststart(Request $request)
    {
        $form = new Rest();
        //$attendance = Attendance::id();
        $user = Auth::user();
        $dt = new Carbon();
        $attendance = Attendance::where('user_id',$user->id)->where('work_day', $dt -> format('Y-m-d')) -> latest('id') -> first();
        $form = ['attendance_id' => $attendance -> id];
        Rest::create($form);
        return redirect('/');
    }

    public function restend(Request $request)
    {
        $user = Auth::user();
        $updated_at = $request -> updated_at;
        $dt = new Carbon();
        $form = ['rest_end' => $dt -> format('Y-m-d H:i:s')];
        $attendance = Attendance::where('user_id',$user->id)->where('work_day', $dt -> format('Y-m-d')) -> latest('id') -> first();
        //Rest::where('attendance_id' -> $attendance -> id) -> latest('id') ->update($form);
        Rest::where('attendance_id', $attendance -> id) -> latest('id') -> first() -> update($form);
        return redirect('/');
        //最新のレコード、休憩は何回もあるので

        //ユーザー、出勤日、休憩

    }

    public function search(Request $request)
    {
        //$pages = Attendance::Paginate(5);
        $user = Auth::user();
        $attendances = Attendance::Paginate(5);

        $rests = Rest::all();
        //ここから出勤時間の計算
        foreach($attendances as $attendance){
            $clock_in = $attendance -> clock_in;
            $clock_out = $attendance -> clock_out;
            $carbon1 = New Carbon($clock_in);
            $carbon2 = New Carbon($clock_out);
            $times = $carbon2->diffInSeconds($carbon1);
            $hours = floor($times / 3600);
            $minutes = floor(($times / 60) % 60);
            $seconds = $times % 60;
            $dt = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
            $attendance -> dt = $dt;
            $rests = Rest::where('attendance_id', $attendance -> id) -> get();
            $rest_times = 0;
            foreach($rests as $rest){
            $rest_start = $rest -> rest_start;
            $rest_end = $rest -> rest_end;
            $carbon3 = New Carbon($rest_start);
            $carbon4 = New Carbon($rest_end);
            $rest_time = $carbon4 -> diffInSeconds($carbon3);
            $rest_times = $rest_times + $rest_time;
        }
            $hours = floor($rest_times / 3600);
            $minutes = floor(($rest_times / 60) % 60);
            $seconds = $rest_times % 60;
            $rest_dt = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
            $attendance -> rest_dt = $rest_dt;
        }
        $param = ['attendances' => $attendances, 'user' => $user];
        return view('list', $param);
    }
}


//アテンダンスのidに紐づいた休憩時間を計算、出勤時間を計算
//controllerでforeach

//foreach($attendances as $attendance){

//$attendance->id に紐づいた休憩時間の合計を出す

//出勤時間を計算する

//}
