<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--meta name="viewport" content="width=device-width, initial-scale=1"-->
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta http-equiv="expires" content="0">
<title>...</title>

<!-- Bootstrap -->
<!--link href="css/bootstrap.min.css" rel="stylesheet"-->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/bootstrap/css/bootstrap-theme.min.css">


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
         <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript" src="js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery/jquery-ui.min.js"></script>
<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="//cdn.jsdelivr.net/jquery.color-animation/1/mainfile"></script-->

<link rel="stylesheet"
	href="jqueryui/themes/original/jquery/jquery-ui.css">
<!--link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script-->

<style>
/*html, body, div, span, applet, object, iframe,
         h1, h2, h3, h4, h5, h6, p, blockquote, pre,
         a, abbr, acronym, address, big, cite, code,
         del, dfn, em, font, img, ins, kbd, q, s, samp,
         small, strike, strong, sub, sup, tt, var,
         dl, dt, dd, ol, ul, li,
         fieldset, form, label, legend,
         table, caption, tbody, tfoot, thead, tr, th, td {
            margin: 0;
            padding: 0;
            border: 0;
            outline: 0;
            font-weight: inherit;
            font-style: inherit;
            font-size: 100%;
            font-family: inherit;
            vertical-align: baseline;
         };*/

/*remove border radius globally*/
* {
	-webkit-border-radius: 0 !important;
	-moz-border-radius: 0 !important;
	border-radius: 0 !important;
}
/*nav {
           -webkit-border-radius: 0 !important;
              -moz-border-radius: 0 !important;
                   border-radius: 0 !important;
         }*/
/* Left align form-horizontal labels*/
.clearfix {
	clear: both;
}
</style>
</head>
<body>
      <?php
    session_start();
    error_reporting(0);
    ?>
      <div class="container-fluid">
		<nav class="navbar navbar-default">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed"
						data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
						aria-expanded="false">
						<span class="sr-only">Toggle navigation</span> <span
							class="icon-bar"></span> <span class="icon-bar"></span> <span
							class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Zieger Immobilien</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse"
					id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Bilanz<span class="sr-only">(current)</span></a></li>
						<li class=""><a href="#">Offene Betr&auml;ge<span class="sr-only"></span></a></li>
						<li class=""><a href="#">Belegung<span class="sr-only"></span></a></li>
						<li class=""><a href="#">Zahlungseing&auml;nge<span
								class="sr-only"></span></a></li>
						<li class=""><a href="#">Jahres&uuml;berblick<span class="sr-only"></span></a></li>
					</ul>
					<!--form method="POST" action="tagebuch.php" class="navbar-form navbar-right">
                 <div class="form-group">
                   <input type="submit" name="submit" class="form-control" value="LogOut"></input>
                 </div>
                 <!--a class="btn btn-default" href="tagebuch.php?logout=1">LogOut</a-->
					<!-- /form -->
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container-fluid -->
		</nav>
      <?php //echo $_SESSION['message'];?>
      </div>
      <?php
    include ("Classes.php");
    ?>
      <div class="container">
		<div class=row>
			<div class="col-md-12">
				<table class="table table-responsive-md">
					<thead>
						<th scope="col">Main</th>
						<th scope="col">Name</th>
						<th scope="col">Mieter</th>
						<th scope="col">Miete</th>
						<th scope="col">Caution</th>
					</thead>
					<tbody>
						<tr>
							<th scope="row">Adresse 1</th>
							<td>bla</td>
							<td>bla</td>
							<td>bla</td>
							<td>bla</td>
						</tr>
					</tbody>
				</table>
				<table class="table table-responsive-md">
					<thead>
						<th scope="col">Main</th>
						<th scope="col">Name</th>
						<th scope="col">Mieter</th>
						<th scope="col">Miete</th>
						<th scope="col">Caution</th>
					</thead>
					<tbody>
						<tr>
							<th scope="row">Adresse 1</th>
							<td>bla</td>
							<td>bla</td>
							<td>bla</td>
							<td>bla</td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
	</div>
	<!--p id="debug"></p-->
	<!--?php print_r($_SESSION)?-->
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="/bootstrap/js/bootstrap.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<!-- script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->
	<script>
         $("textarea").keyup(function(){
            $.post("updater.php",{diary:$("textarea").val()});
            //$("#debug").html($("textarea").val());
         });
      </script>
      <script src="greeter.js"></script>
</body>
</html>