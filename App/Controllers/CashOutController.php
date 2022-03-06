<?php

namespace Root\App\Controllers;

use Root\App\Controllers\Validators\UserValidator;
use Root\App\Models\CashOutModel;
use Root\Core\EnabledCashOut;
use Root\App\Models\ModelFactory;

class CashOutController extends Controller
{

    /**
     * Undocumented variable
     *
     * @var CashOutModel
     */
    private $cashOutModel;
    public function __construct()
    {
        parent::__construct();
        $this->cashOutModel = ModelFactory::getInstance()->getModel('CashOut');
    }

    /**
     * Pour le retrait
     *
     * @return void
     */
    public function cashOut()
    {
        $dateActuelle = getdate();
        if ($this->sessionExist($_SESSION[self::SESSION_USERS])) {
            if (EnabledCashOut::isEnabled($dateActuelle)) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $validator = new UserValidator();
                    $retrait = $validator->cashOutAfterValidation();
                    if ($validator->hasError() || $validator->getMessage() != null) {
                        $errors = $validator->getErrors();
                        return $this->view('pages.user.cashout', 'layout_', ['user' => $this->userObject(), 'errors' => $errors, 'disabled' => true]);
                    } else {
                        $nom = $retrait->getUser()->getName();
                        $mail = $retrait->getUser()->getEmail();
                        $_SESSION['mail'] = $mail;
                        if ($this->envoieMail($mail, "", "Demande de retrait", "pages/mail/cahOutMail", $nom)) {
                            Controller::redirect('/mail/success');
                        }
                    }
                }
                return $this->view('pages.user.cashout', 'layout_', ['user' => $this->userObject(), 'disabled' => true]);
            } else {
                return $this->view('pages.user.cashout', 'layout_', ['user' => $this->userObject(), 'disabled' => false]);
            }
        } else {
            Controller::redirect('/login');
        }
    }
}
