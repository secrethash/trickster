<?php

namespace Secrethash\Trickster;

use Log;
use Cache;


class Trickster
{

    /**
     * Facebook api url for get likes
     * @var string
     */
    protected $_facebookUrl = '';

    /**
     * Google api key from short urls
     * @var null
     */
    protected $_googleApiKey = '';

    /**
     * Google api url for shorting urls
     * @var string
     */
    protected $_googleShortApiUrl = '';

    /**
     * TinyURL api url for shorting urls
     * @var string
     */
    protected $_tinyUrlShortApiUrl = '';

    /**
     * Allowable tags for clean function
     * @var string
     */
    protected $_allowableTags = '';

    /**
     * Wikipedia url for api
     * @var string
     */
    protected $_wikiApiUrl = '';

    /**
     * Google url for suggest keywords
     * @var string
     */
    protected $_googleSuggestApiUrl = '';

    /**
     * Get youtube video data from api
     * @var string
     */
    protected $_youtubeVideoApi = '';

    /**
     * Get vimeo video data from api
     * @var string
     */
    protected $_vimeoVideoApi = '';

    /**
     * Exchange Rate API
     * @var string
     */
    protected $_exchangeRateApi = '';
    protected $_exchangeRateApiKey = '';
    
    /**
     * Currency Layer API
     * @var string
     */
    protected $_currencyLayerApi = '';
    protected $_currencyLayerApiKey = '';

    /**
     * Currency Converter
     * @var string
     */
    protected $_currencyConverter = '';

