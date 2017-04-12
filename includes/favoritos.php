<?php 
require_once('session.php');
switch ($_POST["tipo"]) {
	case "ADD":
		$_SESSION[$_POST["id"]]['id'] = $_POST["id"];
		$_SESSION[$_POST["id"]]['img'] = $_POST["img"];
		$_SESSION[$_POST["id"]]['title'] = $_POST["title"];
		$_SESSION["favorito"]=1;
		echo 1;
		break;

	case "REMOVE":
		unset($_SESSION[$_POST["id"]]['id']);
		unset($_SESSION[$_POST["id"]]['img']);
		unset($_SESSION[$_POST["id"]]['title']);
		echo 1;
		break;
	case "EXIBE":
		foreach ($_SESSION as $value) {	
			if($value['id']!=''){		
				echo "<div class='col-md-3 ".$value['id']."'><div class='minimagem'><span class='glyphicon glyphicon-remove add' onclick='removeFavoritos(this)' data-id='".$value['id']."' data-img='".$value['img']."' data-title='".$value['title']."' aria-hidden='true' data-toggle='tooltip' title='Remover dos favoritos'></span><img src='".$value['img']."' alt='".$value['title']."' class='wight100'></div><h5 class='center'>".$value['title']."</h5></div>";
			}
		}
		
		break;		
}
?>