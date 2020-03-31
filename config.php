<?php

function getServeurUrl($uri = "") {
    $to_return = array();
    $backend_url['proxy_dev'] = "https://197.159.31.110:8989";
    $backend_url['proxy_test'] = "proxy/dev/api/cashin";
    $backend_url['proxy_prod'] = "https://3629ce4c.ngrok.io";
    $backend_url['admin_dev'] = "https://197.159.31.110:8585";
    $backend_url['admin_test'] = "proxy/dev/api/cashin";
    $backend_url['admin_prod'] = "https://175d0f31.ngrok.io";
    
    $uri = str_replace("/no.php", "", $uri);
    $uri = str_replace("/index.php", "", $uri);

    $uri_as_array = explode("/", $uri);

    $key_url = "no_url";
    if (sizeof($uri_as_array) >= 3) {
        $key_url = $uri_as_array[1] . "_" . $uri_as_array[2];
        unset($uri_as_array[1]);
        unset($uri_as_array[2]);
    }

    $new_url = "http://localhost";
    if (array_key_exists($key_url, $backend_url)) {
        $new_url = $backend_url[$key_url];
    }

    $to_return['new_server'] = $new_url;
    $to_return['new_uri'] = join("/", $uri_as_array);
    return $to_return;
}

function addLog($txt, $module) {
    $fichierlog = "logs/" . $module . "_Log_" . date("d_m_Y") . ".txt";
    if (!file_exists($fichierlog))
        file_put_contents($fichierlog, "");
    file_put_contents($fichierlog, date("[j/m/Y H:i:s]") . " - [CMAX] - $txt \r\n" . file_get_contents($fichierlog));
}
