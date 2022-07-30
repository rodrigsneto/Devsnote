<?=$render('header', ['loggedUser' => $loggedUser])?>

<section class="container main">
    <?=$render('sidebar')?>

    <section class="feed mt-10">

        <div class="row">
            <div class="column pr-5">


            <?= $render('feed-editor', ['loggedUser' => $loggedUser]) ;?>

            <?= $render('feed-item', ['loggedUser' => $loggedUser]) ;?>

            </div>
            <div class="column side pl-5">
                <div class="box banners">
                    <div class="box-header">
                        <div class="box-header-text">Patrocinios</div>
                        <div class="box-header-buttons">

                        </div>
                    </div>
                    <div class="box-body">
                        <a href="https://www.php.net/releases/8.1/en.php">
                            <img src="https://terminalroot.com.br/assets/img/php/php-8.jpg" />
                        </a>
                        <a href="https://laravel.com/docs/9.x/releases">
                            <img src="http://www.fronesissolutions.com/101.jpg" />
                        </a>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body m-10">
                        Criado com ❤️ por Neto Rodrigues
                    </div>
                </div>
            </div>
        </div>

    </section>
</section>

<?=$render('footer')?>