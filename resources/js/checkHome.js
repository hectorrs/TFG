/**
 * It checks the language selected
 */
function checkLanguage(){
	if(document.getElementById('language').value == 'select'){
		document.getElementById('s1').href = 'preinputS1.php?lang=' + language;
		document.getElementById('s2').href = 'preinputS2.php?lang=' + language;
	}else{
		language = document.getElementById('language').value;
    	document.getElementById('s1').href = 'preinputS1.php?lang=' + language;
    	document.getElementById('s2').href = 'preinputS2.php?lang=' + language;
	}
}