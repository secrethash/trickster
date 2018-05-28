<?php

return [

    /*
     |--------------------------------------------------------------------------
     | API KEY(s)
     |--------------------------------------------------------------------------
     | * API keys for some of the Tricks to work.
     |   + Google
     |     - URL Shortener: Google API key for URL Shortener. Get the active api key from Google.
     |     - URL Shortener: Login to Google Console to get the API key.
     |   + Exchange Rate
     |     - Currency Converter API KEY
     |   + Currency Layer
     |     - Currency Converter API Key
     |
     */

    'api' => [
        'google'        => [
            'urlShorten'    => '',
        ],
        'exchangerate'  => [
            'api'       => '', # GET IT FROM https://www.exchangerate-api.com/
        ],
        'currencylayer'  => [
            'api'       => '', # GET IT FROM https://www.currencylayer.com/
        ],
    ],

    /*
     |-------------------------------------------------------------------------------------
     | API URLS
     |-------------------------------------------------------------------------------------
     |
     | * URL where the APIs will send the data and get the response from
     |   + Google
     |     - URL SHORTENER:     API url for Url Shortner
     |     - SUGGEST:           API url for Google Suggest
     |     - YouTube:           API url to get the video data. For: YouTube Embed & Video Info
     |   + Twitter
     |     - Social Analytics:  API url to get the Tweets Count.
     |   + Wikipedia
     |     - Wikipedia Grabber: API url to get the Definitions.
     |   + Facebook
     |     - Social Analytics:  API url to get Likes Count.
     |   + TinyURL
     |     - URL SHORTENER:     API url for Url Shortener
     |   + ExchangeRate
     |     - url:               API URL for www.exchangerate-api.com
     |   + CurrencyLayer
     |     - url:               API URL for currencylayer.com
     |
     */
     
    'apiUrl' => [
        'google'      => [
            'urlShorten'    =>  'https://www.googleapis.com/urlshortener/v1/url',
            'suggest'       =>  'https://suggestqueries.google.com/complete/search?output=firefox&client=firefox&hl=en-US&q=%s',
            'youtube'       =>  'https://gdata.youtube.com/feeds/api/videos/%s?v=2&alt=json',
        ],
        'wikipedia'   => [
            'askWiki'       =>  'https://en.wikipedia.org/w/api.php?action=opensearch&search=%s&format=xml&limit=1',
        ],
        'facebook'    => [
            'social'        =>  'https://graph.facebook.com/?ids=%s',
        ],
        'tinyurl'     => [
            'urlShorten'    =>  'https://tinyurl.com/api-create.php?url=%s',
        ],
        'vimeo'       => [
            'vimeo'         =>  'https://vimeo.com/api/v2/video/%s.json',
        ],
        'exchangerate'=> [
            'url'           =>  'https://v3.exchangerate-api.com/pair/%s/%s/%s', # /%s/%s/%s => /API_KEY/FROM/TO
        ],
        'currencylayer'=> [
            'url'           =>  'http://apilayer.net/api/live?access_key=%s&currencies=%s&format=1', # /%s/%s/%s => ?API_KEY&FROM/TO
        ],
    ],

    /*
     |--------------------------------------------------------------------------
     | Allowed TAGS
     |--------------------------------------------------------------------------
     |
     | Here specify the allowed tag HTML tags for Tag Sweeper.
     | Tag Sweeper will skip the tags mentioned here.
     | Add More tags that you wish not to be removed.
     | Remove tags that you wish should be removed.
     | Just add the start of the tags.
     |
     | Example:
     |          'ts_aTags' => '<a><b><i><s><u><p><pre><code>',
     |
     */

    'ts_aTags' => '<a><b><i><s><u><p><pre><code>',

    /**
     * ---------------------------------------------------------------------------
     * Currency Converter Configurations
     * ---------------------------------------------------------------------------
     * 
     * # Configuration Items
     * - converter: The Convert Service that will be used to convert the Currency.
     *  + exchangerate: Use the exchangerate-api.com API
     *  + currencylayer: Use the Currency Layer API
     *  + smartconvert: Covert Using Smart Convertion Algorithm. It increases your
     *                  conversion limit quota. Smart Convert uses all the active
     *                  apis that you have setup or provided the API for.
     * - cache: Caching is done to reduce the cost and improve the monthly quota limit.
     *  + The Time is in minutes.
     *  + Lesser the Time more quota is used. 
     *  + Set 'cache' => 0, (Zero) for realtime updates from the server.
     *  + Note: The server (exchangerate-api.com/currencylayer.com) upadtes the rate on hourly basis only,
     *          so the quota will be utilized whereas the rate might not change.
     */
    'currency' => [
        'converter' => NULL, # By default it utilizes smart conversion
        'cache'     => 30, # Set it to 0 for real-time.
    ],


    ];