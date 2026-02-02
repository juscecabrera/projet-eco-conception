<?php
// ---------- SIMPLE FILE CACHE ----------

// Dossier cache (dans le même dossier que admin.php)
define('CACHE_PATH', __DIR__ . '/cache/');

// Crée le dossier si absent
if (!is_dir(CACHE_PATH)) {
    mkdir(CACHE_PATH, 0777, true);
}

// Lire cache
function cache_get($key, $ttl = 60) {

    $file = CACHE_PATH . md5($key) . '.cache';

    if (file_exists($file)) {

        if (time() - filemtime($file) < $ttl) {

            return unserialize(file_get_contents($file));
        }
    }

    return false;
}

// Écrire cache
function cache_set($key, $data) {

    $file = CACHE_PATH . md5($key) . '.cache';

    file_put_contents($file, serialize($data));
}

// Supprimer cache
function cache_delete($key) {

    $file = CACHE_PATH . md5($key) . '.cache';

    if (file_exists($file)) {
        unlink($file);
    }
}


function cache_clear_all() {

    foreach (glob(CACHE_PATH . '*.cache') as $file) {
        unlink($file);
    }
}
