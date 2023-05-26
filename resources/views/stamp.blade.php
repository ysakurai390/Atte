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

    .wrapper{
      width:100%;
      height:78%;
      padding-top:2%;
      display:inline-block;
      background-color:#f4f5f5;
    }

    .user-name{
      text-align:center;
      font-size:16px;
      padding-bottom:2%;
    }

    .attendance{
      display:flex;
      justify-content:center;
      padding-bottom:3%;
    }

    .botton-clockin{
      border: none;
      width:450px;
      height:180px;
      font-size:14px;
      text-decoration: none;
      background-color: #fff;
      cursor: pointer;
      outline: none;
      margin-left:-5%;
    }

    .botton-clockout{
      border: none;
      width:450px;
      height:180px;
      font-size:14px;
      text-decoration: none;
      background-color: #fff;
      cursor: pointer;
      outline: none;
      margin-left:5%;
    }

    .rest{
      display:flex;
      justify-content:center;
      padding-bottom:12%;
    }

    .botton-reststart{
      border: none;
      width:450px;
      height:180px;
      font-size:14px;
      text-decoration: none;
      background-color: #fff;
      cursor: pointer;
      outline: none;
      margin-left:-5%;
    }

    .botton-restend{
      border: none;
      width:450px;
      height:180px;
      font-size:14px;
      text-decoration: none;
      background-color: #fff;
      cursor: pointer;
      outline: none;
      margin-left:5%;
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
    </div>

    <div class="wrapper">
      <p class="user-name">{{$user->name}}さんお疲れ様です！</p>
      <div class="attendance">
        <form action="/stamp/clockin" method="post"><!-- clockin -->
          @csrf
          @if($clock_out)
          <input class="botton-clockin" type=submit value="勤務開始"  disabled>
          @else
          <input class="botton-clockin" type=submit value="勤務開始">
          @endif
        </form>
        <form action="/stamp/clockout" method="post"><!-- clockuot -->
          @csrf
          @if($clock_out)
          <input class="botton-clockout" type=submit value="勤務終了">
          @else
          <input class="botton-clockout" type=submit value="勤務終了" disabled>
          @endif
        </form>
      </div>
      <div class="rest">
        <form action="/stamp/reststart" method="post"><!-- reststart -->
          @csrf
          @if(!$rest_end)
            @if($clock_in)
            <input class="botton-reststart" type=submit value="休憩開始">
            @else
            <input class="botton-reststart" type=submit value="休憩開始" disabled>
            @endif
          @else
          <input class="botton-reststart" type=submit value="休憩開始" disabled>
          @endif
        </form>
        <form action="/stamp/restend" method="post"><!-- restend -->
          @csrf
          @if($rest_end)
          <input class="botton-restend" type=submit value="休憩終了">
          @else
          <input class="botton-restend" type=submit value="休憩終了" disabled>
          @endif
        </form>
      </div><!-- rest -->
    </div><!-- wrapper -->
    <div class="footer">
      <small>Atte, inc.</small>
    </div>
  </div><!-- container -->

<!--<script src="{{ asset('js/main.js') }}"></script>-->
</body>
</html>