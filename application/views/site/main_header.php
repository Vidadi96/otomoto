<!DOCTYPE html>
<html>
<head>
    <title><?=isset($header_title)?$header_title:'Barti.Az'; ?> - Pulsuz elanlar və barter saytı</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Otomoto.Az - Pulsuz elanlar və barter saytı">
    <link rel="icon" type="image/svg" href="/Images/favicon.svg">
    <link rel="stylesheet" type="text/css"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"  href="https://kit-free.fontawesome.com/releases/latest/css/free.min.css" media="all">
    <?php if(@$title == 'main-page'): ?>
        <link rel="stylesheet" type="text/css"  href="/Css/owl.carousel.min.css">
    <?php endif; ?>
    <link rel="stylesheet" type="text/css" href="/Css/slick.css">
    <link rel="stylesheet" type="text/css" href="/Css/style.css">
    <script type="text/javascript"  src="/Js/jquery.min.js"></script>
    <script type="text/javascript"  src="/Js/DisMojiPicker.js"></script>
    <script type="text/javascript"  src="/Js/twemoji.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <?php if(@$title == 'main-page'): ?>
        <script type="text/javascript"  src="/Js/owl.carousel.min.js"></script>
    <?php endif; ?>
    <?php if(@$title == 'product'): ?>
      <script src="/Js/watermark.js"></script>
    <?php endif; ?>

    <meta property="og:site_name" content="Barti.Az - Pulsuz elanlar və barter saytı" />
    <meta property="og:title" content="Barti.az - Ödənişsiz elanlar saytı" />
    <meta property="og:type" content="product" />
    <meta property="og:image" content="https://new.otomoto.az/Images/bartiaz.png" />
    <meta property="og:description" content="Azərbaycanın ən böyük barter elanları portalı" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-177076344-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-177076344-1');
    </script>
</head>
<body>
