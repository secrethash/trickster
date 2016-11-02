#Trickster

## Why Trickster?
* Trickster is an Laravel package that makes Laravel Fun.
* Trickster provides tricks that makes coding with Laravel easy.
* With **Trickster** inside your **Laravel framework**, your app will become a **Gambit**. :-P

##Installation
Installing Trickster is easy. Just type the command:
`composer require secrethash/trickster`

##Requirements
* **Laravel 5.x**
* **cURL**
* **PHP 5.4.x**

##Usage
To start using ***Trickster***, you will be needed to set it up first. Follow the below steps to setup **Trickster**:

###1. Service Provider
You will be needing to add the Trickster Service Provider in your `app.php` which is inside the `config` directory.

* Open `config\app.php`
* Find `'providers'`
* At the last of this array in `Application Service Providers` add `Secrethash\Trickster\TricksterServiceProvider::class,`

###2. Facade
To use **Trickster** flexibly, you need to add the Facade also. Facade will let you use Trickster directly. All you will need to do is add `use Trickster;` at the head of the controller below namespace and use it by `Trickster::trickName();`

**Lets Add the `Trickster` Facade:**

* Open `config\app.php`
* Find `'aliases'` array.
* At the end of this array, add `'Trickster' => Secrethash\Trickster\Facade\Trickster::class,`

###3. Configuration
First of all you will need to run the following command in your console:
`php artisan vendor:publish --provider="Secrethash\Trickster\TricksterServiceProvider"`
>This command will publish the `trickster.php` configuration file for Trickster to your application default `config` directory.

From `config\trickster.php` you can edit the default configurations.

###4. Ready, Steady, GO!
***You are almost done. Now what to do when you want to use a Trickster's Trick?***

Here is a sample Controller to show you how to add Trickster and Use it:
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use Trickster; // Simply add the Facade

class TricksterDemoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //checking if the user is Authenticated
        if (Auth::check()) {
	        $user = Auth::user();
	        // Grabbing Gravatar
	        $gravatar = Trickster::gravatar($user->email, '200');
	     }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

}

