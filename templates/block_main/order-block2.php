<div class="order-block">
    <div class="full-width-container">
        <div class="content-container">
            <div class="title-container">
                <p class="title"><?=$order_block_title?></p>
                <p class="subtitle"><span>Пока ваш знак</span> не зарегистрировал кто-то другой</p>
            </div>
        </div><!-- end of content-container -->
    </div><!-- end of full-width-container -->
    <div class="content-container">
        <div class="columns">
            <div class="column">
                <p class="order-block-title">Бесплатно:</p>
                <ul>
                    <li><?= $pr13 ?></li>
                    <li><span>Подберем</span> классы МКТУ</li>
                    <li><span>Рассчитаем</span> итоговую стоимость гос. пошлин</li>
                    <li><?= $pr12 ?></li>
                </ul>
                <div class="additional">
                    <p><span><?= $pr28 ?></span> <sup>*</sup> при оформлении заявки <span
                                class="action-date" data-text="до <?php echo($action_end); ?>"></span></p>
                </div>
            </div>
            <div class="form-block">
                <p class="vertical">Оставьте заявку!</p>
                <div class="form-container">
                    <div class="form-container-inner">
                        <p class="form-title">Проверить бесплатно</p>
                        <p class="form-subtitle">Мы перезвоним в течение 10 минут</p>
                        <form method="post" action="success.php">
                            <input type="hidden" name="title" value="Main-form"><span class="name"></span>
                            <label for="name" class="columns"><input type="text" name="name" placeholder="Ваше имя"
                                                                     data-hint="имя" autocomplete="off"><span
                                        class="name"></span></label>
                            <label for="phone" class="columns"><input type="text" name="phone" placeholder="Ваш телефон"
                                                                      data-hint="телефон" autocomplete="off"><span
                                        class="phone"></span></label>
                            <label for="email" class="columns"><input type="email" name="email"
                                                                      placeholder="Email (не обязательно)"
                                                                      data-hint="email" autocomplete="off"><span
                                        class="email"></span></label>
                            <input type="submit" value="Оставить заявку" class="button button-green">
                        </form>
                        <p class="whatsapp">или <a href="https://api.whatsapp.com/send?phone=79229092784<?= $whatsapp_text ?>" target="_blank">напишите нам в Whatsapp</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end of content-container -->
</div><!-- end of order-block -->