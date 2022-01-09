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
        
    </style>
</head>

<body>
    <div class="parent">
        <div class="child-1">
            <h1>Usalvagetrade</h1>
            <div class="child">
                <h3 class="text-semi-white">Merci pour votre inscription !!!</h3>
                <p class="text-exp">Salut <strong><?= $nom ?></strong>, merci pour votre inscription sur <strong>usalvagetrade</strong> .</p>
                <p class="text-exp">Vous êtes à la finalisation de la création de votre compte. Vous recevez ce mail enfin d'activer votre compte et de nous confirmer que ce mail est bien le votre.</p>
                <p>
                <p class="text-exp">Cliquer sur le bouton ci-bas, pour finaliser !</p>
                <p class="p-btn">
                    <a class="button" href='<?php echo $lien ?>'>Activer votre compte</a>
                </p>
                <p class="text-exp">Bienvenu(e) sur notre plateforme. <br> L'équipe <a class="link" href="https://usalvagetrade.com">USALVAGETRADE Inc.</a> </p>
                <p>

            </div>
        </div>
        <div class="child-2">
            <img src="https://usalvagetrade.com/assets/logos/mail.png" alt="Mail Illustration">
        </div>
        
    </div>
</body>

</html>