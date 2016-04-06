/**
 * It checks the language selected
 */
function checkLanguage(){
	document.getElementById('file').href = 'uploadS2.php?lang=' + language;
	document.getElementById('settings').href = 'inputS2.php?lang=' + language;
}