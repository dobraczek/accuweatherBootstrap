<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
	<meta charset="utf-8">
	<title>AccuweatherBootstrap</title>
	
	<meta content="" name="keywords">
	<meta content="" name="author">
	
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>

<div class="container">

	<h1>AccuweatherBootstrap</h1>

    <?php
    /**
     * AccuweatherBootstrap
     * @author Dobr@CZek
     * @link http://webscript.cz
     * @version 1.0
     */
    
    include "accuweatherBootstrap.php";
    
    $Bootstrap = new Accuweather\Bootstrap();
    $array = $Bootstrap->getArray()->accuweather();
    
    if(@$array['Code'] == "Unauthorized")
        echo '<strong>'.$array['Message'].'</strong>';
    else
        echo $Bootstrap->DesignA();  
    ?>
</div>

</body>
</html>
