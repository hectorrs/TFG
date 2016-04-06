/**
 * It checks the language selected
 */
function checkLanguage(){
	document.getElementById('file').href = 'uploadS1.php?lang=' + language;
	document.getElementById('settings').href = 'inputS1.php?lang=' + language;
}