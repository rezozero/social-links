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
 * @file SocialLinks.php
 * @author Ambroise Maupate
 */
namespace RZ\SocialLinks;

/**
 *
 */
class SocialLinks
{
    protected $url;
    protected $title;
    protected $imageUrl;
    protected $status;
    protected $linkClasses = '';
    protected $classPrefix = 'social-link';
    protected $iconPrefix = 'fa';
    protected $facebookAppId = null;

    /**
     * An array of services and their corresponding share/bookmarking URLs.
     *
     * @see drmonkeyninja/cakephp-social-share <https://github.com/drmonkeyninja/cakephp-social-share/blob/master/src/View/Helper/SocialShareHelper.php>
     * @var array
     */
    protected $definitions = array();

    /**
     * @param array $data
     */
    public function __construct($data = array())
    {
        if (!empty($data['url'])) {
            $this->url = $data['url'];
        }
        if (!empty($data['title'])) {
            $this->title = $data['title'];
        }
        if (!empty($data['imageUrl'])) {
            $this->imageUrl = $data['imageUrl'];
        }
        if (!empty($data['facebookAppId'])) {
            $this->facebookAppId = $data['facebookAppId'];
        }
        if (!empty($data['status'])) {
            $this->status = $data['status'] . ' — ' . $this->url;
        } else {
            $this->status = $this->title . ' — ' . $this->url;
        }

        $this->definitions = $this->buildDefinitions();
    }

    /**
     * Build a definition array for all
     * supported social networks.
     *
     * @return array
     */
    protected function buildDefinitions()
    {
        $definitions = array(
            'delicious' => array(
                'base' => 'https://delicious.com/post',
                'query' => array(
                    'url' => $this->url,
                    'title' => $this->title,
                ),
            ),
            'digg' => array(
                'base' => 'http://digg.com/submit',
                'query' => array(
                    'url' => $this->url,
                    'title' => $this->title,
                ),
            ),
            'email' => array(
                'base' => 'mailto:',
                'query' => array(
                    'body' => $this->status,
                    'subject' => $this->title,
                ),
                'icon' => 'envelope',
            ),
            'evernote' => array(
                'base' => 'https://www.evernote.com/clip.action',
                'query' => array(
                    'url' => $this->url,
                    'title' => $this->title,
                ),
            ),
            'facebook' => array(
                'base' => 'https://www.facebook.com/sharer/sharer.php',
                'query' => array(
                    'u' => $this->url,
                    't' => $this->title,
                    'app_id' => $this->facebookAppId,
                ),
            ),
            'friendfeed' => array(
                'base' => 'http://www.friendfeed.com/share',
                'query' => array(
                    'url' => $this->url,
                    'title' => $this->title,
                ),
            ),
            'google' => array(
                'base' => 'http://www.google.com/bookmarks/mark',
                'query' => array(
                    'op' => 'edit',
                    'bkmk' => $this->url,
                    'title' => $this->title,
                ),
            ),
            'google-plus' => array(
                'base' => 'https://plus.google.com/share',
                'query' => array(
                    'url' => $this->url,
                ),
            ),
            'linked-in' => array(
                'base' => 'https://www.linkedin.com/shareArticle',
                'query' => array(
                    'mini' => 'true',
                    'url' => $this->url,
                    'title' => $this->title,
                ),
                'icon' => 'linkedin',
            ),
            'newsvine' => array(
                'base' => 'http://www.newsvine.com/_tools/seed&save',
                'query' => array(
                    'u' => $this->url,
                    'h' => $this->title,
                ),
            ),
            'pinterest' => array(
                'base' => 'http://www.pinterest.com/pin/create/button/',
                'query' => array(
                    'url' => $this->url,
                    'description' => $this->title,
                    'media' => $this->imageUrl,
                ),
            ),
            'pocket' => array(
                'base' => 'https://getpocket.com/save',
                'query' => array(
                    'url' => $this->url,
                    'title' => $this->title,
                ),
                'icon' => 'get-pocket',
            ),
            'reddit' => array(
                'base' => 'http://www.reddit.com/submit',
                'query' => array(
                    'url' => $this->url,
                    'title' => $this->title,
                ),
            ),
            'scoop-it' => array(
                'base' => 'http://www.scoop.it/bookmarklet',
                'query' => array(
                    'url' => $this->url,
                ),
            ),
            'slashdot' => array(
                'base' => 'http://slashdot.org/bookmark.pl',
                'query' => array(
                    'url' => $this->url,
                    'title' => $this->title,
                ),
            ),
            'stumbleupon' => array(
                'base' => 'http://www.stumbleupon.com/submit',
                'query' => array(
                    'url' => $this->url,
                    'title' => $this->title,
                ),
            ),
            'tumblr' => array(
                'base' => 'https://www.tumblr.com/share',
                'query' => array(
                    'v' => 3,
                    'u' => $this->url,
                    't' => $this->title,
                ),
            ),
            'twitter' => array(
                'base' => 'https://twitter.com/intent/tweet',
                'query' => array(
                    'text' => $this->status,
                ),
            ),
            'whatsapp' => array(
                'base' => 'whatsapp://send',
                'query' => array(
                    'text' => $this->status,
                ),
            ),
        );

        /*
         * Use facebook better Dialog feed if a
         * facebook App Id is given.
         */
        if ($this->facebookAppId != "") {
            $definitions['facebook'] = array(
                'base' => 'https://www.facebook.com/dialog/feed',
                'query' => array(
                    'link' => $this->url,
                    'name' => $this->title,
                    'app_id' => $this->facebookAppId,
                    'redirect_uri' => $this->url,
                ),
            );
            if ($this->imageUrl != "") {
                $definitions['facebook']['query']['picture'] = $this->imageUrl;
            }
        }

        return $definitions;
    }

