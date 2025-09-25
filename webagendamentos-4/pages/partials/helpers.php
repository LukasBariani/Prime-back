<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!function_exists('asset')) {
    function asset(string $path): string {
        
        $full = __DIR__ . '/../' . $path;
        if (file_exists($full)) {
            return $path . '?v=' . filemtime($full);
        }
        return $path;
    }
}

?>
