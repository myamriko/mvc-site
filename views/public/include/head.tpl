<head>
    <meta charset="UTF-8">
    <meta name="theme-color" content="#fff">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="icon" href="/public/pic/res/{$sitedata['ico']}" type="image/x-icon"/>
    <meta name="description" content="{$description}">
    <link rel="preload" href="/public/css/flaticon.css" as="style"/>
    <link rel="preload" href="/public/owl-carousel/assets/owl.carousel.min.css" as="style"/>
    <link rel="preload" href="/public/css/animate.min.css" as="style"/>
    <link rel="preload" href="/public/css/bootstrap.min.css" as="style"/>
    <link rel="preload" href="/public/css/jquery-ui.css" as="style"/>
    <link rel="preload" href="/public/css/style.css" as="style"/>
    <link rel="preload" href="/public/css/jquery.datetimepicker.min.css" as="style"/>
    <link rel="preload" href="/public/css/progressive-image.css" as="style"/>

    <link rel="stylesheet" href="/public/css/flaticon.css"  type="text/css">
    <!-- owl carousel css-->
    <link rel="stylesheet" href="/public/owl-carousel/assets/owl.carousel.min.css" type="text/css">
    <!--animate-->
    <link rel="stylesheet" href="/public/css/animate.min.css" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <!-- custom CSS -->
    <link rel="stylesheet" href="/public/css/jquery-ui.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <!--Time reservation-->
    <link rel="stylesheet" href="/public/css/jquery.datetimepicker.min.css">
    <!-- progressive-image -->
    <link rel="stylesheet" href="/public/css/progressive-image.css">


    <script  src="/public/them-js/jquery-3.5.1.min.js" ></script>

    <title>{block name=title}{$sitedata['sitename']}{/block}</title>
    <!-- ReCaptcha  -->
    <script src='https://www.google.com/recaptcha/api.js?render={$sitedata['sitekey']}'></script>
    <!-- Facebook Pixel Code -->
    {if ($sitedata['fbpixel'] !== 'off')}
    {literal}
    <script>
        !function(f,b,e,v,n,t,s)
                {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '{/literal}{$sitedata['fbpixel']}{literal}');
        fbq('track', 'PageView');
    </script>
    {/literal}

    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id={$sitedata['fbpixel']}&ev=PageView&noscript=1"
        /></noscript>
    {/if}
    <!-- End Facebook Pixel Code -->
</head>