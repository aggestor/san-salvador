<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <style>
        *{
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            width: 100vw; background-color: #020613;
            overflow: hidden;
        }
        .parent{
            height: 70% ;
            width: 70%;
            display: flex;  
            background: #262c3054;
            border-radius: 10px;   
            padding: 20px;
        }
        .parent h1{
            color: #39e293;
        }
        .text-semi-white{
            color: #f0f8ff;
        }
        .text-exp{
            color: #a5a5a5;
        }
        .child-1, .child-2{
            width: 50%;
            display: flex;
            flex-direction: column;
        }
        .link{
            color:#2c4bff;
            text-decoration: none;
            font-weight: 500;
        }
        .button{
            background: #2c4bff;
            padding: 10px 20px;
            color: white;
            border-radius: 20px;
            font-weight: 500;
            text-decoration: none;
        }
        .p-btn{
             margin: 30px 0;
        }
         @media (max-width:992px) {
             .parent{
                height: auto ;
                width: 70%;
                display: flex;  

                background: #262c3054;
                border-radius: 10px;   
                padding: 20px;
            }
            .child-2{
                display: hidden;
            }
         }
         .my-2{
             margin: 10px 0;
         }
        
    </style>
</head>

<body>
    <div class="parent">
        <div class="child-1">
            <h1>Usalvagetrade</h1>
            <div class="child">
                <h3 class="text-semi-white">Reinitialisation du mot de passe !!!</h3>
                <p class="text-exp">
                    Salut <strong><?= $nom ?></strong>, vous nous avez demander une reinitialisation du mot de passe .</p>
                <p class="text-exp">Si vous avez vraiment fait cette demande, cliquer sur le bouton ci-bas, pour choisir un nouveau mot de passe !</p>
                <p class="p-btn">
                    <a class="button" href='<?php echo $lien ?>'>Choisir un nouveau mot de passe</a>
                </p>
                <small class="text-exp my-2"><b>Note : </b>  Si vous n'avez pas fait une demande de reinitialisation de mot passe, vous pouvez ignorer ce mail, votre mot passe ne changera pas.</small>
                <p class="text-exp">Merci. <br> L'équipe <a class="link" href="https://usalvagetrade.com">USALVAGETRADE Inc.</a> </p>

            </div>
        </div>
        <div class="child-2">
            <img src="https://usalvagetrade.com/assets/logos/reset-pwd.png" alt="Reset Password Illustration">
        </div>
        
    </div>
</body>

</html>