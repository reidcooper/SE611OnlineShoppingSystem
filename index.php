
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="Online Shopping System, a project built for my SE-611 class" content="">
  <meta name="James Reid Cooper" content="">

  <title>Online Shopping System</title>

  <!-- Bootstrap core CSS -->
  <link href="includes/css/bootstrap.min.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
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
            <a class="navbar-brand" href="index.html">Online Shopping System</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <form class="navbar-form navbar-right">
              <div class="form-group">
                <input type="text" placeholder="Email" class="form-control">
              </div>
              <div class="form-group">
                <input type="password" placeholder="Password" class="form-control">
              </div>
              <button type="submit" class="btn btn-success">Sign in</button>
            </form>
          </div><!--/.navbar-collapse -->
        </div>
      </nav>

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1>Welcome to the Online Shopping System!</h1>
          <p>This system helps in buying of goods, products and services online by choosing the listed products from this website.</p>
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-md-6">
            <h2>Customers</h2>
            <p>You are allowed to visit the website and buy products online from the various vendors/sellers registered.</p>
          </div>
          <div class="col-md-6">
            <h2>Vendors</h2>
            <p>Vendors will add their products to the database, which will be seen in the website to the end users or say customers who can buy the products by selecting the one they need. Vendors will have the special privileges than the customers, and have the ability to manage the products added by them.</p>
            <!-- <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p> -->
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col-md-6 text-center">
            <h2>Register?</h2>
            <p><a class="btn btn-default" href="register.php" role="button">Click Here to Register! &raquo;</a></p>
          </div>
          <div class="col-md-6 text-center">
            <h2>Forgot Password?</h2>
            <p><a class="btn btn-default" href="#" role="button">Click Here to Reset Your Password! &raquo;</a></p>
          </div>
        </div>

        <?php
        include("includes/footer.php");
        ?>
      </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="includes/js/bootstrap.min.js"></script>
  </body>
  </html>
