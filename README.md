#Trickster

## Why Trickster?
* Trickster is an Laravel plugin that makes Laravel Fun.
* Trickster provides tricks that makes the coding easy.
* With **Trickster** inside **Laravel**, your app will become a **Gambit**. :P

##Trickster's Tricks
###1. Truncator
Truncate is a Text Truncator. It Truncates the text and enable you to add ellipses(...) or desired line at the end. For example:

_The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those inter **read more...**_

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