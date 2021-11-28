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
     * @param string $message  Le contenu du courrier
     * @param string $replay L'adresse email de reponse par defaut "contact@usalvaget.com"
     * @return mail();
     */
    public function envoieMail(string $destination, string $sujet, string $message, string $replay = "contact@usalvaget.com")
    {
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
