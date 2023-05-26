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

    .register_card{
        width:100%;
        height:78%;
        background-color:#f4f5f5;
        text-align:center;
        padding-top:50px;
    }

    .input_name{
        width:30%;
        height:6%;
        margin-bottom:25px;
        border-radius: 5px;
        border:solid 1px grey;
    }

    .input_email{
        width:30%;
        height:6%;
        margin-bottom:25px;
        border-radius: 5px;
        border:solid 1px grey;
    }

    .input_password{
        width:30%;
        height:6%;
        margin-bottom:25px;
        border-radius: 5px;
        border:solid 1px grey;
    }

    .confirm_password{
        width:30%;
        height:6%;
        margin-bottom:25px;
        border-radius: 5px;
        border:solid 1px grey;
    }

    .register_bottom{
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

    .registered{

    }

    .registered_text{
        color:grey;
    }

    .registered_button{
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

    .title{
        font-size:20px;
        margin-bottom:25px;
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

        

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="register_card">
        <div class="title">会員登録</div>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input id="name" placeholder="名前" class="input_name" type="text" name="name" :value="old('Name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input id="email" placeholder="メールアドレス" class="input_email" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input id="password" placeholder="パスワード" class="input_password"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input id="password_confirmation" placeholder="確認用パスワード" class="confirm_password"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <!-- Register -->
            <x-button class="register_bottom">
                    {{ __('会員登録') }}
            </x-button>
        </form>

        <!-- Already registered -->
        <div class="registered">
            <a class="registered_text">アカウントをお持ちの方はこちらから</a><br>
            <a href="/login" class="registered_button">ログイン</a>
        </div>
        </div>
    </x-auth-card>
    <!-- footer -->
        <div class="footer">
            <small>Atte, inc.</small>
        </div>
</x-guest-layout>
