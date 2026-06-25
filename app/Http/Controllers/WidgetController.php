<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class WidgetController extends Controller
{
    public function __invoke(): Response
    {
        $chatBaseUrl = url('/b');

        $script = <<<JS
(function () {
    var currentScript = document.currentScript;
    var business = currentScript && currentScript.dataset.business;

    if (!business || document.getElementById('leadpilot-widget-frame')) {
        return;
    }

    var frame = document.createElement('iframe');
    frame.id = 'leadpilot-widget-frame';
    frame.src = '{$chatBaseUrl}/' + encodeURIComponent(business) + '/chat';
    frame.title = 'LeadPilot AI assistant';
    frame.style.position = 'fixed';
    frame.style.right = '20px';
    frame.style.bottom = '20px';
    frame.style.width = '390px';
    frame.style.maxWidth = 'calc(100vw - 32px)';
    frame.style.height = '620px';
    frame.style.maxHeight = 'calc(100vh - 32px)';
    frame.style.border = '0';
    frame.style.borderRadius = '12px';
    frame.style.boxShadow = '0 24px 60px rgba(15, 23, 42, 0.22)';
    frame.style.zIndex = '2147483647';
    frame.style.background = '#fff';

    document.body.appendChild(frame);
})();
JS;

        return response($script, 200)->header('Content-Type', 'application/javascript');
    }
}
