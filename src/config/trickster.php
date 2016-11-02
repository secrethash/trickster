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
     |
     */

    'api' => array(
        'google'=>array(
            'urlShorten'=>'API_KEY'
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
     |
     */
     
    'apiUrl' => array(
        'google'     => array(
            'urlShorten'    =>  'https://www.googleapis.com/urlshortener/v1/url',
            'suggest'       =>  'http://suggestqueries.google.com/complete/search?output=firefox&client=firefox&hl=en-US&q=%s',
            'youtube'       =>  'http://gdata.youtube.com/feeds/api/videos/%s?v=2&alt=json'
            ),
        'twitter'    => array(
            'social'        =>  'http://urls.api.twitter.com/1/urls/count.json?url=%s'
            ),
        'wikipedia'  => array(
            'askWiki'       =>  'http://en.wikipedia.org/w/api.php?action=opensearch&search=%s&format=xml&limit=1'
            ),
        'facebook'   => array(
            'social'        =>  'https://graph.facebook.com/?ids=%s'
            ),
        'tinyurl'    => array(
            'urlShorten'    =>  'http://tinyurl.com/api-create.php?url=%s'
            ),
        'vimeo'      => array(
            'vimeo'         =>  'http://vimeo.com/api/v2/video/%s.json'
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

    'ts_aTags' => '<a><b><i><s><u><p><pre><code>',


);