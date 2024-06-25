<!doctype html>
<html lang="en">
  <head>

    <title><!-- IF SITENAME_STRING -->{SITENAME_STRING}<!-- ELSE -->{SITENAME}<!-- ENDIF --></title>

    <meta charset="utf-8">
    <meta content="IE=edge, chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- IF META_DESC --><meta name="description" content="{META_DESC}"><!-- ENDIF -->
    <!-- IF META_KEYWORDS --><meta name="keywords" content="{META_KEYWORDS}"><!-- ENDIF -->

    <meta property="og:url"          content="{OG_URL}" />
    <meta property="og:type"         content="website" />
    <meta property="og:title"        content="<!-- IF SITENAME_STRING -->{SITENAME_STRING}<!-- ELSE -->{SITENAME}<!-- ENDIF --><!-- IF ITEM && .par --><!-- BEGIN par --><!-- IF par.VALUE --> - {par.NAME} {par.VALUE}<!-- ENDIF --><!-- END par --><!-- ENDIF -->" />
    <meta property="og:description"  content="{META_DESC}" />
    <meta property="og:image"        content="<!-- IF ITEM -->{IMAGE_MAIN}<!-- ELSE -->{OG_IMAGE}<!-- ENDIF -->" />
    <meta property="og:image:width"  content="339" />
    <meta property="og:image:height" content="500" />
    <meta property="fb:app_id"       content="{FB_APPID}" />

    <link rel="icon" href="{SITEURL}/theme/img/favicon.png?v=1.0" />
    <link rel="canonical" href="{URL_CANONICAL}" />

    <!-- IF FUNC_FILE == 'add' || ITEM-EDIT -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="{SITEURL}/theme/css/jquery.selectBoxIt.css" />
    <!-- ENDIF -->

    <!-- IF ITEM_SHOW || FUNC_FILE == 'profile' --><link rel="stylesheet" type="text/css" href="{SITEURL}/theme/css/lightgallery.css" /><!-- ENDIF -->

    <link rel="stylesheet" href="{SITEURL}/theme/css/swiper.css">
    <link rel="stylesheet" href="{SITEURL}/theme/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <!-- IF MAIN-PAGE --><link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/><!-- ENDIF -->
    <link rel="stylesheet" href="{SITEURL}/theme/css/style.css?v=0.1">
    <link rel="stylesheet" href="{SITEURL}/theme/css/custom.css">

    {GOOGLE_ANALITICS}

  </head>
  <body<!-- IF ONLOAD --> onload="{ONLOAD}"<!-- ENDIF -->>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M9XZRCK"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <main class="wrapper-container">
