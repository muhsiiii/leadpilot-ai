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

    if (!business || document.getElementById('leadpilot-widget')) {
        return;
    }

    var isOpen = false;
    var wrapper = document.createElement('div');
    wrapper.id = 'leadpilot-widget';
    wrapper.style.position = 'fixed';
    wrapper.style.right = '20px';
    wrapper.style.bottom = '20px';
    wrapper.style.zIndex = '2147483647';
    wrapper.style.fontFamily = 'Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif';

    var panel = document.createElement('div');
    panel.style.display = 'none';
    panel.style.width = '390px';
    panel.style.maxWidth = 'calc(100vw - 32px)';
    panel.style.height = '620px';
    panel.style.maxHeight = 'calc(100vh - 96px)';
    panel.style.overflow = 'hidden';
    panel.style.border = '1px solid rgba(15, 23, 42, 0.12)';
    panel.style.borderRadius = '14px';
    panel.style.boxShadow = '0 24px 70px rgba(15, 23, 42, 0.28)';
    panel.style.background = '#fff';

    var header = document.createElement('div');
    header.style.display = 'flex';
    header.style.alignItems = 'center';
    header.style.justifyContent = 'space-between';
    header.style.gap = '12px';
    header.style.padding = '12px 14px';
    header.style.background = '#020617';
    header.style.color = '#fff';

    var title = document.createElement('div');
    title.textContent = 'AI assistant';
    title.style.fontSize = '14px';
    title.style.fontWeight = '700';

    var close = document.createElement('button');
    close.type = 'button';
    close.textContent = 'Close';
    close.style.border = '0';
    close.style.borderRadius = '8px';
    close.style.padding = '6px 9px';
    close.style.background = 'rgba(255,255,255,0.12)';
    close.style.color = '#fff';
    close.style.cursor = 'pointer';
    close.style.fontSize = '12px';
    close.style.fontWeight = '700';

    var frame = document.createElement('iframe');
    frame.id = 'leadpilot-widget-frame';
    frame.src = '{$chatBaseUrl}/' + encodeURIComponent(business) + '/chat';
    frame.title = 'LeadPilot AI assistant';
    frame.style.display = 'block';
    frame.style.width = '100%';
    frame.style.height = 'calc(100% - 48px)';
    frame.style.border = '0';
    frame.style.background = '#fff';

    var launcher = document.createElement('button');
    launcher.type = 'button';
    launcher.textContent = 'Chat with AI';
    launcher.style.display = 'inline-flex';
    launcher.style.alignItems = 'center';
    launcher.style.justifyContent = 'center';
    launcher.style.border = '0';
    launcher.style.borderRadius = '999px';
    launcher.style.padding = '14px 18px';
    launcher.style.marginTop = '12px';
    launcher.style.background = '#047857';
    launcher.style.color = '#fff';
    launcher.style.boxShadow = '0 16px 40px rgba(4, 120, 87, 0.28)';
    launcher.style.cursor = 'pointer';
    launcher.style.fontSize = '14px';
    launcher.style.fontWeight = '800';

    function setOpen(open) {
        isOpen = open;
        panel.style.display = isOpen ? 'block' : 'none';
        launcher.textContent = isOpen ? 'Hide assistant' : 'Chat with AI';
    }

    launcher.addEventListener('click', function () {
        setOpen(!isOpen);
    });

    close.addEventListener('click', function () {
        setOpen(false);
    });

    header.appendChild(title);
    header.appendChild(close);
    panel.appendChild(header);
    panel.appendChild(frame);
    wrapper.appendChild(panel);
    wrapper.appendChild(launcher);
    document.body.appendChild(wrapper);
})();
JS;

        return response($script, 200)->header('Content-Type', 'application/javascript');
    }
}
