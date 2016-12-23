<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Test">
    <meta name="author" content="Anton Korotkov">
	<title>My very own</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="gb.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Guestbook</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#approved">Approved & submitting</a></li>
            <li><a href="#total">Total</a></li>
            <li><a href="#manage">Manage form</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
		<div id="approved">
			<h1>Guestbook</h1>
			<div id="approved-content"></div>
			<span id="write-btn" onclick="toggleForm()">write your own!</span>
			<div id="submit-container">
				<div class="row">
					<div class="col-sm-3">
						<input type="text" name="header" value="Header">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<textarea rows="3" name="text"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<input type="text" name="username" value="Name"> <input type="text" name="email" value="e-mail">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<input type="text" name="captcha" value="captcha"><img id="captcha" src="captcha.php">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<input type="button" value="Submit" onclick="submitForm()">
						<input type="button" value="Cancel" onclick="toggleForm()">
					</div>
				</div>
			</div>
		</div>
	  
		<div id="total">
			<h1>All records</h1>
			<div id="total-content"></div>
		</div>
	  
	  <div id="manage">
        <h1>Approve or delete</h1>
		<div id="manage-content"></div>
      </div>
    </div>

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="./gb.js"></script>
  </body>
</html>
