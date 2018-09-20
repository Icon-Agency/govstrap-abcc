<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>Australian Building and Construction Commission</title>
    <link href="~/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link href="css/site.css" type="text/css" rel="stylesheet" /> -->
    <link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed:600|Open+Sans:400,600|Roboto+Slab:400,700"
          rel="stylesheet">
    <!-- <link href="fonts/fontawesome/css/fontawesome-all.css" rel="stylesheet"> -->
    <!-- <script src="js/webpack.common.js"></script> -->
    <!--[if IE 9]>
    <link href="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/css/bootstrap-ie9.min.css"
          rel="stylesheet">
    <![endif]-->
    <!--[if lte IE 8]>
    <link href="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/css/bootstrap-ie8.min.css"
          rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/g/html5shiv@3.7.3"></script>
    <![endif]-->

    <style>
        /* Print styling */

        /*@media print {*/

        .print-spacer {
            width: 100%;
            line-height: 30px;
            height: 30px;
            display: block;
            float: left;
        }

        .fs-body {
            column-count: 2;
            -webkit-column-count: 2;
            -moz-column-count: 2;
            display: table-cell;
        }

        [class*="col-sm-"] {
            float: left;
        }

        [class*="col-xs-"] {
            float: left;
        }

        .col-sm-12, .col-xs-12 {
            width: 100% !important;
        }

        .col-sm-11, .col-xs-11 {
            width: 91.66666667% !important;
        }

        .col-sm-10, .col-xs-10 {
            width: 83.33333333% !important;
        }

        .col-sm-9, .col-xs-9 {
            width: 75% !important;
        }

        .col-sm-8, .col-xs-8 {
            width: 66.66666667% !important;
        }

        .col-sm-7, .col-xs-7 {
            width: 58.33333333% !important;
        }

        .col-sm-6, .col-xs-6 {
            width: 47% !important;
        }

        .col-sm-5, .col-xs-5 {
            width: 41.66666667% !important;
        }

        .col-sm-4, .col-xs-4 {
            width: 33.33333333% !important;
        }

        .col-sm-3, .col-xs-3 {
            width: 25% !important;
        }

        .col-sm-2, .col-xs-2 {
            width: 16.66666667% !important;
        }

        .col-sm-1, .col-xs-1 {
            width: 8.33333333% !important;
        }

        .col-sm-1,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-xs-1,
        .col-xs-2,
        .col-xs-3,
        .col-xs-4,
        .col-xs-5,
        .col-xs-6,
        .col-xs-7,
        .col-xs-8,
        .col-xs-9,
        .col-xs-10,
        .col-xs-11,
        .col-xs-12 {
            float: left !important;
        }

        body {
            margin: 0;
            padding: 0 !important;
            min-width: 768px;
            font-size: 12px;
            -webkit-print-color-adjust: exact !important;
            font-family: 'Open Sans', serif;
        }

        .container {
            width: auto;
            min-width: 750px;
            padding: 0 15px;
        }

        a[href]:after {
            content: none;
        }

        .text-right {
            text-align: right;
        }

        .float-right {
            float: right !important;
        }

        .blue {
            color: #25a1db !important;
        }

        .bg-blue {
            background-color: #25a1db !important;
        }

        .green {
            color: #17b791 !important;
        }

        .bg-green {
            background-color: #17b791 !important;
        }

        .purple {
            color: #9b3a95 !important;
        }

        .bg-purple {
            background-color: #9b3a95 !important;
        }

        .red {
            color: #e15047 !important;
        }

        .bg-red {
            background-color: #e15047 !important;
        }

        .dark-blue {
            color: #003956 !important;
        }

        .gray {
            color: #333 !important;
        }

        .tag-wrap {
            position: relative;
            padding-left: 60px;
        }

        .tag {
            height: 35px;
            width: 100px;
            line-height: 35px;
            text-align: center;
            position: absolute;
            top: 30%;
            left: -44px;
            display: inline-block;
            float: left;
            padding: 0;
            color: #fff;
            font-weight: 600;
            transform: rotate(-90deg);
            font-family: 'Barlow', serif;
        }

        .tag.large {
            width: 184px;
            top: 40%;
            left: -75px;
        }

        h1 {
            clear: both;
            font-size: 40px;
            line-height: 0.9;
            margin-top: 20px !important;
            margin-bottom: 15px !important;
        }

        p {
            clear: both;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            width: 100%;
            float: left;
            font-family: 'Roboto Slab', serif;
            margin-bottom: 5px;
            color: #003956;
        }

        .contact-info {
            font-size: 18px;
            font-weight: 700;
            font-family: 'Barlow', serif;
        }

        ul {
            padding-left: 15px;
        }

        .text-large {
            font-size: 18px;
        }

        .text-small {
            font-size: 11px;
        }

        .text-mini {
            font-size: 10px;
        }

        .abcc-logo {
            float: left;
            width: 309px;
            height: 86px;
        }

        .logo {
            float: right;
            width: 100px;
            height: 77px;
            margin-top: 4px;
        }

        .noprint,
        div.alert,
        header,
        .group-media,
        .btn,
        .footer,
        form,
        #comments,
        .nav,
        ul.links.list-inline,
        ul.action-links {
            display: none !important;
        }

        /*}
</style>
</head>
<body class="print">

<?php print $page ?>

<script>
  window.print();
</script>
</body>
</html>
