<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php
	\vendor\core\base\View::getMeta();
	?>
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <link href="/assets/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/woocommerce-FlexSlider-0d95828/flexslider.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
        <nav class="navbar navbar-inverse fixed-top">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Ротатор баннеров</a>
        </nav>


	<?= $content ?>


        <footer id="footer" class="footer">
            <p>Copyright Vadim, &copy; <?= date( 'Y' ) ?> </p>
        </footer>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="/assets/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/woocommerce-FlexSlider-0d95828/jquery.flexslider-min.js"></script>
<?php
foreach ( $scripts as $script ) {
	echo $script;
}
?>

</body>
</html>