<?php

namespace app\controllers;

use app\forms\CalcForm;
use app\transfer\CalcResult;

class CalcCtrl
{

    private $form;
    private $result;

    public function __construct()
    {
        $this->form = new CalcForm();
        $this->result = new CalcResult();
    }

    public function action_calcCompute()
    {

        $this->getParams();

        if ($this->validate()) {

            $this->form->kwota = floatval($this->form->kwota);
            $this->form->lata = intval($this->form->lata);
            $this->form->procent = floatval($this->form->procent);
            getMessages()->addInfo('Parametry poprawne.');

            $this->result->rata = $this->form->kwota / ($this->form->lata * 12);
            $this->result->result = $this->result->rata + ($this->result->rata * ($this->form->procent / 100));
            $this->generateView();
        }
        try{

            $database = new \Medoo\Medoo([
                'database_type' => 'mysql',
                'database_name' => 'kalkulator',
                'server' => 'localhost',
                'username' => 'root',
                'password' => '',

                'charset' => 'utf8',
                'collation' => 'utf8_polish_ci',
                'port' => 3306,

                'option' => [
                    \PDO::ATTR_CASE => \PDO::CASE_NATURAL,
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                ],
            ]);

            $database->insert("rata", [
                "kwota" => $this->form->kwota,
                "lata"   => $this->form->lata,
                "procent" => $this->form->procent,
                "rata"    => $this->result->result,
                "data"    => date("Y-m-d H:i:s")
            ]);

        }catch(\PDOException $ex){
            getMessages()->addError($ex->getMessage());
        }

        $this->generateView();
    }

    public function action_calcShow()
    {
        getMessages()->addInfo('Witaj w kalkulatorze');
        $this->generateView();
    }

    public function getParams()
    {
        $this->form->kwota = getFromRequest('kwota');
        $this->form->lata = getFromRequest('lata');
        $this->form->procent = getFromRequest('procent');
    }

    public function validate()
    {

        if (!(isset($this->form->kwota) && isset($this->form->lata) && isset($this->form->procent))) {

            return false;
        }

        if ($this->form->kwota == "") {
            getMessages()->addError('Nie podano kwoty pożyczki');
        }
        if ($this->form->lata == "") {
            getMessages()->addError('Nie podano lat spłacania pożyczki');
        }
        if ($this->form->procent == "") {
            getMessages()->addError('Nie podano procentu kredytu');
        }

        if (!getMessages()->isError()) {

            if (!is_numeric($this->form->kwota)) {
                getMessages()->addError('Kwota nie jest liczbą całkowitą');
            }

            if (!is_numeric($this->form->lata)) {
                getMessages()->addError('Podany okres czasu nie jest liczbą całkowitą');
            }
            if (!is_numeric($this->form->procent)) {
                getMessages()->addError('Podane oprocentowanie nie jest liczbą całkowitą');
            }
        }
        if (getMessages()->isError()) return false;
        return true;
    }

    public function generateView()
    {

        getSmarty()->assign('user', unserialize($_SESSION['user']));

        getSmarty()->assign('page_title', 'Kalkulator z bazą danych');
        getSmarty()->assign('result',$this->result->result);
        getSmarty()->assign('kwota',$this->form->kwota);
        getSmarty()->assign('lata',$this->form->lata);
        getSmarty()->assign('oprocentowanie',$this->form->procent);


        getSmarty()->assign('form', $this->form);
        getSmarty()->assign('res', $this->result);
        getSmarty()->display('CalcView.tpl');
    }
}
