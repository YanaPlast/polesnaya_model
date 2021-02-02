<div id="header-main">
    <div class="content-container">
        <div class="title-container">
            <div>
                <?= $h1 ?>
            </div>
            <p class="subtitle"><span>Зарегистрируем</span> или вернем деньги!</p>
        </div>
        <div class="columns columns-new">
            <div class="form-container">
                <div class="form-container-inner">
                    <p class="form-title">Бесплатно проверим ваш знак</p>
                    <p class="form-subtitle">по закрытым базам Роспатента</p>
                    <form method="post" action="success.php">
                        <input type="hidden" name="title" value="proverka"><span class="name"></span>
                        <select class="custom-list" name="packages">
                            <option value="Бесплатная проверка 0 руб" data-title="Бесплатно проверим ваш знак" data-subtitle="по закрытым базам Роспатента" data-form="proverka">Бесплатная проверка 0 руб.</option>
                            <option value="Антикризисное предложение 4990 руб" data-title="Подадим заявку за 24 часа. Форма 940" data-subtitle="Отсрочка - 70 дней. Акция Covid-19" data-form="Self">Антикризисное предложение 4990 руб</option>
                            <option value="Самостоятельная работа 9990 руб" data-title="Госпошлины со скидкой 30%" data-subtitle="Полная проверка знака. Сопровождение" data-form="Full">Самостоятельная работа 9990 руб</option>
                            <option value="Регистрация под ключ 19990 руб" data-title="Товарный знак под ключ" data-subtitle="Даем полную финансовую гарантию" data-form="Premium">Регистрация под ключ 19990 руб</option>
                        </select>
                        <label for="name" class="columns">
                            <input type="text" name="name" placeholder="Ваше имя" data-hint="имя" autocomplete="off">
                            <span class="name"></span>
                        </label>
                        <label for="phone" class="columns">
                            <input type="text" name="phone" placeholder="Ваш телефон" data-hint="телефон" autocomplete="off">
                            <span class="phone"></span>
                        </label>
                        <input type="submit" value="Оставить заявку" class="button button-green">
                    </form>
                    <p class="whatsapp">или <a href="https://wa.me/79229092784" target="_blank">напишите нам в Whatsapp</a></p>
                </div>
            </div>            
            <ul class="features">
                <li><p><span class="blue">За <span class="nowrap">24 часа</span> подадим заявку в Роспатент.</span> Уже сегодня вы закрепите знак за собой.</p></li>
                <li><p><span class="blue">Зарегистрируем знак “под ключ”.</span> По договору, без скрытых платежей и доплат.</p></li>
                <li><p><span class="blue">Свидетельство у вас на руках через 6 месяцев.</span> В 2 раза ускоряем стандартную процедуру получения.</p></li>
                <li><p><span class="blue">Вы экономите <span class="nowrap">10 000 руб.</span> на оплате гос. пошлин.</span> 30% скидка для клиентов патентного бюро Железно.</p></li>
                <li><p><span class="blue">Успешная регистрация без риска.</span> 97% наших клиентов получает знак. Находимся в ТОП-3 Роспатента.</p></li>
            </ul>   
        </div>
    </div><!-- end of content-container -->
</div><!-- end of header-main -->