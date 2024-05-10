<?php
function view($page, $data=[]) {
    extract($data);
    include 'view/'.$page.'.php';
}

class Router { 
    public static $urls = [];

    function __construct() {
        $url = implode("/", 
            array_filter(
                explode("/", 
                    str_replace($_ENV['BASEDIR'], "", 
                        parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
                    )
                ), 'strlen'
            )
        );

        if (!in_array($url, self::$urls['routes'])) {
            header('Location: '.BASEURL);
        }

        $call = self::$urls[$_SERVER['REQUEST_METHOD']][$url];
        $call();
    }
    public static function url($url, $method, $callback) {
        if ($url == '/') { $url = ''; }
        self::$urls[strtoupper($method)][$url] = $callback;
        self::$urls['routes'][] = $url;
        self::$urls['routes'] = array_unique(self::$urls['routes']);
    }
}

function urlpath($path) {
    require_once 'config/static.php';
    return BASEURL.$path;
}

function freshdb() {
    require_once 'model/user_model.php';
    require_once 'model/contact_model.php';
    global $conn;
    $conn->query('DELETE FROM contact_owner');
    $conn->query('ALTER TABLE contact_owner AUTO_INCREMENT = 1');

    User::register([
        'name' => $_ENV['NAME'],
        'email' => $_ENV['EMAIL'],
        'password' => $_ENV['PASSWORD']
    ]);

    $contacts = array(
        ['082355441526', 'Lili Permatasari'],
        ['0827282019882', 'Jajang'],
        ['0846582418365', 'Jarwo Tedjo Ramsi'],
        ['086101533627', 'Didik Waluyo'],
        ['082355441526', 'Beben'],
        ['087645183521', 'Ririn Pascal']
    );

    foreach ($contacts as $c) {
        Contact::insert([
            'phone_number' => $c[0],
            'owner' => $c[1]
        ]);
    }
    view('freshdb');
    session_destroy();
}
