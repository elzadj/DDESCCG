<?php
function html($str) {
    return htmlspecialchars($str, ENT_COMPAT, 'utf-8');
}

function parseConfigFile($filename) {
    if (!file_exists('config/' . $filename)) {
        exit('No ' . $filename . ' file');
    }

    $json = file_get_contents('config/' . $filename);
    if (!$config = json_decode($json, FALSE)) {
        exit($filename . ' is invalid');
    }

    return $config;
}

# Get general config
function getConfig() {
    return parseConfigFile('config.json');
}


# Get device data
function getDevice($deviceID) {
    $config = parseConfigFile('devices.json');

    # Get data on this device
    $arr = array_filter($config, function ($el) use ($deviceID) {
        return $el->id === $deviceID;
    });

    if (!count($arr)) {
        exit('Device ' . $deviceID . ' not found in devices.json');
    } 

    return array_values($arr)[0];
}


# Get practices
function getPractices($practiceIDs = NULL) {
    $config = parseConfigFile('practices.json');

    if (isset($practiceIDs)) {
        return array_filter($config, function ($el) use ($practiceIDs) {
            return in_array($el->id, $practiceIDs);
        });
    }

    return $config;
}


# Get practice data
function getPractice($practiceID, $deviceID) {
    $config = parseConfigFile('practices.json');

    # Get data for this practice
    $arr = array_filter($config, function ($el) use ($practiceID) {
        return $el->id === $practiceID;
    });

    if (!count($arr)) {
        header('Location:choose-practice.php?id=' . $deviceID);
        exit();
        //exit('Practice ' . $practiceID . ' not found in practices.json');
    }

    return array_values($arr)[0];
}


# Get layout data
function getLayout($practiceID) {
    $config = parseConfigFile('layout.json');

    # Get layout for this practice
    $arr = array_filter($config, function ($el) use ($practiceID) {
        return $el->id === $practiceID;
    });


    ## If no content is found for this specific practice
    ## Use default content layout
    if (!count($arr)) {
        $arr = array_filter($config, function ($el) {
            return $el->id === 'default';
        });

        if (!count($arr)) {
            exit('No default content layout in content.json');
        }
    }

    return array_values($arr)[0];
}


# Get links
function getLinks($path = [], $practiceID) {
    $config = parseConfigFile('links.json');

    foreach ($path as $node) {
        if (!isset($config[$node])) {
            exit('Bad links category');
        }

        $config = $config[$node]->content;
    }

    $arr = array_filter($config, function ($el) use ($practiceID) {
        if (!isset($el->include) && !isset($el->exclude)) {
            return TRUE;
        }

        if (isset($el->include)) {
            return in_array($practiceID, $el->include);
        }

        return !in_array($practiceID, $el->exclude);
    });

    return $arr;
}


# Sort array of objects by multiple properties
function osort(&$array, $props) {
    if (!is_array($props)) {
        $props = [$props => TRUE];
    }

    usort($array, function($a, $b) use ($props) {
        foreach ($props as $prop => $ascending)  {
            if ($a->$prop != $b->$prop)  {
                if ($ascending) {
                    return $a->$prop > $b->$prop ? 1 : -1;
                }
                
                return $b->$prop > $a->$prop ? 1 : -1;
            }
        }
        return -1; //if all props equal
    });
}
