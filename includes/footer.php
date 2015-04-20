
<hr>
<footer>
  <div class="col-md-12 text-center">
    <?php
    // If gives you a warning about not having a time zone set or not relying on server time
    date_default_timezone_set("America/New_York");
    ?>
    <p>&copy; James Reid Cooper <?php
        $fromYear = 2015;
        $thisYear = (int)date('Y');
        echo $fromYear . (($fromYear != $thisYear) ? '-' . $thisYear : '');?></p>
        <p><a href="http://getbootstrap.com">Using Bootstrap Framework</a></p>
        <p>Adopted from <a href="http://www.freestudentprojects.com">www.freestudentprojects.com</a></p>
    </div>
</footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="includes/js/bootstrap.min.js"></script>