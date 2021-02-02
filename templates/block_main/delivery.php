<!-- begin of delivery-->
<?php
$domain = $app->moduleDomain;
if (!$domain->isDefDomain() && $domain->isDomainActive() && !$app->getVar('shopPhone')) { ?>


    <div id="delivery">
        <div class="content-container">
            <p class="title">Доставка <span>на ваших условиях</span></p>
            <p class="subtitle">Свидетельство о регистрации товарного знака</p>
            <div class="text">
                <?= $delivery_geo_text ?>
            </div>
            <div id="geo-block">
                <?php
                $points = $app->getDeliveryServicePointsMap();
                echo $points
                ?>
            </div>
        </div><!-- end of content-container -->
    </div><!-- delivery -->

<?php } ?>

<!-- end of delivery-->