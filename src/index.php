<?php

require_once 'vendor/autoload.php'; // Assuming composer is used or PRADO is installed via pear/manual. 
// For this example, we'll assume a basic entry point. 
// If PRADO is not installed via composer, we might need to include prado.php manually.
// Since the user asked for a Docker setup, we should probably install PRADO in the container or assume a vendor dir.
// Let's assume we will run composer install in the container or similar. 
// Standard PRADO entry:

$frameworkPath = __DIR__ . '/vendor/pradosoft/prado/framework/prado.php';

// If running inside docker without composer pre-installed, we might need to handle that.
// But for a cleaner setup, let's assume composer usage.
if (!file_exists($frameworkPath)) {
    // Fallback if user installs it elsewhere or manually
     if (file_exists('vendor/autoload.php')) {
        require_once 'vendor/autoload.php';
    } else {
        die("Please install PRADO framework via composer.");
    }
} else {
    require_once $frameworkPath;
}

$application = new \Prado\TApplication('protected/application.xml');
$application->run();
