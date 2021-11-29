<?php

namespace Root\App\Controllers;

class Controller
{
    public function view(string $path, array $params = null, string $template = 'layouts')
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
        if ($params) {
            $params = extract($params);
        }
        $content = ob_get_clean();
        require VIEWS . $template . '.php';
    }
    /**
     * La fonction pour envoiyer un mail
     *
     * @param string $destination Le destinataire du courrier
     * @param string $sujet Le sujet de courrier
     * @param string $replay L'adresse email de reponse par defaut "contact@usalvaget.com"
     * @return mail();
     */
    public function envoieMail(string $destination, string $sujet, string $replay = "contact@usalvaget.com")
    {
        $message = '
        <html lang="en" style="box-sizing: border-box;font-family: sans-serif;">
        <head>
          <meta charset="UTF-8">
        </head>
        <body style="margin: 0;padding: 0;color: #fff;">
            <center style="background-color: rgb(24, 188, 156);padding-top: 25px;padding-bottom: 25px;">
              <h1>Usalvagetrade</h1>
            </center>
            <center style="background-color: rgb(44, 62, 80);padding-top: 10px;padding-bottom: 25px;">
              <div style="padding: 20px;width: 94%;">
                <h2>Usalvage</h2>
                <p>
                  Pour confirmer l\'inscription de votre compte sur notre plateforme <br/>
                  Veuillez cliquer sur le lien afficher ci-dessous qui vous redirigerant vers une autre page <br/> 
                </p>
                <a href="<?php echo $lien;?>" style="display: block;color: inherit;text-decoration: none;background-color: rgb(44, 62, 80);">Lien d\'activation</a>
              </div>
            </center>
        </body>
        </html>
        ';
        $header = "NIME Version 1.0 \r\n";
        $header .= "Content-type: text/html; charset=UTF-8\r\n";
        $header .= "From: no-replay@usalvagetrade.com" . "\r\n" . "Replay-To: $replay" . "\r\n" . "X-Mailer: PHP/" . phpversion();
        return mail($destination, $sujet, $message . "\n\n", $header);
    }
    /**
     * La fonction qui genere un code melanger des chiffres entre 0-9
     * @param int $length la longueur du code qui sera generer
     * @return void
     */
    public function str_rendom($length)
    {
        $alphabet = "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
        /*on melange notre variable alphabet avec str_shuffle et on le repette avec le parametre de notre fonction*/
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }
}
