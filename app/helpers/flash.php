<?php

use app\classes\Flash;

function getFlash(string $key)
{
    $flash = Flash::get($key);

    if (isset($flash['message'])) {
        $alertType = $flash['alert'] == 'success' ? 'success' : 'danger';
        return "<div class='uk-alert-$alertType' uk-alert><a class='uk-alert-close' uk-close></a><p>{$flash['message']}</p></div>";
    }
    
    return '';
}

function getFlashModal(string $key)
{
    $flash = Flash::get($key);

    if (isset($flash['message'])) {
        $alertType = $flash['alert'] == 'success' ? 'success' : 'danger';
        return "  <p class='uk-alert-$alertType'>{$flash['message']}</p>";
    }
    
    return '';
}

function old(string $key)
{
    $flash = Flash::get('old_' . $key);

    return $flash['message'] ?? '';
}
?>
