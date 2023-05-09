import _ from 'lodash';
import Echo from 'laravel-echo';
import io from 'socket.io-client';
window.io = io;
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// CSRF TOKEN HACK
const name = 'XSRF-TOKEN';
const cookies = '; ' + document.cookie;
const parts = cookies.split('; ' + name + '=');
let value = parts.length == 2 ? parts.pop().split(';').shift() : null;
value = decodeURIComponent(value);

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: "http://154.49.216.217:6003",
    csrfToken: value,
});

/**
 * Funny little cactus :)
 */

console.log("%c🌵", "font-size: 100px;");
console.log("%cWhat are you doing here? 🤔", "color: #bada55; font-size: 20px; padding: 10px; font-weight: bold;");