    /**
     * Get social network share url.
     *
     * @param  string $network
     * @return string
     */
    public function getUrl($network)
    {
        if ($network == '') {
            throw new \RuntimeException("You must choose a social network", 1);
        }

        if (isset($this->definitions[$network]) &&
            isset($this->definitions[$network]['base']) &&
            isset($this->definitions[$network]['query'])) {

            $queryString = http_build_query(array_filter($this->definitions[$network]['query']), '', '&amp;', PHP_QUERY_RFC3986);

            return $this->definitions[$network]['base'] . "?" . $queryString;
        } else {
            throw new \RuntimeException("Social network not found (" . $network . ")", 1);
        }
    }

    /**
     * Get the HTML icon tag for social network
     * to work with a custom prefix.
     *
     * @param  string $network
     * @return string
     */
    public function getIcon($network)
    {
        if ($network == '') {
            throw new \RuntimeException("You must choose a social network", 1);
        }

        $icon = $network;

        if (isset($this->definitions[$network]['icon'])) {
            $icon = $this->definitions[$network]['icon'];
        }

        return sprintf(
            '<i class="%s-icon %s %s-%s"></i>',
            $this->classPrefix,
            $this->iconPrefix,
            $this->iconPrefix,
            $icon
        );
    }

    /**
     * Get a SVG <use> icon tag for social network
     * to work with a custom prefix.
     *
     * @param  string $network
     * @return string
     */
    public function getUseSVG($network)
    {
        if ($network == '') {
            throw new \RuntimeException("You must choose a social network", 1);
        }

        $icon = $network;
        if (isset($this->definitions[$network]['icon'])) {
            $icon = $this->definitions[$network]['icon'];
        }

        return sprintf(
            '<svg class="%s-icon %s %s-%s"><use xlink:href="#%s-%s"></use></svg>',
            $this->classPrefix,
            $this->iconPrefix,
            $this->iconPrefix,
            $icon,
            $this->iconPrefix,
            $icon
        );
    }

