<?php
	if(!isset($_GET['lang'])){
    	$lang = 'es';
    }else{
    	$lang = $_GET['lang'];
    }

    session_start();

    $sessionId = session_id();

    session_write_close();

	$dirUpload = '../resources/conf/';
	$uploadedFile = $dirUpload . 'settings.json';
	$name = $_FILES['uploadFile']['name'];

	if(move_uploaded_file($_FILES['uploadFile']['tmp_name'], $uploadedFile)){
	    header('Location: ../view/inputS1.php?lang=' . $lang);
	}else{
	    header('Location: ../view/uploadS1.php?lang=' . $lang);
	}
?>