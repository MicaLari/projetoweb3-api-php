<?php
//importa o arquivo de configuracao
require 'config.php';
require HELPERS_FOLDER.'autoloaders.php';

Router::gateKeeper();

Output::notFound();
?>