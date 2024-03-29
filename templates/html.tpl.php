<?php
/**
 * @file
 * html.tpl.php - Default theme implementation.
 */
?>
<!DOCTYPE html>
<!--[if IEMobile 7]>
<html class="iem7" <?php print $html_attributes; ?>><![endif]-->
<!--[if lte IE 6]>
<html class="lt-ie9 lt-ie8 lt-ie7" <?php print $html_attributes; ?>><![endif]-->
<!--[if (IE 7)&(!IEMobile)]>
<html class="lt-ie9 lt-ie8" <?php print $html_attributes; ?>><![endif]-->
<!--[if IE 8]>
<html class="lt-ie9" <?php print $html_attributes; ?>><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><!-->
<html <?php print $html_attributes . $rdf_namespaces; ?>><!--<![endif]-->
<head profile="<?php print $grddl_profile ?>">
    <meta charset="utf-8">
    <title><?php print $head_title ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="cleartype" content="on">
    <meta name="MobileOptimized" content="width">
    <meta name="HandheldFriendly" content="true">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" sizes="180x180" href="/<?php print path_to_theme(); ?>/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/<?php print path_to_theme(); ?>/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/<?php print path_to_theme(); ?>/favicons/favicon-16x16.png">
    <link rel="manifest" href="/<?php print path_to_theme(); ?>/favicons/site.webmanifest">
    <link rel="mask-icon" href="/<?php print path_to_theme(); ?>/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta property="og:title" content="<?php print $head_title; ?>"/>
    <link href="/<?php print path_to_theme(); ?>/fonts/fontawesome/css/fontawesome-all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed:400,600|Open+Sans|Roboto+Slab:400,700"
          rel="stylesheet">
  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts ?>
    <script src="/<?php print path_to_theme(); ?>/js/webpack.common.js"></script>
    <!--[if IE 9]>
    <link href="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/css/bootstrap-ie9.min.css" rel="stylesheet">
    <![endif]-->
    <!--[if lte IE 8]>
    <link href="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/css/bootstrap-ie8.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/g/html5shiv@3.7.3"></script>
    <![endif]-->
</head>
<body class="<?php print $classes ?>"<?php print $attributes ?>>
<?php if ($skip_link_text && $skip_link_anchor): ?>
    <div id="skip-link">
        <a href="#<?php print $skip_link_anchor; ?>"
           class="element-invisible element-focusable sr-only sr-only-focusable"><?php print $skip_link_text; ?></a>
    </div>
<?php endif; ?>
<?php print $page_top ?>

<?php print $page ?>

<?php print $page_bottom ?>
<script src="/<?php print path_to_theme(); ?>/js/vendors.js"></script>
<script src="/<?php print path_to_theme(); ?>/js/app.js"></script>
</body>
</html>