    /**
     * Cache Timeout or Expiry
     * @var string
     */
    protected $_currencyCacheTimeout = '';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        //
        $this->_facebookUrl = config('trickster.apiUrl.facebook.social');
        $this->_googleApiKey = config('trickster.api.google.urlShorten');
        $this->_googleShortApiUrl = config('trickster.apiUrl.google.urlShorten');
        $this->_googleSuggestApiUrl = config('trickster.apiUrl.google.suggest');
        $this->_tinyUrlShortApiUrl = config('trickster.apiUrl.tinyurl.urlShorten');
        $this->_allowableTags = config('trickster.ts_aTags');
        $this->_wikiApiUrl = config('trickster.apiUrl.wikipedia.askWiki');
        $this->_youtubeVideoApi = config('trickster.apiUrl.google.youtube');
        $this->_vimeoVideoApi = config('trickster.apiUrl.vimeo.vimeo');
        $this->_exchangeRateApi = config('trickster.apiUrl.exchangerate.url');
        $this->_exchangeRateApiKey = config('trickster.api.exchangerate.api');
        $this->_currencyLayerApi = config('trickster.apiUrl.currencylayer.url');
        $this->_currencyLayerApiKey = config('trickster.api.currencylayer.api');
        $this->_currencyConverter = config('trickster.currency.converter');
        $this->_currencyCacheTimeout = config('trickster.currency.cache');
    }
    
    /**
     * Yo can truncate text and specify number of characters you want to show
     * @param  string $text   Input the text that you want to cut
     * @param  int    $number Number of characters you want to show
     * @param  string $suffix What do you want to show at the end
     * @return mixed          Return truncated text with suffix
     */
    public function truncator($text, $number, $suffix = ' ...see more')
    {
        if (!empty($text) && intval($number)) {
            if(strlen($text) > $number) {
                return mb_substr($text, 0, mb_strpos($text, ' ', $number, 'UTF-8'), 'UTF-8') . $suffix;
            }
            return $text;
        }
        return false;
    }

    /**
     * This function validates a given email address
     * @param  string $email Email address for validate
     * @return bool          Return true when email is valid and return false when email is invalid
     */
    public function emailValid($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * This function is useful if you would like to generate clean a URL
     * @param  string $string The text that you want to convert
     * @return mixed          Return slug-clean-url
     */
    public function slug($string)
    {
        if (!empty($string)) {
            return strtolower(
                preg_replace(
                    array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'),
                    array('', '-', ''), $string)
                );
        }
        return false;
    }

    /**
     * This function convert a date and time string into xx time ago
     * Give the data and time string in this format: yyyy-mm-dd hh:ii:ss and it will return you the time ago
     * @param  string  $datetime Date and time string
     * @param  boolean $full     true for full time ago e.g: 6 months, 1 week, 23 hours, 51 minutes, 21 seconds ago
     *                           false for only first time e.g: 6 months ago
     * @return mixed             Return converted date and time in xx time ago format
     */
    public function timeAgo($date)
    { 
        if(!empty($date)) {
        
            $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
            $lengths         = array("60","60","24","7","4.35","12","10");
            
            $now             = time();
            $unix_date         = strtotime($date);
            
               // check validity of date
            if(empty($unix_date)) {    
                return "Bad date";
            }

            // is it future date or past date
            if($now > $unix_date) {    
                $difference     = $now - $unix_date;
                $tense         = "ago";
                
            } else {
                $difference     = $unix_date - $now;
                $tense         = "from now";
            }
            
            for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
                $difference /= $lengths[$j];
            }
            
            $difference = round($difference);
            
            if($difference != 1) {
                $periods[$j].= "s";
            }
            
            return "$difference $periods[$j] {$tense}";
        }
        else {
            return False;
        }
    }

    /**
     * This function return number of shares or tweets of the specified page
     * @param  string $network Social network, facebook or twitter
     * @param  string $url     Url for get shares or tweets
     * @return mixed           Return number of shares or tweets
     */
    public function social($network, $url)
    {
        if (!empty($network) && !empty($url)) {
            if ($network == 'facebook') {
                $url_data = sprintf($this->_facebookUrl, $url);
            }

            switch ($network) {

                case 'facebook':
                    $result = $this->_socialCurl($url_data);

                    if (!$result[$url]['share'])
                    {
                        return '0';
                    }
                    else
                    {
                        $data = array(
                            'comments'=>$result[$url]['share']['comment_count'],
                            'shares'=>$result[$url]['share']['share_count']
                            );
                        return (object)$data;
                    }
                    // print_r($result); // Classic Debugger :P
                    break;
                
                default:
                    return false;
                    break;
            }
        }
        return false;
    }

    /**
     * If you want to generate a shorten url simply use this function
     * @param  string $url      Used for shorten
     * @param  string $provider Used two providers, tinyurl and google
     * @return mixed            Return url shortened
     */
    public function shortenUrl($url, $provider)
    {
        if (!empty($url) && !empty($provider)) {
            if ($provider == 'tinyurl') {
                $url_data = sprintf($this->_tinyUrlShortApiUrl, $url);
            } elseif ($provider == 'google') {
                $url_data = sprintf('%s/url', $this->_googleShortApiUrl);
            }

            switch ($provider) {
                case 'tinyurl':
                    $ch = curl_init($url_data);  
                    $timeout = 5;  
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);  
                    $result = curl_exec($ch);  
                    curl_close($ch);

                    return $result; 
                    break;

                case 'google':
                    $ch = curl_init($url_data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $requestData = array(
                        'longUrl' => $url
                    );

                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
                    $result = json_decode(curl_exec($ch), true);
                    curl_close($ch);

                    return $result['id'];
                    break;
                
                default:
                    return false;
                    break;
            }
        }
        return false;
    }

    /**
     * This function replaces all youtube link into videos
     * @param  string  $url    The url to the video
     * @param  integer $width  The width of the player in pixels
     * @param  integer $height The height of the player in pixels
     * @param  string  $theme  Color of the player "dark" or "light"
     * @return mixed           Return youtube video player
     */
    public function youtube($url, $width = 400, $height = 250, $theme = 'dark')
    {
        if (!empty($url) && intval($width) && intval($height) && !empty($theme)) {
            preg_match('/(?<=v(\=|\/))([-a-zA-Z0-9_]+)|(?<=youtu\.be\/)([-a-zA-Z0-9_]+)/', $url, $v);

            return "<iframe src=\"https://www.youtube.com/embed/{$v[0]}?theme={$theme}&amp;iv_load_policy=3&amp;wmode=transparent\"
                    allowfullscreen=\"\" frameborder=\"0\" width=\"{$width}\" height=\"{$height}\" ></iframe>
            ";
        }
        return false;
    }

    /**
     * This function replaces all vimeo link into videos
     * @param  string  $url    The url to the video
     * @param  integer $width  The width of the player in pixels
     * @param  integer $height The height of the player in pixels
     * @return mixed           Return vimeo video player
     */
    public function vimeo($url, $width = 400, $height = 250)
    {
        if (!empty($url) && intval($width) && intval($height)) {
            preg_match('(\d+)', $url, $id);

            return "<iframe src=\"https://player.vimeo.com/video/$id[0]?title=0&amp;byline=0&amp;portrait=0\"
                    webkitallowfullscreen=\"\" mozallowfullscreen=\"\" allowfullscreen=\"\" frameborder=\"0\"
                    width=\"{$width}\" height=\"{$height}\"></iframe>
            ";
        }
        return false;
    }

    /**
     * Create an encryption string with a special algorithm and key
     * @param  string $algo   The algorithm to use
     * @param  string $string The string to encrypt
     * @param  string $key    A salt to apply to the encryption
     * @return string         Return encrypted key
     */
    public function encryptString($algo, $string, $key = null)
    {     
        if (!empty($algo) && !empty($string)) {   
            if ($key == null) {
                $ctx = hash_init($algo);
            } else {
                $ctx = hash_init($algo, HASH_HMAC, $key);
                hash_update($ctx, $string);
            }
            return hash_final($ctx);
        }
        return false;
    }

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     * @param  string $email The email address
     * @param  string $s     Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param  string $d     Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param  string $r     Maximum rating (inclusive) [ g | pg | r | x ]
     * @param  bool   $img   True to return a complete IMG tag False for just the URL
     * @param  array  $atts  Optional, additional key/value attributes to include in the IMG tag
     * @return string        Containing either just a URL or a complete image tag
     * @source               https://gravatar.com/site/implement/images/php/
     */
    public function gravatar($email, $s = 100, $d = 'mm', $r = 'g', $img = false, $atts = array())
    {
        if (!empty($email)) {
            $url = 'https://www.gravatar.com/avatar/';
            $url .= md5(strtolower(trim($email)));
            $url .= "?s={$s}&d={$d}&r={$r}";
            if ($img) {
                $url = "<img src=\"{$url}\"";
                foreach ($atts as $key => $val)
                $url .= " {$key}=\"{$val}\"";
                $url .= " />";
            }
            return $url;
        }
        return false;
    }

    /**
     * This function converts the following bbcodes into html
     * @param  string $string BBcodes you can to converts
     * @return mixed          Return html
     */
    public function bbcode($string)
    {
        if (!empty($string)) {
            $search = array(
                '@\[(?i)b\](.*?)\[/(?i)b\]@si',
                '@\[(?i)i\](.*?)\[/(?i)i\]@si',
                '@\[(?i)u\](.*?)\[/(?i)u\]@si',
                '@\[(?i)img=(.*?)\](.*?)\[/(?i)img\]@si',
                '@\[(?i)youtube\](.*?)\[/(?i)youtube\]@si',
                '@\[(?i)vimeo\](.*?)\[/(?i)vimeo\]@si',
                '@\[(?i)p\](.*?)\[/(?i)p\]@si',
                '@\[(?i)br/\]@si',
                '@\[(?i)url=(.*?)\](.*?)\[/(?i)url\]@si',
            );

            $replace = array(
                '<b>\\1</b>',
                '<i>\\1</i>',
                '<u>\\1</u>',
                '<img src="\\1" alt="\\2" />',
                '<iframe width="400" height="250" src="https://www.youtube.com/embed/\\1?theme=dark&iv_load_policy=3&wmode=transparent" frameborder="0" allowfullscreen></iframe>',
                '<iframe src="https://player.vimeo.com/video/\\1?title=0&amp;byline=0&amp;portrait=0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" frameborder="0" width="400" height="250"></iframe>',
                '<p>\\1</p>',
                '<br/>',
                '<a href="\\1">\\2</a>'
            );
            return preg_replace($search , $replace, $string);
        }
        return false;
    }

    /**
     * Get filename last extension
     * @param  string $file File name
     * @return mixed        Return last file name extension
     */
    public function getExtension($file)
    {
        if (!empty($file)) {
            return substr(strrchr($file, '.'), 1);
        }
        return false;
    }

    /**
     * This function clean any text by removing unwanted tags
     * @param  string $string Text for removing unwanted tags
     * @return mixed          Return cleaned text
     */
    public function clean($string)
    {
        if (!empty($string)) {
            $string = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $string);
            $string = htmlspecialchars(strip_tags($string, $this->_allowableTags));
            $string = str_replace('href=', 'rel="nofollow" href=', $string);

            return $string;
        }
        return false;
    }

    /**
     * Get wikipedia definition
     * @param  string $keyword Keyword for get definition
     * @return mixed           Return array with description and url
     */
    public function wiki($keyword)
    {
        if (!empty($keyword)) {
            $ch = curl_init(sprintf($this->_wikiApiUrl, $keyword));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            $error = curl_errno($ch);
            curl_close($ch);

            // $xml = simplexml_load_string($result);
            // if ((string)$xml->Section->Item->Description) {
            //     return array(
            //         (string)$xml->Section->Item->Text,
            //         (string)$xml->Section->Item->Description,
            //         (string)$xml->Section->Item->Url
            //     );
            echo $result;
            if ($result)
            {
                $json = json_decode($result);
                if ($json->description) {
                    return array($json->Text, $json->Description, $json->Url);
                }
            }
            else {
               echo $error;
            }
            return false;
        }
        return false;
    }

    /**
     * Get google suggest for keywords
     * @param  string $keyword Keyword for get suggest
     * @return mixed           Return array with suggest data
     */
    public function suggest($keyword)
    {
        if (!empty($keyword)) {
            $ch = curl_init(sprintf($this->_googleSuggestApiUrl, $keyword));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/json'));
            $result = json_decode(curl_exec($ch), true);
            curl_close($ch);    

            return $result[1];

        }
        return false;
    }

    /**
     * This function get real ip address
     * @return int return ip
     */
    public function ip() 
    {
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && ! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') > 0) {
                $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
                return trim($addr[0]);
            } else {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    /**
     * Get video info from youtube and vimeo
     * @param  string $url Url for video info, youtube or vimeo
     * @return mixed       Return array with video information
     */
    public function getVideoInfo($url)
    {
        if (!empty($url)) {
            if (strpos($url, 'youtube')) {
                preg_match('/(?<=v(\=|\/))([-a-zA-Z0-9_]+)|(?<=youtu\.be\/)([-a-zA-Z0-9_]+)/', $url, $v);
                $provider = 'youtube';
                $url_data = sprintf($this->_youtubeVideoApi, $v[0]);
            } elseif (strpos($url, 'vimeo')) {
                preg_match('(\d+)', $url, $id);
                $provider = 'vimeo';
                $url_data = sprintf($this->_vimeoVideoApi, $id[0]);
            }

            switch ($provider) {
                case 'youtube':
                    $ch = curl_init($url_data);  
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/json')); 
                    $result = json_decode(curl_exec($ch), true);
                    curl_close($ch);

                    return array(
                        'title'       => $result['entry']['title']['$t'],
                        'description' => $result['entry']['media$group']['media$description']['$t'],
                        'thumbnail'   => $result['entry']['media$group']['media$thumbnail'][0]['url'],
                        'duration'    => $result['entry']['media$group']['media$content'][0]['duration'],
                        'upload_date' => $result['entry']['media$group']['yt$uploaded']['$t'],
                    );
                    break;

                case 'vimeo':
                    $ch = curl_init($url_data);  
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/json')); 
                    $result = json_decode(curl_exec($ch), true);
                    curl_close($ch);

                    return array(
                        'title'       => $result[0]['title'],
                        'description' => $result[0]['description'],
                        'thumbnail'   => $result[0]['thumbnail_small'],
                        'duration'    => $result[0]['duration'],
                        'upload_date' => $result[0]['upload_date']
                    );
                    break;
                
                default:
                    return false;
                    break;
            }
        }
        return false;
    }



    /**
     * This function converts the currency in desired form.
     * @access public
     * @param  init $amount Amount to be converted
     * @param  string $from Currency Code to convert "from"
     * @param  string $to Currency code to convert "to" Default=INR
     * @return string      Return json data
     */
    public function currencyConvert($amount, $from, $to)
    {
     
        if($from===$to)
        {
            return round($amount, 2);
        }
        
        if ($this->_currencyConverter==='currencylayer')
        {
            return self::currencyLayerConvert($amount, $from, $to);
        }
        elseif ($this->_currencyConverter==='exchangerate')
        {
            return self::exchangeRateConvert($amount, $from, $to);
        }
        
        return self::smartConvert($amount, $from, $to);

    }

    public function currencyLayerConvert($amount, $from, $to)
    {
        $cache = Cache::get('trickster.currency.currencylayer');
        if(!$cache)
        {
            $expiresAt = now()->addMinutes(30);
            // To/From*Amount
            $url = sprintf($this->_currencyLayerApi, $this->_currencyLayerApiKey, $from.','.$to);
            $req = curl_init();
            $timeout = 0;
            curl_setopt ($req, CURLOPT_URL, $url);
            curl_setopt ($req, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt ($req, CURLOPT_USERAGENT,
                        "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
            curl_setopt ($req, CURLOPT_CONNECTTIMEOUT, $timeout);
            $rawdata = curl_exec($req);
            curl_close($req);
            $data = json_decode($rawdata, true);
            Log::debug('Data: '.$rawdata);

            if ($data['success']===true)
            {
                $toRate = $data['quotes']['USD'.$to];
                $fromRate = $data['quotes']['USD'.$from];
                $converted = ($toRate / $fromRate) * $amount;
                $resque =  round($converted, 2);
                Cache::add('trickster.currency.currencylayer', $rawdata, $expiresAt);
                return $resque;
            }

            Log::critical('Currency Conversion Failed! Raw data: '.$rawdata);

            return false;
        }
        else
        {
            $data = json_decode($cache, true);
            $toRate = $data['quotes']['USD'.$to];
            $fromRate = $data['quotes']['USD'.$from];
            return self::currencyLayerCalculate($toRate, $fromRate, $amount);
        }
        
    }

    public function exchangeRateConvert($amount, $from, $to)
    {
        $cache = Cache::get('trickster.currency.exchangerate');
        if (!$cache)
        {
            $expiresAt = now()->addMinutes(30);
            
            $url = sprintf($this->_exchangeRateApi, $this->_exchangeRateApiKey, $from, $to);
            $req = curl_init();
            $timeout = 0;
            curl_setopt ($req, CURLOPT_URL, $url);
            curl_setopt ($req, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt ($req, CURLOPT_USERAGENT,
                        "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
            curl_setopt ($req, CURLOPT_CONNECTTIMEOUT, $timeout);
            $rawdata = curl_exec($req);
            curl_close($req);
            $data = json_decode($rawdata, true);

            if ($data['result']==='success')
            {
                $resque = Self::exchangeRateCalculate($data['rate'], $amount);
                Cache::add('trickster.currency.exchangerate', $rawdata, $expiresAt);
                return $resque;
            } elseif ($data['result']==='error') {
                Log::critical('The Currency Converter returned error: '.$data['error']);
            }
        }
        else
        {
            $data = json_decode($cache, true);
            return Self::exchangeRateCalculate($data['rate'], $amount);
        }

        return false;
    }

    /**
     * Smart Currency Conversion
     * This uses the activated APIs and increases your monthly quotas
     * @return float
     */
    public function smartConvert($amount, $from, $to)
    {
        // Smart Convert Logic
        Log::info('Running Smart Currency Conversion');

        if ($this->_currencyLayerApiKey != NULL)
        {
            $conv = self::currencyLayerConvert($amount, $from, $to);

            if(!$conv)
            {
                if ($this->_exchangeRateApiKey != NULL)
                {
                    return self::exchangeRateConvert($amount, $from, $to);
                }
                return false;
            }

            return $conv;
        }
        elseif ($this->_exchangeRateApiKey != NULL)
        {
            return self::exchangeRateConvert($amount, $from, $to);
        }

        return false;
    }
    /**
     * Calculation of the converted currency
     * @access protected
     * @return float
     */
    protected function exchangeRateCalculate($rate, $amount)
    {
        // code
        $conv = $amount * $rate;
        $resque = round($conv, 2);
        return $resque;
    }

    protected function currencyLayerCalculate($toRate, $fromRate, $amount)
    {
        // code
        $converted = ($toRate / $fromRate) * $amount;
        $resque =  round($converted, 2);
        return $resque;
    }

    /**
     * This function used for return tweets and likes with curl
     * @access private
     * @param  string $url Url need for curl to get data
     * @return string      Return json data
     */
    private function _socialCurl($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/json'));
        $result = json_decode(curl_exec($ch), true);
        curl_close($ch); 

        return $result;
    }
}