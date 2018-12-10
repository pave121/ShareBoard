<?php

//load config
require_once 'Config/config.php';

//helper functions
require_once 'Helpers/url_helper.php';
require_once 'Helpers/session_helper.php';
require_once 'Helpers/format_output.php';
//require_once 'Helpers/format_input.php';

//require libraries, config, helpers...
//require_once 'Libraries/Core.php';
//require_once 'Libraries/Controller.php';
//require_once 'Libraries/Database.php';

//Autoload Core libraries
spl_autoload_register(function($className){
    
    require_once 'Libraries/' . $className . '.php';
});
