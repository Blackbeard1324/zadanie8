<?php

require_once 'core/Config.class.php';
$conf = new core\Config();
require_once 'config.php'; //ustaw konfigurację

function &getConf(){ global $conf; return $conf; }

//załaduj definicję klasy Messages i stwórz obiekt
require_once 'core/Messages.class.php';
$msgs = new core\Messages();

function &getMessages(){ global $msgs; return $msgs; }

//przygotuj Smarty, twórz tylko raz - wtedy kiedy potrzeba
$smarty = null;	
function &getSmarty(){
	global $smarty;
	if (!isset($smarty)){
		//stwórz Smarty
		include_once 'lib/smarty/Smarty.class.php';
		$smarty = new Smarty();	
		//przypisz konfigurację i messages
		$smarty->assign('conf',getConf());
		$smarty->assign('msgs',getMessages());
		//zdefiniuj lokalizację widoków (aby nie podawać ścieżek przy odwoływaniu do nich)
		$smarty->setTemplateDir(array(
			'one' => getConf()->root_path.'/app/views',
			'two' => getConf()->root_path.'/app/views/templates'
		));
	}
	return $smarty;
}
$db = null; //przygotuj Medoo, twórz tylko raz - wtedy kiedy potrzeba
function &getDB() {
    global $conf, $db;
    if (!isset($db)) {
        require_once 'medoo/Medoo.class.php';
        $db = new \Medoo\Medoo([
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
    }
    return $db;
}

require_once 'core/ClassLoader.class.php'; //załaduj i stwórz loader klas
$cloader = new core\ClassLoader();
function &getLoader() {
    global $cloader;
    return $cloader;
}

require_once 'core/Router.class.php';
$router = new core\Router();
function &getRouter(): core\Router {
    global $router; return $router;
}

require_once 'core/functions.php';

session_start(); //uruchom lub kontynuuj sesję
$conf->roles = isset($_SESSION['_roles']) ? unserialize($_SESSION['_roles']) : array(); //wczytaj role

$action = getFromRequest('action');