<?
header("Content-type: text/plain");

$domain = $app->moduleDomain;
$robots_type = 'hide'; // 'def' ||  'domain'

if ($domain && $domain->isDomainActive()){
    $robots_type = 'domain';
}

if (! $domain){
    $robots_type = 'def';
}
if ($domain && $domain->isDefDomain()){
    $robots_type = 'def';
}



if ($app->getConfig('hide_index')){
    $robots_type = 'hide';
}

switch ($robots_type){
    case 'hide':
        if ($app->getVar('robots_hide')){
            echo $app->getVar('robots_hide');
        }else { ?>
User-agent: *
Disallow: /
        <? }
        break;
    case 'domain':
        if ($app->getVar('robots_domain')){
            echo $app->getVar('robots_domain');
        }else { ?>
User-agent: *

Host: https://<?= $app->request->hostName() ?>

Sitemap: https://<?= $app->request->hostName()?>/sitemap.xml

<?php  include 'robotstxt_obshchij.php';?>

        <? }
        break;
    case 'def':
        if ($app->getVar('robots_def')){
            echo $app->getVar('robots_def');
        }else { ?>
User-agent: *
Host: <?= $app->request->httpHost() ?>

Sitemap: <?= $app->request->httpHost() ?>/sitemap.xml

<?php include 'robotstxt_obshchij.php'; ?>

        <? }
        break;
    default:
        echo 'User-agent: *
Disallow: /';

}