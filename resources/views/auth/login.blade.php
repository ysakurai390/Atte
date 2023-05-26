<style>
    .header{
        font-size:24px;
        height:7%;
        display:block;
        position:relative;
        width:100%;
        height:10%;
        
    }

    .logo {
        position:absolute;
        top:25%;
        left:2%;
    }
    .title{
        font-size:20px;
        margin-bottom:25px;
    }

    .login{
        width:100%;
        height:78%;
        background-color:#f4f5f5;
        text-align:center;
        padding-top:50px;
    }

    body {
        margin:0px;
    }

    .email{
        width:30%;
        height:6%;
        margin-bottom:25px;
        border-radius: 5px;
        border:solid 1px grey;
    }

    .password{
        width:30%;
        height:6%;
        margin-bottom:25px;
        border-radius: 3px;
        border:solid 1px grey;
    }

    .ml-3{
        width:30%;
        height:6%;
        background-color:#3d58f0;
        color:white;
        font-size:12px;
        margin-bottom:25px;
        border-radius: 3px;
        cursor: pointer;
        border:none;
    }

    .no-account_text{
        color:grey;
    }

    .no-account_button{
        text-decoration:none;
        border-radius: 5px;
        cursor: pointer;
    }

    .footer{
        height:auto;
        text-align:center;
        font-size:14px;
        padding-top:16px;
    }

</style>

<x-guest-layout>
    <x-auth-card>
        <!-- header -->
        <header class="header">
            <a class="logo">Atte</a>
        </header>

        <!--<x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>-->

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="login">
            <div class="title">ログイン</div>
            <form method="POST" action="{{ route('login') }}" class="login_form">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email"/>

                <input class="email" placeholder="メールアドレス" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password"/>

                <input class="password" placeholder="パスワード" id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            

            <div class="flex items-center justify-end mt-4">
                

                <x-button class="ml-3">
                    {{ __('ログイン') }}
                </x-button>
            </div>
            </form>
            <div class="no-account">
            <a class="no-account_text">アカウントをお持ちでない方はこちら</a><br>
            <a href="/register" class="no-account_button">会員登録</a>
            </div>
        </div>
    </x-auth-card>
    <!-- footer -->
        <div class="footer">
            <small>Atte, inc.</small>
        </div>
</x-guest-layout>
