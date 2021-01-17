<?php

require_once dirname($_SERVER['DOCUMENT_ROOT']) . '\Templates.php';

$template = new Templates();
$template->addFolder('views', $_SERVER['DOCUMENT_ROOT'] . '\views');
$template->render('views::patata', ['nombre' => 'Juan']);
