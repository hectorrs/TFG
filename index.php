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
				return 'en';
				break;
		}
	}

	window.location.href = "view/home.php?lang=" + getLanguage();
</script>