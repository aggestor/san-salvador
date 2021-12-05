<?php

namespace Root\App\Controllers;

class Controller
{
    public function view(string $path, string $template = 'layouts', array $params = null)
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
     * La fonction pour generer les ids des utilisateurs
     * @param integer $length
     * @return int
     */
    public function generate_id(int $length)
    {
        $alphabet = "1234567890";
        return (int) substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

    public function envoieMail(string $to, string $sujet, string $message)
    {
        $headers = 'From:amaninyumu1@gmail.com' . "\r\n" .
            'Reply-To:amaninyumu1@gmail.com' . "\r\n" .
            'X-Mailer:PHP/' . phpversion();
        return mail($to, $sujet, $message, $headers);
    }
}
