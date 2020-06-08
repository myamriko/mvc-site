<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="icon" href="/public/pic/res/{$sitedata['ico']}"/>

    <link href="/public/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- owl carousel css-->
    <link rel="stylesheet" href="/public/owl-carousel/assets/owl.carousel.min.css" type="text/css">
    <!--animate-->
    <link rel="stylesheet" href="/public/css/animate.min.css" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <!-- custom CSS -->
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/style.scss">

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