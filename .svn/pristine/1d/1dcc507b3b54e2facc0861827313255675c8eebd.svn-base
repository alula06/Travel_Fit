<?php
if(isset($_SERVER['REDIRECT_USER'])){
    $user = $_SERVER['REDIRECT_USER'];
} else {
    $uri = explode('/', $_SERVER['REQUEST_URI']);
    $user = str_replace('~', '', $uri[1]);
} 

$database = 'student_'.$user;
$username = $user;

switch($user){
    case 'odrule':
        $password = 'owllydb';
        break;
    case 'abeshu':
        $password = 'abrbab06';
        break;
    case 'akwok':
        $password = 'dragon12';
        break;
    case 'rmoon':
        $password = 'rob1keymac';
        break;
    case 'kkoval':
        $password = 'nov1789';
        break;
    case 'edinn':
        $password = '';
        break;
}

return array(

	'connections' => array(

		'mysql' => array(
			'host'      => 'localhost',
			'database'  => $database,
			'username'  => $username,
			'password'  => $password,
		),
	),

);
