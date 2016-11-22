
<?php
include_once 'template/header.php';
include_once 'IncludeConfigsFiles.php';

const DEVELOP = "development";
const PROD = "production";

putenv("CONFIG=production");

$configsFiles = includeFiles();

print_r($configsFiles);

include_once 'template/footer.php';
