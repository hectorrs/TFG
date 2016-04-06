<?php
	// Delete settings file
	if(file_exists('resources/conf/settings.json')){
		unlink('resources/conf/settings.json');
	}
?>

<script type="text/javascript">
	function getLanguage(){
		language = navigator.language;
		switch(language){
			case 'es':
				return 'es';
				break;
			case 'ga':
				return 'ga';
				break;
			case 'en':
				return 'en';
				break;
			default:
				return 'es';
				break;
		}
	}

	window.location.href = "view/home.php?lang=" + getLanguage();
</script>