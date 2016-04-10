<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Simulador</title>

        <!-- CSS -->
        <link rel="stylesheet" href="../resources/css/bootstrap.min.css">
        <link rel="stylesheet" href="../resources/css/customHome.css">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="../resources/img/icon2.ico">

        <!-- Selected language -->
        <?php
	        require_once('../core/language.php');
	        $lang = $_GET['lang'];
	    ?>

	    <!-- JavaScript -->
	    <script src="../resources/js/bootstrap.js"></script>
	    
	    <script type="text/javascript">
	    	var language = <?php echo json_encode($lang); ?>;
	    </script>
	    <script src="../resources/js/checkHome.js"></script>
    </head>
    <body>
    	<div class="top">
    		<h1><?php echo translate('Behaviour modeling tool in spatial systems', $lang); ?></h1>
    	</div>
    
    	<div class="section-container">
	        <div class="container layouts">
	            <div class="row">
	                <div class="col-sm-12 section-description">
	                    <h3><?php echo translate('Choose a system', $lang); ?></h3>
	                </div>
	            </div>

	            <div class="row">
	            	<div class="col-sm-10 col-sm-offset-1">
	            		<div class="row">
	            			<div class="col-sm-2 layout-box"></div>

		                	<div class="col-sm-4 layout-box">
			                	<a href="#" id="s1" onclick="return checkLanguage()">
			                		<img src="../resources/img/s1.png" alt="">
			                	</a>
			                	<p><?php echo translate('Biological system 1', $lang); ?></p>
		                    </div>

		                    <div class="col-sm-4 layout-box">
		                    	<a href="#" id="s2" onclick="return checkLanguage()">
				                	<img src="../resources/img/s1.png" alt="">
			                    </a>
			                    <p><?php echo translate('Biological system 2', $lang); ?></p>
		                    </div>

		                    <div class="col-sm-2 layout-box"></div>
	                    </div>
                    </div>
	            </div>

	            <div class="row">
	            	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>

		        	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		        		<img src="../resources/img/es.png" onclick="return reloadLanguage('es')">
		        		<img src="../resources/img/ga.png" onclick="return reloadLanguage('ga')">
		        		<img src="../resources/img/en.png" onclick="return reloadLanguage('en')">
		        	</div>

	            	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
        		</div>
	        </div>
        </div>
        
        <div class="container footer">
            <div class="row">
                <div class="col-sm-12">
                	&copy; 2016 - TFG - ESEI
                </div>
            </div>
        </div>
    </body>
</html>