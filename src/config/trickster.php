<?php

return array(

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
     |
     */

    'api' => array(
        'google'        => array(
            'urlShorten'    => 'API_KEY'
            ),
        'exchangerate'  => array(
            'api'       => 'YOUR_API_KEY' #GET IT FROM https://www.exchangerate-api.com/
        )
    ),

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
     |
     */
     
    'apiUrl' => array(
        'google'      => array(
            'urlShorten'    =>  'https://www.googleapis.com/urlshortener/v1/url',
            'suggest'       =>  'https://suggestqueries.google.com/complete/search?output=firefox&client=firefox&hl=en-US&q=%s',
            'youtube'       =>  'https://gdata.youtube.com/feeds/api/videos/%s?v=2&alt=json'
        ),
        'wikipedia'   => array(
            'askWiki'       =>  'https://en.wikipedia.org/w/api.php?action=opensearch&search=%s&format=xml&limit=1'
        ),
        'facebook'    => array(
            'social'        =>  'https://graph.facebook.com/?ids=%s'
        ),
        'tinyurl'     => array(
            'urlShorten'    =>  'https://tinyurl.com/api-create.php?url=%s'
        ),
        'vimeo'       => array(
            'vimeo'         =>  'https://vimeo.com/api/v2/video/%s.json'
        ),
        'exchangerate'=> array(
            'url'           =>  'https://v3.exchangerate-api.com/pair/%s/%s/%s' # /%s/%s/%s => /API_KEY/FROM/TO
        )
    ),

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

    'ts_aTags' => '<a><b><i><s><u><p><pre><code>'


);