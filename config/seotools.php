<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'inertia' => env('SEO_TOOLS_INERTIA', false),
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => 'Rental Mobil Tasikmalaya | CJA Rent Car',
            'titleBefore'  => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description'  => 'Rental mobil Tasikmalaya dengan pilihan lepas kunci dan driver. Armada terawat, harga jelas, booking cepat via WhatsApp.',
            'separator'    => ' | ',
            'keywords'     => ['rental mobil tasikmalaya', 'sewa mobil tasikmalaya', 'rental mobil tasikmalaya lepas kunci', 'rental mobil tasikmalaya dengan driver', 'harga sewa mobil tasikmalaya', 'CJA Rent Car'],
            'canonical'    => 'full', // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'robots'       => 'index, follow', // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => env('GOOGLE_SEARCH_CONSOLE', null),
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'Rental Mobil Tasikmalaya | CJA Rent Car',
            'description' => 'Rental mobil Tasikmalaya dengan armada terawat, driver profesional, dan pemesanan cepat.',
            'url'         => null, // Set null for using Url::current(), set false to total remove
            'type'        => 'website',
            'site_name'   => 'CJA Rent Car',
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            'card'        => 'summary_large_image',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => 'Rental Mobil Tasikmalaya | CJA Rent Car', // set false to total remove
            'description' => 'Rental mobil Tasikmalaya untuk harian, antar jemput, dan driver dengan booking cepat via WhatsApp.', // set false to total remove
            'url'         => false, // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];
