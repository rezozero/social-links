<?php
/**
 * Copyright © 2015, Ambroise Maupate
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 *
 * @file index.php
 * @author Ambroise Maupate
 */
require('../vendor/autoload.php');

$share = new \RZ\SocialLinks\SocialLinks(array(
    'url' => 'http://www.rezo-zero.com',
    'title' => 'REZO ZERO website homepage',
    'status' => 'Hey! Look at this awesome website.',
    'imageUrl' => 'http://www.rezo-zero.com/templates/rezo-zero/img/apple-icon.png',
));

// Use bootstrap classes for links
$share->setLinkClasses('btn btn-default');

// Use a arbitrary prefix
$share->setClassPrefix('social-link');

// Use font-awesome icon prefix
$share->setIconPrefix('fa');

/*$linkHTML = $share->getLinksWithIcon(array(
    'facebook',
    'twitter',
    'linkedin',
    'google-plus',
    'whatsapp',
));*/

$linkHTML = $share->getLinksWithIcon($share->getAvailableSocialNetworks());

?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Social links</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <style>
            .social-links { display: block; margin: 30px 0px; }
            .social-link { display: inline-block; margin: 5px 3px; }
            .social-link-name { display: inline-block; margin-left: 5px; }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Social links </h1>
            <hr>
            <nav class="social-links"><?php echo $linkHTML; ?></nav>

            <h2>Available networks</h2>
            <table class="table">
            <?php foreach ($share->getAvailableSocialNetworks() as $network): ?>
            <tr><td><?php echo $network ?></td></tr>
            <?php endforeach ?>
            </table>
        </div>
    </body>
</html>
