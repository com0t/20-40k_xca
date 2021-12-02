<?php
namespace ShortPixel\AI;

class AccessControlHeaders {

    const APACHE = 'apache';
    const LITESPEED = 'litespeed';
    const NGINX = 'nginx';

    public static function getServerName() {
        $server = getenv('SERVER_SOFTWARE');
        if(stripos($server, self::APACHE) !== false) return self::APACHE;
        if(stripos($server, self::LITESPEED) !== false) return self::APACHE;
        if(stripos($server, self::NGINX) !== false) return self::NGINX;
        return 'unknown';
    }

    /**
     * get the Access-Control-Allow-Origin header for Nginx for the $origin domain
     * @param $origin
     */
    public static function getAllowOriginNginx() {
        return 'location ~* \.(css|js|eot|otf|ttf|woff|woff2|svg)($|\?.*) {
    add_header Access-Control-Allow-Origin *;
}';
    }

    /**
     * get the Access-Control-Allow-Origin header for Apache for the $origin domain
     * @param $origin
     */
    public static function getAllowOriginApache() {
        return
            '
<IfModule mod_headers.c>
    <FilesMatch "\.(css|js|eot|otf|ttf|woff|woff2|svg)($|\?.*)">
        Header add Access-Control-Allow-Origin: "*"
    </FilesMatch>
</IfModule>';
    }

    public static function addHeadersToHtaccess() {
        if(self::getServerName() === self::APACHE) {
            $lines = '# Allow initial redirect to origin of CSS, JS and Font resources from the CDN (while they\'re processed by ShortPixel).'
            . self::getAllowOriginApache() . '
';
            $success = insert_with_markers( get_home_path() . '.htaccess', 'ShortPixel Adaptive Images', $lines);
            return ($success ? 1 : -1);
        }
        return 0;
    }

    public static function removeHeadersFromHtaccess() {
        if(self::getServerName() === 'apache') {
            return (insert_with_markers(get_home_path() . '.htaccess', 'ShortPixel Adaptive Images', '') ? 1 : -1);
        }
        return 0;
    }


}