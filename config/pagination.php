<?php

return [
    // Application defaults
    'default' => [
        'current_page'      => ['source' => 'query_string', 'key' => 'page'], // source: "query_string" or "route"
        'total_items'       => 0,
        'items_per_page'    => 25,
        'view'              => 'pagination/floating',
        'auto_hide'         => false,
        'first_page_in_url' => FALSE,
    ],

];
