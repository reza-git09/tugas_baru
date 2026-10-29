
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST || '127.0.0.1',
    wsPort: Number(import.meta.env.VITE_REVERB_PORT || 8080),
    wssPort: Number(import.meta.env.VITE_REVERB_PORT || 8080),
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME || 'http') === 'https',
    enabledTransports: ['ws', 'wss'],
});

window.Echo.private(`user.${window.userId}`)
    .listen('.order.placed', (event) => {
        console.log('Order baru diterima:', event);

        alert(
            `Order baru berhasil dibuat!\n` +
            `ID Order: ${event.order_id}\n` +
            `Total: Rp ${event.total}\n` +
            `Nama: ${event.user_name}`
        );
    });
