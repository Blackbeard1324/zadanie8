<?php


namespace app\controllers;

use app\Transfer\User;
use app\Forms\LoginForm;

class ResultsCtrl
{
    private $results;
    private $database;

    public function __construct() {

    }

    public function getParams(){
        try{
            $database = getDB();
            $this->results=$database->select("results", "*");



        }catch(\PDOException $ex){
            getMessages()->addError($ex->getMessage());
        }


    }

    public function action_results(){
        $this->getParams();
        $this->generateView();
    }



    public function validate(){
        return !getMessages()->isError();

    }

    public function generateView(){
        getSmarty()->assign('action_root', getConfig()->action_root);
        getSmarty()->assign('action_url',  getConfig()->action_url);
        getSmarty()->assign('app_url',getConfig()->app_url);
        getSmarty()->assign('root_path',getConfig()->root_path);
        getSmarty()->assign('approot',getConfig()->app_root);


        getSmarty()->assign("results", $this->results);

        getSmarty()->display('ResultsView.tpl');
    }
}