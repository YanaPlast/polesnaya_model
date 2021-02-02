<?php
/**
 * @var array $reestrItemsCity
 */

?>
<p id="city-title" class="modal-title">{city_ip}</p>
<ol>
    <?php foreach ($reestrItemsCity as $item) {
        $organization_name = $item['organization_name'] ? $item['organization_name'] . ' - ' : '';
        ?>
        <li><?= $organization_name ?> <?= $item['tovarnyj_znak'] ?> - <a
                    href="<?= $item['url'] ?>"
                    target="_blank">смотреть в реестре</a></li>
    <?php } ?>
</ol>
