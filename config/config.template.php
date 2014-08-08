<?php
/** Configuration Constants **/

// Name of the project. The cache and compile directories will be created with this name
define ('PROJECT_NAME','wbs_relmgr');


// This should set some caching to on or off
define ('DEVELOPMENT_ENVIRONMENT',true);

// Define where the local repositories should be managed. This should be writable
define ('LOCAL_REPOSITORY_DIR', __DIR__ . '/../repositories'); # Example /tmp/repositories

