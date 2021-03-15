<body class="landing-page sidebar-collapse">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MFJLZV6" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <?php include('parts/nav.php') ?>
    <?php include('parts/slider.php') ?>
    <?php include('parts/about.php') ?>
    <?php include('parts/services.php') ?>
    <?php include('parts/brand.php') ?>
    <?php include('parts/teams.php') ?>
    <?php include('parts/testimony.php') ?>

    <div class="col-md-10 ml-auto col-xl-6 mr-auto">
        <div id="pixlee_container"></div>
    </div>

    <script type="text/javascript">
        window.PixleeAsyncInit = function() {
            Pixlee.init({
                apiKey: 'XAGxtDws_QM2SXxVKE60'
            });
            Pixlee.addSimpleWidget({
                widgetId: '29469'
            });
        };
    </script>
    <script src="//instafeed.assets.pxlecdn.com/assets/pixlee_widget_1_0_0.js"></script>

    <?php include('parts/form.php') ?>