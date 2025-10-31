<?php
// Router pour le serveur PHP intégré
// Ce fichier gère le routage des requêtes

$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);

// Si le fichier demandé existe et n'est pas un fichier PHP, on le retourne tel quel
if ($path !== '/' && file_exists($_SERVER['DOCUMENT_ROOT'] . $path)) {
    // Vérifier si c'est un fichier statique (CSS, JS, images, etc.)
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $static_extensions = ['css', 'js', 'jpg', 'jpeg', 'png', 'gif', 'svg', 'ico', 'woff', 'woff2', 'ttf', 'eot', 'pdf'];
    
    if (in_array(strtolower($ext), $static_extensions)) {
        return false; // Laisser le serveur PHP gérer le fichier statique
    }
}

// Si c'est la racine, servir index.html
if ($path === '/') {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/index.html')) {
        header('Content-Type: text/html; charset=UTF-8');
        readfile($_SERVER['DOCUMENT_ROOT'] . '/index.html');
        exit;
    }
}

// Si c'est un fichier PHP, l'exécuter
if (file_exists($_SERVER['DOCUMENT_ROOT'] . $path) && pathinfo($path, PATHINFO_EXTENSION) === 'php') {
    return false; // Laisser PHP exécuter le fichier
}

// Pour les chemins sans extension, chercher un fichier .php ou .html
if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $path)) {
    $possible_files = [
        $_SERVER['DOCUMENT_ROOT'] . $path . '.php',
        $_SERVER['DOCUMENT_ROOT'] . $path . '.html',
        $_SERVER['DOCUMENT_ROOT'] . $path . '/index.php',
        $_SERVER['DOCUMENT_ROOT'] . $path . '/index.html',
    ];
    
    foreach ($possible_files as $file) {
        if (file_exists($file)) {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if ($ext === 'php') {
                include $file;
                exit;
            } elseif ($ext === 'html') {
                header('Content-Type: text/html; charset=UTF-8');
                readfile($file);
                exit;
            }
        }
    }
}

// Si rien n'a été trouvé, retourner false pour laisser PHP gérer
return false;
?>
