<?php
	if(!isset($_GET['lang'])){
    	$lang = 'es';
    }else{
    	$lang = $_GET['lang'];
    }

	$dirUpload = '../resources/conf/';
	$uploadedFile = $dirUpload . 'settings.json';
	$name = $_FILES['uploadFile']['name'];

	$info = new SplFileInfo($_FILES['uploadFile']['name']);
	if($info->getExtension() == 'json'){
		if(move_uploaded_file($_FILES['uploadFile']['tmp_name'], $uploadedFile)){
		    header('Location: ../view/inputS2.php?lang=' . $lang);
		}else{
		    header('Location: ../view/uploadS2.php?lang=' . $lang);
		}
	}else{
	    header('Location: ../view/uploadS2.php?lang=' . $lang);
	}
?>