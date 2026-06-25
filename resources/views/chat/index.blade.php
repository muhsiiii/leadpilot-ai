<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $business->name }} AI Assistant</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-950">
    <main class="mx-auto grid min-h-screen max-w-6xl gap-6 px-4 py-6 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
        <section class="space-y-6">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">{{ $business->type ?? 'Local business' }}</p>
                <h1 class="mt-2 text-4xl font-bold leading-tight sm:text-5xl">{{ $business->name }}</h1>
                <p class="mt-4 max-w-xl text-lg text-slate-700">{{ $business->description }}</p>
            </div>

            <div class="grid gap-3 sm:grid-cols-2">
                <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                    <p class="text-sm font-semibold text-slate-500">Opening Hours</p>
                    <p class="mt-1 text-slate-900">{{ $business->opening_hours ?? 'Ask in chat' }}</p>
                </div>
                <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                    <p class="text-sm font-semibold text-slate-500">Location</p>
                    <p class="mt-1 text-slate-900">{{ $business->address ?? 'Ask in chat' }}</p>
                </div>
            </div>

            <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-sm font-semibold text-slate-500">Popular Services</p>
                <div class="mt-3 space-y-3">
                    @foreach ($business->activeServices as $service)
                        <div class="flex items-start justify-between gap-4 border-t border-slate-100 pt-3 first:border-t-0 first:pt-0">
                            <div>
                                <p class="font-semibold">{{ $service->name }}</p>
                                <p class="text-sm text-slate-600">{{ $service->description }}</p>
                            </div>
                            @if ($service->price_from)
                                <p class="shrink-0 rounded-md bg-emerald-50 px-2 py-1 text-sm font-semibold text-emerald-800">INR {{ number_format($service->price_from) }}+</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="rounded-lg border border-slate-200 bg-white shadow-xl">
            <div class="border-b border-slate-200 p-5">
                <p class="text-lg font-bold">Ask the AI assistant</p>
                <p class="mt-1 text-sm text-slate-600">Get quick answers and leave your phone number for a callback.</p>
            </div>

            <div id="chatBox" class="h-[32rem] space-y-3 overflow-y-auto bg-slate-50 p-5">
                <div class="max-w-[85%] rounded-lg bg-white p-3 text-slate-800 shadow-sm">
                    Hi, I can answer questions about services, pricing, timing, and callback requests. How can I help?
                </div>
            </div>

            <form id="chatForm" class="flex gap-2 border-t border-slate-200 p-4">
                <input
                    id="messageInput"
                    type="text"
                    class="min-w-0 flex-1 rounded-lg border-slate-300 px-4 py-3 text-sm focus:border-emerald-600 focus:ring-emerald-600"
                    placeholder="Ask about services, pricing, timing, or a callback"
                    autocomplete="off"
                    required
                >

                <button class="rounded-lg bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700">
                    Send
                </button>
            </form>
        </section>
    </main>

    <script>
        const chatForm = document.getElementById('chatForm');
        const messageInput = document.getElementById('messageInput');
        const chatBox = document.getElementById('chatBox');

        function addMessage(text, type) {
            const div = document.createElement('div');

            div.className = type === 'user'
                ? 'ml-auto max-w-[85%] rounded-lg bg-emerald-700 p-3 text-right text-white shadow-sm'
                : 'max-w-[85%] rounded-lg bg-white p-3 text-slate-800 shadow-sm';

            div.innerText = text;
            chatBox.appendChild(div);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        chatForm.addEventListener('submit', async function (event) {
            event.preventDefault();

            const message = messageInput.value.trim();

            if (!message) {
                return;
            }

            addMessage(message, 'user');
            messageInput.value = '';
            messageInput.disabled = true;

            try {
                const response = await fetch('{{ $sendRoute }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ message }),
                });

                const data = await response.json();
                addMessage(data.reply || 'Sorry, I could not reply right now.', 'assistant');
            } catch (error) {
                addMessage('Sorry, something went wrong. Please try again.', 'assistant');
            } finally {
                messageInput.disabled = false;
                messageInput.focus();
            }
        });
    </script>
</body>
</html>
