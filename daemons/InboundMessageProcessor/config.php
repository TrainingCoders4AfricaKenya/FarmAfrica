<?php

# Database settings
$hostnameOrIP = "localhost";
$userName = "farmAfrica";
$password = "#Mkul1ma5*";
$dbName = "farmAfrica";
$port = "3306";

# Application settings
$appname = "inboundmsgproc";
$author = "Fred Muya";
$email = "kingkonig@gmail.com";
$description = "Processes records in inboundMessages.";
$dir = dirname(__FILE__);
$executable = "InboundMessageProcessor.php";
$logfile = '/var/log/applications/FarmAfrica/Daemons/InboundMessageProcessor/InboundMessageProcessor.log';


## DO NOT EDIT BELOW THIS LINE ##

$options = array(
    "authorName" => $author,            # Author name
    "authorEmail" => $email,            # Author email
    "appName" => $appname,              # The application name
    "appDescription" => $description,   # Daemon description
    "appDir" => $dir,                   # The home directory of the daemon
    "appExecutable" => $executable,     # The executable daemon file
    "logLocation" => $logfile,          # Log file location
    "logPhpErrors" => "TRUE",           # Reroute PHP errors to log function
    "logFilePosition" => "TRUE",        # Show file in which the log message was generated
    "logLinePosition" => "TRUE",        # Show the line number in which the log message was generated
    "sysMaxExecutionTime" => "0",       # Maximum execution time of the script in seconds (0 is infinite)
    "sysMaxInputTime" => "0",           # Maximum time to spend parsing request data (0 is infinite)
    "sysMemoryLimit" => "128M"          # Maximum amount of memory the script may consume (0 is infinite)
);
?>