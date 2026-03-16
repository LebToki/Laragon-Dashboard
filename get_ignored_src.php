<?php
require 'config.php';
require 'includes/helpers.php';
echo "From helpers: \n";
var_dump(getIgnoredProjects());
echo "\nFrom API:\n";
require 'api/projects.php';
