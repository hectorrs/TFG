<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Simulador</title>

        <!-- CSS -->
        <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
        <link rel="stylesheet" href="../resources/css/customHome.css">

        <style type="text/css">
        	.image-upload > input{
			    display: none;
			}
        </style>

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="../resources/img/icon2.ico">

        <!-- Selected language -->
        <?php
	        require_once('../core/language.php');
	        if(!isset($_GET['lang'])){
	        	$lang = 'es';
	        }else{
	        	$lang = $_GET['lang'];
	        }
	    ?>

	    <!-- JavaScript -->
	    <script type="text/javascript">
	    	var language = <?php echo json_encode($lang); ?>;
	    </script>
	    <script src="../resources/js/checkPreinputS1.js"></script>
    </head>
    <body>
    	<div class="top">
    		<h1><?php echo translate('Biological system 2', $lang); ?></h1>
    	</div>
    
    	<div class="section-container">
	        <div class="container layouts">
	            <div class="row">
	                <div class="col-sm-12 section-description">
	                    <h3><?php echo translate('Select a file', $lang); ?></h3>
	                </div>
	            </div>

	            <div class="row">
	            	<div class="col-sm-3 col-md-3 col-lg-3"></div>

	            	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		            	<form enctype="multipart/form-data" action="../core/uploadFileS2.php?lang=<?php echo $lang; ?>" method="POST">
		            		<div class="image-upload">
							    <label for="file-input">
							        <img src="../resources/img/loadFile.png"/>
							    </label>

							    <input id="file-input" name="uploadFile" type="file" />
							</div>

							<div class="row">
								<div class="col-xs-2 col-sm-3 col-md-3 col-lg-3"></div>

								<div class="col-xs-8 col-sm-6 col-md-6 col-lg-6">
									<input type="submit" class="btn btn-info btn-block" name="btnLoadFile" value="Aceptar">
								</div>

								<div class="col-xs-2 col-sm-3 col-md-3 col-lg-3"></div>
							</div>

						</form>
	            	</div>

	            	<div class="col-sm-3 col-md-3 col-lg-3"></div>
	            </div>
	        </div>
        </div>
    </body>
</html>