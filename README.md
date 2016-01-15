# Social links

![License](https://img.shields.io/packagist/l/rezozero/social-links.svg?style=flat)
![Version](https://img.shields.io/packagist/v/rezozero/social-links.svg?style=flat)

## [Work in progress]

## Usage

Install *SocialLinks* using *Composer*

```bash
composer require rezozero/social-links
```

Configure your `SocialLinks` instance with your data source and some
output settings.

```php
// Construct a new SocialLinks
$share = new \RZ\SocialLinks\SocialLinks(array(
    'url' => 'http://www.rezo-zero.com',
    'title' => 'REZO ZERO website homepage',
    // Optional image source url for pinterest
    'imageUrl' => 'http://www.rezo-zero.com/templates/rezo-zero/img/apple-icon.png',
    // Optional status for overriding title for twitter, whatsapp and emails body
    'status' => 'Hey! Look at this awesome website.'
));

// Set link class prefix
$share->setClassPrefix('social-link');

// Set social icons class prefix
// Use fa for Font Awesome or an
// other for a custom icon set.
$share->setIconPrefix('fa');
```

### Single Url

```php
echo $share->getUrl('twitter');

// http://twitter.com/home?status=Hey%21+Look+at+this+awesome+website.+%E2%80%94+http%3A%2F%2Fwww.rezo-zero.com
```

### Single Link with icon

```php
echo $share->getLinkWithIcon('facebook');

// <a class="social-link social-link-facebook" 
//    target="_blank" 
//    rel="nofollow" 
//    href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.rezo-zero.com">
//    <i class="social-link-icon fa fa-facebook"></i>
//    <span class="social-link-name">Facebook</span>
// </a>
```

*Note that real output string is space-less.* And if you don’t want any icon, don’t be lazy, just `display: none;` it!

### A bunch of links with their icons


```php
echo $share->getLinksWithIconForNetworks(array('facebook', 'twitter', 'linkedin'));

//<a class="social-link social-link-facebook" 
//   target="_blank" 
//   rel="nofollow" 
//   href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.rezo-zero.com">
//   <i class="social-link-icon fa fa-facebook"></i>
//   <span class="social-link-name">Facebook</span>
//</a>
//<a class="social-link social-link-twitter" 
//   target="_blank" 
//   rel="nofollow" 
//   href="http://twitter.com/home?status=Hey%21+Look+at+this+awesome+website.+%E2%80%94+http%3A%2F%2Fwww.rezo-zero.com">
//   <i class="social-link-icon fa fa-twitter"></i>
//   <span class="social-link-name">Twitter</span>
//</a>
//<a class="social-link social-link-linkedin" 
//   target="_blank" 
//   rel="nofollow" 
//   href="http://www.linkedin.com/shareArticle?mini=true&url=http%3A%2F%2Fwww.rezo-zero.com&title=REZO+ZERO+website+homepage">
//   <i class="social-link-icon fa fa-linkedin"></i>
//   <span class="social-link-name">Linkedin</span>
//</a>
```

*Note that real output string is space-less.*

You also can choose a not empty separator, i.e. a dash:

```php
echo $share->getLinksWithIconForNetworks(array('facebook', 'twitter', 'linkedin'), ' - ');
```

