<div id="consultation" class="consultation">
    <div class="content-container">
        <div class="columns">
            <div class="title-container <?= $webp ?>">
                <p class="consultation-title">Быстрая консультация</p>
                <p class="subtitle">Наш специалист перезвонит вам <span>в течение 10 минут</span></p>
            </div>
            <div class="form-container">
                <form method="post" action="success.php">
                    <input type="hidden" name="title" value="consultation" autocomplete="off"><span
                            class="name"></span>
                    <label for="name" class="columns"><input type="text" name="name" placeholder="Ваше имя"
                                                             data-hint="имя" autocomplete="off"><span
                                class="name"></span></label>
                    <label for="phone" class="columns"><input type="text" name="phone" placeholder="Ваш телефон"
                                                              data-hint="телефон" autocomplete="off"><span
                                class="phone"></span></label>
                    <select class="custom-list" name="usluga">
                        <option value="Регистрация товарного знака">Регистрация товарного знака</option>
                        <option value="Ускоренная регистрация товарного знака">Ускоренная регистрация товарного знака</option>
                        <option value="Продление товарного знака">Продление товарного знака</option>
                        <option value="Аннулирование товарного знака">Аннулирование товарного знака</option>
                        <option value="Другой вопрос">Другой вопрос</option>
                    </select>
                    <input type="submit" value="Есть вопрос" class="button">
                </form>
            </div>
        </div>
    </div><!-- end of content-container -->
</div><!-- end of consultation -->