```

If you want to use Trickster inside a view file, call the `Trickster` method directly. That is the advantage of Facade.

For example:
`{!! Trickster::bbcode($user->bio) !!}`
or
`{{ Trickster::truncator($blog->desc, '150', '(...summary)') }}`


##Trickster's Tricks

###1. Truncator
Truncate is a Text Truncator. It Truncates the text and enable you to add ellipses(...) or desired line at the end. For example:

>_The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those inter **(read more...)**_

Just call the Trickster and provide it with details of the given parameters.
```php
Trickster::truncator('Supplied text is written here, can also be given in a variable; lets leave it simple.', 30, '(read more...)');
// Output: Supplied text is written here, (read more...)
```

###2. Email Validator
Email Validator gives you the power of validating the email address by just a simple line of code: 
``` php
Trickster::emailValid('someone@example.com');
``` 
With Trickster by your side you will not have to write the validation code again and again. Just mention the Facade of Trickster an the validation function that's it.

###3. Slug Converter
Slug Converter makes your life easy for creating search engine friendly slug for your url.
>For example: **Text**: _Are search engines friendly to search engines?_
>>**SLUGish URL**: _example.com/are-search-engines-friendly-to-search-engines_

**_COOL HUH?_**

It is really very simple with Trickster. Just call Trickster and specify the slug function, provide in the text and Ta-DA!
```php
Trickster::slug('Are search engines friendly to search engines?'); // Just One Line!
//-> OR
$slug = 'Are search engines friendly to search engines?';
$slug = Trickster::slug($slug); // That's it!
```

###4. YouTube Embed
YouTube Embedding can never be more easier! Embed YouTube Videos without writing lines of code just tell the Trickster about it. Call Trickster by:
```php
Trickster::youtube('VIDEO URL', 'FRAME WIDTH', 'FRAME HEIGHT', 'FRAME THEME');
//OR LEAVE EVERYTHING ELSE FOR DEFAULT VALUES, JUST PUT THE LINK
Trickster::youtube('VIDEO URL');
```
**_DEFAULT VALUES:_**

|   Parameters  |             Description            |Required|  Value  |
|-------------------| -----------------------------------|-----------|-----------|
|  Video URL    | URL to the YouTube video  |    YES   |    NO    |
| Frame Width  | Width of the video Frame   |    NO    |     400   |
| Frame Height | Height of the Video frame  |    NO    |     250   |
| Frame Theme| **dark** or **light** theme   |    NO    |     dark  |


###5. Gravatar Grabber
This amazing trick helps you to easily get the gravatar in the desired **size**, with desired **rating**. Not only that, but it also helps you to set the desired **default image** in case the grabbing fails. Not yet finished, two more amazing features; allows you to **set the option of returning only the url of the gravatar or even the gravatar with the whole `<img />` tag** and in case you want Trickster to return the whole _img_ tag then you also have the option of **setting desired attributes in an array _(ex. below)_**.

```php
Trickster::gravatar('example@email.com', '200', 'monsterid', 'r', 'true', array('class'=>'img-class', 'key'=>'value'));
```
**The Parameters Explained:**

+ **Email Address**: Just simple email address. _NO DEFAULT_, _REQUIRED_.
+ **Size**: Size of image in pixels. _DEFAULT: 100_, _NOT REQUIRED_.
+ **Default image**: Default Image like _mm_(mystery man), _monsterid_, _identicon_, _wavatar_, 404. _DEFAULT: mm_, _NOT REQUIRED_.
+ **Rating**: Image Max Rating (for ex. _g_, _pg_, _r_, _x_). _DEFAULT: g_, _NOT REQUIRED_.
+ **`<img />`**: Do you want full HTML image tag? This parameter should be supplied with boolean value (TRUE/FALSE). _DEFAULT: false_, _NOT REQUIRED_.
+ **Key-Value Attributes**: An array is to be passed to defined any special attributes required by the html image tag, if requested. _NO DEFAULT_, _NOT REQUIRED_

###6. Extension Splitter
This simple trick splits the file extension of the file supplied as the parameter and returns it. Simply call the Trickster and provide the full file name, the trick will split the file ext. from the file name and return it.

```php
Trickster::getExtension('really-funny.image.jpg');
```
***Finished? Not Yet!***

###7. Simple Social Analytics
This trick eases your life, seriously. Simple and easy it is to show your social counts with Trickster. Trickster's Simple Social Analytics shows the number of Shares or Comments over a specific URL on Facebook when the trick is executed.

>Note: Twitter has been deprecated. As of 20th November 2015 there's no Tweet count API. [Know More](https://blog.twitter.com/2015/hard-decisions-for-a-sustainable-platform)

* Supported Social Networks:
 + Facebook
 + ~~Twitter~~ (deprecated)
* Returned Strings
 + Facebook
      - Share Count
      - Comment Count
 + ~~Twitter~~
      - ~~Tweets~~

```php
$fbAnalytics = Trickster::social('facebook', 'http://github.com/secrethash');
echo $fbAnalytics['share_count'].' Shares of Github.com/secrethash';
echo $fbAnalytics['comment_count'].' Comments on Github.com/secrethash';
```
>Output 1: 95457821 Shares of Github.com/secrethash
>Output 2: 59865231 Comments on Github.com/secrethash

(Don't be bothered about the numbers, they are just random :-P )

BTW Simple, right?

###8. BB Code Engine
BB code engine trick is a little distinctive. It's actually amazing. It makes easy to convert the BB Code to HTML format. Easy to initialize, it makes it unique.

```php
// If implemented directly in the  Blade View File.
{!! Trickster::bbcode($user->bio) !!}
```
***The Supported BB Codes Currently are: ***

|           BB Code    |   Description   | Converted HTML |
|----------------------|-----------------|----------------|
|          [b]...[/b]  |    Bold Text    | `<b>...</b>`   |
|          [i]...[/i]  |    Italics Text | `<i>...</i>` |
|          [u]...[/u]  |    Underlined   | `<u>...</u>` |
|   [img=url]alt[/img] |   Image Implementation. Where: url is the image url & alt is alternate text.| `<img src="#url" alt="Alternate Text" />` |
|[youtube]id[/youtube] | Youtube Embed. Where id is the Video ID of youtube video. | YouTube video frame of width 400px & height 250px |
|   [vimeo]id[/vimeo]  | Vimeo Embed. Where id is the Video ID of Vimeo video. | Vimeo video frame of width 400px & height 250px |
|          [p]...[/p]  | Paragraph. |  `<p>...</p>` |
|            [br/]     | Line Break  |  `<br/>` |
|[url=URL]ALT[/url]    | Adding a URL. Where: URL is the Target Link and ALT is the URL text to be shown. | `<a href="#url">Google</a>` |

###9. Tags Sweeper
Tag sweeper is a unwanted tag remover trick. It easily removes the unwanted script tags from the provided string. In accordance to the BB Code Engine,  Tag Sweeper Cleans the HTML `<script></script>` code and leaves the BB Code making the supplied text **Clean and Safe**.

```php
Trickster::clean($string);
```

###10. Time Ago
**Time ago** is a wonderful way of displaying the post time. You can use the Trickster's Facade `Trickster` to convert easily the provided Time & Date to Time Ago. The default format for this is `Y-m-d H:i:s`. In simple words `1996-07-30 21:52:30`, `Year-Month-Day Hour:Min:Sec`
>For example: _This repo was created 2 months ago_

**Trick:**
```php
Trickster::timeAgo('1996-07-30 21:52:30');
```

###11. Cipher
Cipher enables you to encrypt any provided string of plain text to convert into Encrypted text form. Any PHP supported algorithm can be provided to **Cipher** to encrypt it. You can also encrypt a string and add a **Salt** to make it more secure. One will need the **Salt** to decrypt it.

```php
Trickster::encryptString('SHA1', 'Text to Encrypt', 'Desired Salt');
```

###12. Vimeo Video Embed
Vimeo Video Embed, same as YouTube Video Embed. It needs the video link of Vimeo Video as an input. Same as Youtube Embed you can set custom width and height in it also. 

```php
Trickster::vimeo('https://vimeo.com/30626474', '400', '250');
//-> OR, Simple <-//
Trickster::vimeo('https://vimeo.com/30626474');
```

###13. Video Info Grabber
A great way of getting the video information from **YouTube and Vimeo**. _Video Info Grabber_ makes it easy for you to grab the video info from link of YouTube & Vimeo video portals and return an array containing the video info. Returning as an array gives you the flexibility to use the info as you want.
```php
Trickster::getVideoInfo('https://vimeo.com/30626474');
```
```html
// Output
Array
(
    [title] => The Official Space Ibiza Closing Party 2011 Video
    [description] => 
    [thumbnail] => http://i1.ytimg.com/vi/AL-QX0wj44A/default.jpg
    [duration] => 962
    [upload_date] => 2011-11-05 02:11:05
)
```

###14. Wikipedia Grabber
This simple trick helps you to get the **Wikipedia version definition** of a particular keyword. Just pass the key word as the input to this function of `Trickster` and get the definition right away as return string. Remember, like the above function this one also returns an array as it returns not only definition but also the input value and the link to Wikipedia, where that definition is. The example is well explained below:

```php
Trickster::wiki('github');
```
```php
// Returns
/**
Array
(
    [0] => GitHub
    [1] => GitHub is a web-based Git repository hosting service. It offers all of the distributed revision control and source code management (SCM) functionality of Git as well as adding its own features. 
    [2] => http://en.wikipedia.org/wiki/GitHub
)
*/
```
So if you only want to display the definition of **GitHub** as shown in the above example:
```php
$trick = Trickster::wiki('github');
echo $trick[1];
```
### 15. URL Shortener
URL shortener make your url short using the Google's goo.gl API and TinyURL API. Make your life simple with just one liner URL Shortener that can shorten the URL using 2 distinctive APIs.
```php
// Google's URL Shortener
Trickster::shortenUrl('http://github.io', 'google');

// TinyURL URL Shortener
Trickster::shortenUrl('http://github.com', 'tinyurl');
```

###16. Suggest
Suggest uses the Google Suggest API to get the keyword suggestions. Just provide the input of the keyword that you want the suggestions for as the first parameter and the results will be generated and returned as an array.
```php
Trickster::suggest('break');
```
```php
// Output

/**
Array
(
    [0] => breaking
    [1] => breaking bad
    [2] => break the glass
    [3] => break plan
    [4] => breaking bad imdb
    [5] => kitkat break
    [6] => break the bones
    [7] => breakthrough
    [8] => breaking benjamin
    [9] => breakup
)
*/
```


###17. IP Grabber
Grabs the user's IP address. Simple but useful.
```php
Trickster::ip();
// Output: 192.168.145.35
```