    /**
     * Get HTML link tag with icon and text
     * for given social network.
     *
     * @param  string $network
     * @param  string $icon
     * @return string
     */
    public function getLink($network, $icon = '')
    {
        if ($network == '') {
            throw new \RuntimeException("You must choose a social network", 1);
        }

        $linkClassesMerged = array();
        if ($this->linkClasses != '') {
            $linkClassesMerged[] = $this->linkClasses;
        }
        $linkClassesMerged[] = $this->classPrefix;
        $linkClassesMerged[] = $this->classPrefix . '-' . $network;

        return sprintf(
            '<a class="%s" target="_blank" rel="nofollow" href="%s">%s<span class="%s-name">%s</span></a>',
            implode(' ', $linkClassesMerged),
            $this->getUrl($network),
            $icon,
            $this->classPrefix,
            ucfirst(str_replace('-', ' ', $network))
        );
    }

    /**
     * Get HTML links tags without icon but text
     * for given social networks.
     *
     * @param  array|string  $networks
     * @param  string $separator
     * @return string
     */
    public function getLinks($networks = array(), $separator = '')
    {
        if (is_string($networks)) {
            return $this->getLink($networks);
        } elseif (is_array($networks)) {
            $output = array();
            foreach ($networks as $network) {
                if ($this->supports($network)) {
                    $output[] = $this->getLink($network);
                }
            }
            return implode($separator, $output);
        }

        return '';
    }

    /**
     * Get HTML links tags with icon and text
     * for given social networks.
     *
     * @param  array|string  $networks
     * @param  string $separator
     * @return string
     */
    public function getLinksWithIcon($networks = array(), $separator = '')
    {
        if (is_string($networks)) {
            return $this->getLink($networks, $this->getIcon($networks));
        } elseif (is_array($networks)) {
            $output = array();
            foreach ($networks as $network) {
                if ($this->supports($network)) {
                    $output[] = $this->getLink($network, $this->getIcon($network));
                }
            }
            return implode($separator, $output);
        }

        return '';
    }

    /**
     * Get HTML links tags with svg icon and text
     * for given social networks.
     *
     * @param  array|string  $networks
     * @param  string $separator
     * @return string
     */
    public function getLinksWithSVG($networks = array(), $separator = '')
    {
        if (is_string($networks)) {
            return $this->getLink($networks, $this->getUseSVG($networks));
        } elseif (is_array($networks)) {
            $output = array();
            foreach ($networks as $network) {
                if ($this->supports($network)) {
                    $output[] = $this->getLink($network, $this->getUseSVG($network));
                }
            }
            return implode($separator, $output);
        }

        return '';
    }

    /**
     * @return array
     */
    public function getAvailableSocialNetworks()
    {
        return array_keys($this->definitions);
    }

    /**
     * Tell if SocialLinks supports given network.
     *
     * @param  string $network
     * @return boolean
     */
    public function supports($network)
    {
        return isset($this->definitions[$network]);
    }

    /**
     * Gets the value of classPrefix.
     *
     * @return mixed
     */
    public function getClassPrefix()
    {
        return $this->classPrefix;
    }

    /**
     * Sets the value of classPrefix.
     *
     * @param mixed $classPrefix the class prefix
     *
     * @return self
     */
    public function setClassPrefix($classPrefix)
    {
        $this->classPrefix = $classPrefix;

        return $this;
    }

    /**
     * Gets the value of iconPrefix.
     *
     * @return mixed
     */
    public function getIconPrefix()
    {
        return $this->iconPrefix;
    }

    /**
     * Sets the value of iconPrefix.
     *
     * @param mixed $iconPrefix the icon prefix
     *
     * @return self
     */
    public function setIconPrefix($iconPrefix)
    {
        $this->iconPrefix = $iconPrefix;

        return $this;
    }

    /**
     * Gets the value of linkClasses.
     *
     * @return mixed
     */
    public function getLinkClasses()
    {
        return $this->linkClasses;
    }

    /**
     * Sets the value of linkClasses.
     *
     * @param mixed $linkClasses the link classes
     *
     * @return self
     */
    public function setLinkClasses($linkClasses)
    {
        $this->linkClasses = $linkClasses;

        return $this;
    }
}
