<!DOCTYPE html>
<html lang="jp">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body{
      margin:0px;
      width:100%;
      height:100%;
    }
    .container{
      width:100%;
    }
    .header{
      display:flex;
      width:100%;
      height:10%; 
      justify-content:space-between;
      padding-top:1%;
      padding-bottom:1%;
    }
    .title{
      font-size:24px;
      padding-left:3%;
    }
    .link{
      display:flex;
      font-size:14px;
      padding-right:30px;
    }
    .link_home{
      display: inline-block;
      border: none;
      font-size:14px;
      text-decoration: none;
      background-color: #fff;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.4s;
      outline: none;
      padding-right:30px;
    }

    .link_date{
      display: inline-block;
      border: none;
      font-size:14px;
      text-decoration: none;
      background-color: #fff;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.4s;
      outline: none;
      padding-right:30px;
    }

    .botton-logout{
      display: inline-block;
      border: none;
      font-size:14px;
      text-decoration: none;
      background-color: #fff;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.4s;
      outline: none;
    }

    .list{
      background-color:#f4f5f5;
    }


    table{
      width:90%;
      justify-content:space-between;
      margin-left:20px;
      margin:0 auto;
      border-collapse: collapse;
    }

    th{
      border-top: 1px solid #333;
    }

    td{
      border-top: 1px solid #333;
    }

    svg.w-5.h-5{
      width:30px;
      height:30px;
      display: flex;
      align-items: center;
      border: solid 1px #111;
    }
    .footer{
      height:auto;
      text-align:center;
      font-size:14px;
      padding-top:6px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <div class="title">Atte</div>
      <div class="link">
        <form action="/" method="get">
          @csrf
          <input class="link_home" type=submit value="ホーム">
        </form>
        <form action="/attendance" method="get">
          @csrf
          <input class="link_date" type=submit value="日付一覧">
        </form>
        <form action="/logout" method="post">
          @csrf
          <input class="botton-logout" type=submit value="ログアウト">
        </form>
      </div>
    </div><!-- header -->

    <div class="list">
    <table>
      <tr>
        <th>名前</th>
        <th>勤務開始</th>
        <th>勤務終了</th>
        <th>休憩時間</th>
        <th>勤務時間</th>
      </tr>
      @if (isset($attendances, $user))
      @foreach($attendances as $attendance)
      <tr>
        <td>{{$user->name}}</td>
        <td>{{$attendance->clock_in->format('H:i:s')}}</td>

        <td>
          @if(isset($attendance -> clock_out))
          {{$attendance->clock_out->format('H:i:s')}}
          @endif
        </td>
        

        <td>
          @if(isset($attendance -> rest_dt))
          {{$attendance -> rest_dt}}
          @endif
        </td>
        
        <td>{{$attendance -> dt}}</td><!-- 計算できない、型が違う？ -->
  
      </tr>
      @endforeach
      @endif

    </table>
    {{$attendances->links()}}
  </div>
  <div class="footer">
    <small>Atte, inc.</small>
  </div>
  </div><!-- container -->
</body>
</html>