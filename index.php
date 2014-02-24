<?php
// Hide results portion
$displayResults = "none";

// Set variables
$error = "";

// Check if form is submitted
$submitted = $_POST['submitted'];

if ($submitted == 1) {
	// Get data
	$from = $_POST['select-from'];
	$to = $_POST['select-to'];
	if ($from == "") {
		$error = "Please select a FROM location.";
	}
	if ($to == "") {
		$error = "Please select a TO location.";
	}
} else {
	// do nothing
}

// Get drive duration
if ($from && $to && $error == "") {
	//echo "<script type=\"text/javascript\">calculateDistances('".$from."','".$to."');</script>";
	echo "<Script type=\"text/javascript\">calculateDistances();</script>";
	$displayResults = "block";
}

// Return results

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="">

    <title>Sticky Footer Navbar Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	  <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBoZ46tUGsaOUSo627H4KY8wx1oeAQJBig&sensor=false">
    </script>
  </head>

  <body>

    <!-- Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">DriveTime</a>
          </div>
          <div class="">
            <ul class="nav navbar-nav">
              <li class=""><a href="index.php">Reset</a></li>
              <!--<li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>-->
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1>How long will it take to get....</h1>
        </div>
		<div class="row">
			<p class="lead">
				<div class="col-lg-12 text-center">
					<?php if ($error !== "") {
							  echo "<h3><span class=\"label label-danger\">";
							  echo $error;
							  echo "</span></h3><br>";
						  }
					?>
				</div>
				<form name="form-get" action="" method="post" class="form-inline">
					<div class="col-lg-2"></div>
					<div class="col-lg-1">
						<h2>From</h2>
					</div>
					<div class="col-lg-2">
						<select id="select-from" name="select-from" class="form-control">
							<option value="">Select...</option>
							<option value="5715 Vineland Ave North Hollywood CA" <?php if ($from == "5715 Vineland Ave North Hollywood CA") { echo "selected"; }?>>Home</option>
							<option value="9380 Carroll Park Dr San Diego CA" <?php if ($from == "9380 Carroll Park Dr San Diego CA") { echo "selected"; }?>>Work</option>
						</select>
					</div>
					<div class="col-lg-1">
						<h2>To</h2>
					</div>
					<div class="col-lg-2">
						<select id="select-to" name="select-to" class="form-control">
							<option value="">Select...</option>
							<option value="5715 Vineland Ave North Hollywood CA" <?php if ($to == "5715 Vineland Ave North Hollywood CA") { echo "selected"; }?>>Home</option>
							<option value="9380 Carroll Park Dr San Diego CA" <?php if ($to == "9380 Carroll Park Dr San Diego CA") { echo "selected"; }?>>Work</option>
						</select>
					</div>
					<div class="col-lg-2">
						<input type="hidden" value="1" name="submitted" />
						<button type="submit" class="btn btn-info">Go!</button>
					</div>
					<div class="col-lg-2"></div>
				</form>
			</p>
		</div><!-- ./row -->
		<div class="row" style="display: <?php echo $displayResults; ?>;">
			<div class="col-lg-10 text-center">
				<hr />
				<h4>
					It will currently take you<br><br>
					<span class="label label-info" id="output"></span>
					<br><br>
					to get from <?php echo $from; ?> to <?php echo $to; ?>.
				</h4>
			</div>
			<div class="col-lg-10 text-center">
				<br>
				<a href="" class="btn btn-default btn-lg" role="button">Get Directions</a>
			</div>
		</div><!-- ./row -->
		<div class="row hidden">
			<div id="map-canvas"></div>
		</div>
      </div>
    </div>

    <div id="footer">
      <div class="container">
        <p class="text-muted">A <a href="http://www.kaceycoughlin.com">Kacey Coughlin</a> joint.</p>
      </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
<script type="text/javascript">

		function calculateDistances() {
			var origin = "Greenwich, England";
			var destination = "Stockholm, Sweden";
			var service = new google.maps.DistanceMatrixService();
			service.getDistanceMatrix(
			  {
				origins: [origin],
				destinations: [destination],
				travelMode: google.maps.TravelMode.DRIVING,
				unitSystem: google.maps.UnitSystem.METRIC,
				avoidHighways: false,
				avoidTolls: false
			  }, callback);
		}

		function callback(response, status) {
		  if (status == google.maps.DistanceMatrixStatus.OK) {
			var origins = response.originAddresses;
			var destinations = response.destinationAddresses;

			for (var i = 0; i < origins.length; i++) {
			  var results = response.rows[i].elements;
			  for (var j = 0; j < results.length; j++) {
				//var element = results[j];
				//var distance = element.distance.text;
				var duration = element.duration.text;
				//var from = origins[i];
				//var to = destinations[j];
			  }
			}
		  }
		  document.getElementById("output").innerHTML=duration;
		}
	//google.maps.event.addDomListener(window, 'load');
</script>
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
