#Trickster

## Why Trickster?
* Trickster is an Laravel plugin that makes Laravel Fun.
* Trickster provides tricks that makes the coding easy.
* With **Trickster** inside **Laravel**, your app will become a **Gambit**. :P

##Trickster's Tricks
###1. Truncator
Truncate is a Text Truncator. It Truncates the text and enable you to add ellipses(...) or desired line at the end. For example:

>_The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those inter **(read more...)**_

Just call the Trickster and provide it with details of the given parameters.
```php
Trickster::truncate('Supplied text is written here, can also be given in a variable; lets leave it simple.', 30, '(read more...)');
// Output: Supplied text is written here, (read more...)
```

###2. Email Validator
Email Validator gives you the power of validating the email address by just a simple line of code: 
``` php
Trickster::validateEmail($email)
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

###6. File Extension Grabber:
This simple trick grabs the file extension of the file supplied as the parameter. Simply call the Trickster and provide the full file name, the trick will distinguish the file ext. from the file name and return it.

```php
Trickster::getExtension('really-funny.image.jpg');
```
