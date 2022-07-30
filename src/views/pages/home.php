<?=$render('header', ['loggedUser' => $loggedUser])?>

<section class="container main">
    <?=$render('sidebar')?>

    <section class="feed mt-10">

        <div class="row">
            <div class="column pr-5">

                <div class="box feed-new">
                    <div class="box-body">
                        <div class="feed-new-editor m-10 row">
                            <div class="feed-new-avatar">
                                <img src="<?=$base?>/media/avatars/avatar.jpg" />
                            </div>
                            <div class="feed-new-input-placeholder">O que você está pensando, <?=$loggedUser->name?>?</div>
                            <div class="feed-new-input" contenteditable="true"></div>
                            <div class="feed-new-send">
                                <img src="<?=$base?>/assets/images/send.png" />
                            </div>
                        </div>
                    </div>
                </div>

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