<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Simulador</title>

    <link rel="shortcut icon" href="../resources/img/icon2.ico">
    
    <!-- Bootstrap core CSS -->
    <link href="../resources/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="../resources/css/simple-sidebar.css" rel="stylesheet">
    <link href="../resources/css/custom.css" rel="stylesheet">

    <!-- Selected language -->
    <?php
        require_once('../core/language.php');
        $lang = $_GET['lang'];
    ?>
</head>
<body style="background-color: #E8E8E8;">
    <div id="wrapper" style="overflow: hidden;">
        <!-- Sidebar -->
        <div id="sidebar-wrapper" style="background-color: #424242;">
            <ul class="sidebar-nav" style="overflow: hidden;">
                <div class="row" style="margin-right: 0px; margin-top: 5px;">
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>

                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                        <h1 class="text-center" style="color: #F0F0F0"><?php echo translate('Menu', $lang); ?></h1>
                    </div>

                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
                </div>

                <hr style="margin-bottom: 30px; margin-top: 17px">

                <div class="row" style="margin-left: 7px; margin-right: 10px">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h2 class="text-center" style="margin-top: 0px; color: #F0F0F0"><?php echo translate('World', $lang); ?></h2>
                        <hr>
                        <input type="button" class="btn btn-primary btn-block" id="worldBtn" onclick="world()" value="> <?php echo translate('World', $lang); ?> <" />
                        <div style="margin-bottom: 10px"></div>
                        <input type="button" class="btn btn-primary btn-block" id="elementBtn" onclick="element()" value="<?php echo translate('Elements', $lang); ?>" />
                        <div style="margin-bottom: 10px"></div>
                        <input type="button" class="btn btn-primary btn-block" id="restrictionBtn" onclick="restriction()" value="<?php echo translate('Restrictions', $lang); ?>" />
                    </div>
                </div>

                <div style="margin-bottom: 30px"></div>

                <div class="row" style="margin-left: 7px; margin-right: 10px">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h2 class="text-center" style="margin-top: 0px; color: #F0F0F0"><?php echo translate('Elements', $lang); ?></h2>
                        <hr>
                        <div style="margin-bottom: 10px"></div>
                        <input type="button" class="btn btn-primary btn-block" id="periodBtn" onclick="period()" value="<?php echo translate('Periods', $lang); ?>" />
                        <div style="margin-bottom: 10px"></div>
                        <input type="button" class="btn btn-primary btn-block" id="actionBtn" onclick="action()" value="<?php echo translate('Actions', $lang); ?>" />
                        <div style="margin-bottom: 10px"></div>
                        <input type="button" class="btn btn-primary btn-block" id="rangeBtn" onclick="range()" value="<?php echo translate('Ranges', $lang); ?>" />
                        <div style="margin-bottom: 10px"></div>
                        <input type="button" class="btn btn-primary btn-block" id="behaviourBtn" onclick="behaviour()" value="<?php echo translate('Behaviour', $lang); ?>" />
                    </div>
                </div>

                <hr style="margin-bottom: 30px; margin-top: 30px">

                <div class="row" style="margin-left: 7px; margin-right: 10px">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="btn-group btn-group-lg btn-block">
                            <form action="../core/world.php?lang=<?php echo $lang; ?>" method="post" onsubmit="return check()">
                            <button type="submit" class="btn btn-danger btn-lg btn-block"><?php echo translate('Run', $lang); ?></button>
                        </div>
                    </div>
                </div>
            </ul>
        </div>

        <!-- Page content -->
        <div id="page-content-wrapper">
            <div class="content-header" style="border-left: solid 1px #F0F0F0;">
                <div class="row" style="margin-left: 0px; background-color: #424242; padding-top: 13px; padding-bottom: 6px;">
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1" style="z-index: 1000">
                        <a id="menu-toggle" href="#" class="btn btn-default">
                            <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
                        </a>
                    </div>

                    <div class="col-md-2 col-lg-2"></div>

                    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-5 text-center">
                        <h1 style="color: #F0F0F0;"><?php echo translate('Control panel', $lang); ?></h1>
                    </div>

                    <div class="col-md-3 col-lg-3"></div>
                </div>
            </div>

            <div class="page-content inset" style="margin-top: 30px; margin-left: 40px; margin-right: 40px; margin-bottom: 10px;">
                <div class="show" id="world">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3><?php echo translate('Execution period', $lang); ?></h3>
                            <hr class="dividing">
                        </div>
                    </div>

                    <!-- Error - total period -->
                    <div class="hide" id="alert1">
                        <label id="error1"></label>
                    </div>

                    <!-- Error - day period -->
                    <div class="hide" id="alert2">
                        <label id="error2"></label>
                    </div>

                    <!-- Error - night period -->
                    <div class="hide" id="alert3">
                        <label id="error3"></label>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Total period', $lang); ?></label>
                            <div class="form-group">
                                <input class="form-control" name="totalPeriod" id="totalPeriod" value="100" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Daylight period', $lang); ?></label>
                            <div class="form-group">
                                <input class="form-control" name="dayPeriod" id="dayPeriod" value="8" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Night period', $lang); ?></label>
                            <div class="form-group">
                                <input class="form-control" name="nightPeriod" id="nightPeriod" value="2" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3><?php echo translate('Size', $lang); ?></h3>
                            <hr class="dividing">
                        </div>
                    </div>

                    <!-- Error - height of the world -->
                    <div class="hide" id="alert4">
                        <label id="error4"></label>
                    </div>

                    <!-- Error - width of the world -->
                    <div class="hide" id="alert5">
                        <label id="error5"></label>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Height', $lang); ?></label>
                            <div class="form-group">
                                <input class="form-control" name="sizeX" id="sizeX" value="5" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label><?php echo translate('Width', $lang); ?></label>
                                <input type="text" class="form-control" name="sizeY" id="sizeY" value="5" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3><?php echo translate('Weather', $lang); ?></h3>
                            <hr class="dividing">
                        </div>
                    </div>

                    <!-- Error - change weather -->
                    <div class="hide" id="alert6">
                        <label id="error6"></label>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Begining weather', $lang); ?></label>
                            <div class="form-group">
                                <select class="form-control" name="weather" id="weather" required>
                                    <option selected value="sunny"><?php echo translate('sunny', $lang); ?></option>
                                    <option value="rainy"><?php echo translate('rainy', $lang); ?></option>
                                    <option value="windy"><?php echo translate('windy', $lang); ?></option>
                                    <option value="foggy"><?php echo translate('foggy', $lang); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Change weather each (cycles)', $lang); ?></label>
                            <div class="form-group">
                                <input class="form-control" name="changeWeather" id="changeWeather" value="10" required>
                            </div>

                            <div class="alert alert-info">
                                <label><?php echo translate('0 for constant weather', $lang); ?></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hide" id="element">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3><?php echo translate('Begining amount of elements', $lang); ?></h3>
                            <hr class="dividing">
                        </div>
                    </div>

                    <!-- Error - amount of carrots -->
                    <div class="hide" id="alert7">
                        <label id="error7"></label>
                    </div>

                    <!-- Error - amount of trees -->
                    <div class="hide" id="alert8">
                        <label id="error8"></label>
                    </div>

                    <!-- Error - amount of lairs -->
                    <div class="hide" id="alert9">
                        <label id="error9"></label>
                    </div>

                    <!-- Error - amount of rabbits -->
                    <div class="hide" id="alert10">
                        <label id="error10"></label>
                    </div>

                    <!-- Error - amount of wolfs -->
                    <div class="hide" id="alert11">
                        <label id="error11"></label>
                    </div>

                    <!-- Error - amount of elements > size of the world -->
                    <div class="hide" id="alert12">
                        <label id="error12"></label>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label><?php echo translate('Carrots', $lang); ?></label>
                                <input type="text" class="form-control" name="carrot" id="carrot" value="2" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label><?php echo translate('Trees', $lang); ?></label>
                                <input type="text" class="form-control" name="tree" id="tree" value="2" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="form-group">
                                <label><?php echo translate('Lairs', $lang); ?></label>
                                <input type="text" class="form-control" name="lair" id="lair" value="2" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Rabbits', $lang); ?></label>
                            <div class="form-group">
                                <input class="form-control" name="rabbit" id="rabbit" value="2" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Wolves', $lang); ?></label>
                            <div class="form-group">
                                <input class="form-control" name="wolf" id="wolf" value="2" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3><?php echo translate('Regeneration of carrots', $lang); ?></h3>
                            <hr class="dividing">
                        </div>
                    </div>

                    <!-- Error - regeneration of carrots - time -->
                    <div class="hide" id="alert13">
                        <label id="error13"></label>
                    </div>

                    <!-- Error - regeneration of carrots - amount -->
                    <div class="hide" id="alert14">
                        <label id="error14"></label>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Each (cycles)', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="timeMoreCarrot" id="timeMoreCarrot" value="50" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Amount', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="amountMoreCarrot" id="amountMoreCarrot" value="0" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hide" id="restriction">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3><?php echo translate('Eat', $lang); ?></h3>
                            <hr class="dividing">
                        </div>
                    </div>

                    <!-- Error - Period without eat - Rabbits -->
                    <div class="hide" id="alert15">
                        <label id="error15"></label>
                    </div>

                    <!-- Error - Period without eat - Wolfs -->
                    <div class="hide" id="alert16">
                        <label id="error16"></label>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Rabbits - Cycles without eat', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="maxEatRabbit" id="maxEatRabbit" value="100" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Wolves - Cycles without eat', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="maxEatWolf" id="maxEatWolf" value="100" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3><?php echo translate('Sleep', $lang); ?></h3>
                            <hr class="dividing">
                        </div>
                    </div>

                    <!-- Error - Period without sleep - Rabbits -->
                    <div class="hide" id="alert17">
                        <label id="error17"></label>
                    </div>

                    <!-- Error - Period without sleep - Wolfs -->
                    <div class="hide" id="alert18">
                        <label id="error18"></label>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Rabbits - Cycles without sleep', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="maxSleepRabbit" id="maxSleepRabbit" value="100" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Wolves - Cycles without sleep', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="maxSleepWolf" id="maxSleepWolf" value="100" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Rabbits - Obligatory place to sleep', $lang); ?></label>
                            <div class="form-group">
                                <select class="form-control" name="placeToSleepRabbit" id="placeToSleepRabbit" required>
                                    <option selected value="ground">Tierra / Madriguera</option>
                                    <option value="lair">Madriguera</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3><?php echo translate('Breed', $lang); ?></h3>
                            <hr class="dividing">
                        </div>
                    </div>

                    <!-- Error - Breed each - Rabbits -->
                    <div class="hide" id="alert19">
                        <label id="error19"></label>
                    </div>

                    <!-- Error - Amount of children - Wolfs -->
                    <div class="hide" id="alert20">
                        <label id="error20"></label>
                    </div>

                    <!-- Error - Breed each - Rabbits -->
                    <div class="hide" id="alert21">
                        <label id="error21"></label>
                    </div>

                    <!-- Error - Amount of children - Wolfs -->
                    <div class="hide" id="alert22">
                        <label id="error22"></label>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Rabbits - Can breed each (cycles)', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="breedRabbitEach" id="breedRabbitEach" value="50" required>
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Rabbits - Maximum amount', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="breedRabbitAmount" id="breedRabbitAmount" value="4" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Wolves - Can breed each (cycles)', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="breedWolfEach" id="breedWolfEach" value="50" required>
                            </div>

                            <div class="alert alert-info">
                                <label style="text-align: justify;"><?php echo translate('0 to avoid the breed of rabbits and wolves', $lang); ?></label>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label>Lobos - Cantidad máxima</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="breedWolfAmount" id="breedWolfAmount" value="4" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                            <div class="alert alert-info">
                                <label style="text-align: justify;"><?php echo translate('They aren\'t going to breed with this parameters. Two rabbits or two wolves need to meet, need to be sated and need to sleep enough. The maximum amount indicates the number of children they can have, which is between 1 and already said amount. This feature concerns an individual. It exists the posibility that their children don\'t live at birth', $lang); ?></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hide" id="period">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3><?php echo translate('Eat', $lang); ?></h3>
                            <hr class="dividing">
                        </div>
                    </div>

                    <!-- Error - Need to eat each (period) - Rabbits -->
                    <div class="hide" id="alert23">
                        <label id="error23"></label>
                    </div>

                    <!-- Error - Need to eat each (period) - Wolfs -->
                    <div class="hide" id="alert24">
                        <label id="error24"></label>
                    </div>

                    <!-- Error - No need to eat (period) - Rabbits -->
                    <div class="hide" id="alert47">
                        <label id="error47"></label>
                    </div>

                    <!-- Error - No need to eat (period) - Wolfs -->
                    <div class="hide" id="alert48">
                        <label id="error48"></label>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Rabbits - Need (cycles)', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="turnEatRabbit" id="turnEatRabbit" value="2" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Wolves - Need (cycles)', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="turnEatWolf" id="turnEatWolf" value="2" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                            <div class="alert alert-info">
                                <label><?php echo translate('0 to eat in the same cycle', $lang); ?></label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Rabbits - Are sated for (cycles)', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="noNeedToEatRabbit" id="noNeedToEatRabbit" value="2" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Wolves - Are sated for (cycles)', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="noNeedToEatWolf" id="noNeedToEatWolf" value="2" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3><?php echo translate('Sleep', $lang); ?></h3>
                            <hr class="dividing">
                        </div>
                    </div>

                    <!-- Error - Need to sleep each (period) - Rabbits -->
                    <div class="hide" id="alert25">
                        <label id="error25"></label>
                    </div>

                    <!-- Error - Need to sleep each (period) - Wolfs -->
                    <div class="hide" id="alert26">
                        <label id="error26"></label>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Rabbits - Need (cycles)', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="turnSleepRabbit" id="turnSleepRabbit" value="2" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Wolves - Need (cycles)', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="turnSleepWolf" id="turnSleepWolf" value="2" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                            <div class="alert alert-info">
                                <label><?php echo translate('0 to sleep in the same cycle', $lang); ?></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hide" id="action">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3><?php echo translate('Points per cycle to make actions', $lang); ?></h3>
                            <hr class="dividing">
                        </div>
                    </div>

                    <!-- Error - Points per period - Rabbits -->
                    <div class="hide" id="alert27">
                        <label id="error27"></label>
                    </div>

                    <!-- Error - Points per period - Wolfs -->
                    <div class="hide" id="alert28">
                        <label id="error28"></label>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Rabbits', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="maxUseRabbit" id="maxUseRabbit" value="6" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Wolves', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="maxUseWolf" id="maxUseWolf" value="6" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3><?php echo translate('Use per action', $lang); ?></h3>
                            <hr class="dividing">
                        </div>
                    </div>

                    <!-- Error - Use per action - Smell - Rabbits -->
                    <div class="hide" id="alert29">
                        <label id="error29"></label>
                    </div>

                    <!-- Error - Use per action - Smell - Wolfs -->
                    <div class="hide" id="alert30">
                        <label id="error30"></label>
                    </div>

                    <!-- Error - Use per action - Hear - Rabbits -->
                    <div class="hide" id="alert31">
                        <label id="error31"></label>
                    </div>

                    <!-- Error - Use per action - Hear - Wolfs -->
                    <div class="hide" id="alert32">
                        <label id="error32"></label>
                    </div>

                    <!-- Error - Use per action - See - Rabbits -->
                    <div class="hide" id="alert33">
                        <label id="error33"></label>
                    </div>

                    <!-- Error - Use per action - See - Wolfs -->
                    <div class="hide" id="alert34">
                        <label id="error34"></label>
                    </div>

                    <!-- Error - Use per action - Move - Rabbits -->
                    <div class="hide" id="alert35">
                        <label id="error35"></label>
                    </div>

                    <!-- Error - Use per action - Move - Wolfs -->
                    <div class="hide" id="alert36">
                        <label id="error36"></label>
                    </div>

                    <!-- Error - Use per action - Sleep - Rabbits -->
                    <div class="hide" id="alert37">
                        <label id="error37"></label>
                    </div>

                    <!-- Error - Use per action - Sleep - Wolfs -->
                    <div class="hide" id="alert38">
                        <label id="error38"></label>
                    </div>

                    <!-- Error - Use per action - Breed - Rabbits -->
                    <div class="hide" id="alert39">
                        <label id="error39"></label>
                    </div>

                    <!-- Error - Use per action - Breed - Wolfs -->
                    <div class="hide" id="alert40">
                        <label id="error40"></label>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Smell - Rabbits', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="smellRabbitUse" id="smellRabbitUse" value="1" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Smell - Wolves', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="smellWolfUse" id="smellWolfUse" value="1" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Hear - Rabbits', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="hearRabbitUse" id="hearRabbitUse" value="1" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Hear - Wolves', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="hearWolfUse" id="hearWolfUse" value="1" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('See - Rabbits', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="seeRabbitUse" id="seeRabbitUse" value="1" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('See - Wolves', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="seeWolfUse" id="seeWolfUse" value="1" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Move - Rabbits', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="moveRabbitUse" id="moveRabbitUse" value="1" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Move - Wolves', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="moveWolfUse" id="moveWolfUse" value="1" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Sleep - Rabbits', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="sleepRabbitUse" id="sleepRabbitUse" value="1" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Sleep - Wolves', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="sleepWolfUse" id="sleepWolfUse" value="1" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Breed - Rabbits', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="breedRabbitUse" id="breedRabbitUse" value="1" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Breed - Wolves', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="breedWolfUse" id="breedWolfUse" value="1" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hide" id="range">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3><?php echo translate('Ranges', $lang); ?></h3>
                            <hr class="dividing">
                        </div>
                    </div>

                    <!-- Error - Range - See - Rabbits -->
                    <div class="hide" id="alert41">
                        <label id="error41"></label>
                    </div>

                    <!-- Error - Range - See - Wolfs -->
                    <div class="hide" id="alert42">
                        <label id="error42"></label>
                    </div>

                    <!-- Error - Range - Smell - Rabbits -->
                    <div class="hide" id="alert43">
                        <label id="error43"></label>
                    </div>

                    <!-- Error - Range - Smell - Wolfs -->
                    <div class="hide" id="alert44">
                        <label id="error44"></label>
                    </div>

                    <!-- Error - Range - Hear - Rabbits -->
                    <div class="hide" id="alert45">
                        <label id="error45"></label>
                    </div>

                    <!-- Error - Range - Hear - Wolfs -->
                    <div class="hide" id="alert46">
                        <label id="error46"></label>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Sight - Rabbits', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="seeRabbit" id="seeRabbit" value="1" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Sight - Wolves', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="seeWolf" id="seeWolf" value="1" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Smell - Rabbits', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="smellRabbit" id="smellRabbit" value="1" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Smell - Wolves', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="smellWolf" id="smellWolf" value="1" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Hear - Rabbits', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="hearRabbit" id="hearRabbit" value="1" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Hear - Wolves', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="hearWolf" id="hearWolf" value="1" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3><?php echo translate('Comfort zone', $lang); ?></h3>
                            <hr class="dividing">
                        </div>
                    </div>

                    <!-- Error - Comfort for eat - Rabbits -->
                    <div class="hide" id="alert49">
                        <label id="error49"></label>
                    </div>

                    <!-- Error - Comfort for eat - Wolfs -->
                    <div class="hide" id="alert50">
                        <label id="error50"></label>
                    </div>

                    <!-- Error - Comfort for sleep - Rabbits -->
                    <div class="hide" id="alert51">
                        <label id="error51"></label>
                    </div>

                    <!-- Error - Comfort for sleep - Wolfs -->
                    <div class="hide" id="alert52">
                        <label id="error52"></label>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Rabbits - Until (cycles) after eat', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="eatComfortRabbit" id="eatComfortRabbit" value="2" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Wolves - Until (cycles) after eat', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="eatComfortWolf" id="eatComfortWolf" value="2" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Rabbits - Until (cycles) after sleep', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="sleepComfortRabbit" id="sleepComfortRabbit" value="2" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <label><?php echo translate('Wolves - Until (cycles) after sleep', $lang); ?></label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="sleepComfortWolf" id="sleepComfortWolf" value="2" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hide" id="behaviour">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h3><?php echo translate('Behaviour', $lang); ?></h3>
                            <hr class="dividing">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label><?php echo translate('Rabbits', $lang); ?></label>
                            <textarea class="text-editor" name="codeRabbit"></textarea>

                            <br>

                            <label><?php echo translate('Wolves', $lang); ?></label>
                            <textarea class="text-editor" name="codeWolf"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="../resources/js/jquery-1.10.2.js"></script>
    <script src="../resources/js/bootstrap.js"></script>

    <!-- Add custom JS here -->
    <script src="../resources/js/inputS2.js"></script>
    <script src="../resources/js/checkS2.js"></script>
    <script src="../resources/js/language.js"></script>

    <!-- Custom JS for text editor -->
    <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
    <script>
        tinymce.init({
            selector: '.text-editor',
            toolbar: 'undo redo | cut copy | outdent indent',
            menubar: false,
        });
    </script>

    <!-- Custom JavaScript for the Menu Toggle -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("active");
        });
    </script>
</body>
</html>