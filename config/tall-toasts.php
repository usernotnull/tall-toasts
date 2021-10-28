<?php

return [
    /*
     * How long each toast will be displayed before fading out, in ms
     */
    'duration' => 5000,

    /*
     * How long to wait before displaying the toasts after page loads, in ms
     */
    'load_delay' => 400,

    /*
     * Session keys used.
     * No need to edit unless the keys are already being used and conflict.
     */
    'session_keys' => [
        'toasts' => 'toasts',
        'toasts_next_page' => 'toasts-next',
    ],
];
