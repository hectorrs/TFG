/**
 * It checks the language selected
 */
function checkLanguage(){
	var language = location.search.substring(6);
	console.log(language);

	if(language != 'es' && language != 'ga' && language != 'en'){
		language = 'es';
	}

	document.getElementById('s1').href = 'preinputS1.php?lang=' + language;
	document.getElementById('s2').href = 'preinputS2.php?lang=' + language;
}

/**
 * It reloads home's language
 */
function reloadLanguage(language){
	location.href = 'home.php?lang=' + language;
}