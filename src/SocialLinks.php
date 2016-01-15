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
    protected $classPrefix = 'social-link';
    protected $iconPrefix = 'fa';

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
        return array(
            'delicious' => array(
                'base' => 'http://delicious.com/post',
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
            ),
            'evernote' => array(
                'base' => 'http://www.evernote.com/clip.action',
                'query' => array(
                    'url' => $this->url,
                    'title' => $this->title,
                ),
            ),
            'facebook' => array(
                'base' => 'https://www.facebook.com/sharer/sharer.php',
                'query' => array(
                    'u' => $this->url,
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
            'linkedin' => array(
                'base' => 'http://www.linkedin.com/shareArticle',
                'query' => array(
                    'mini' => 'true',
                    'url' => $this->url,
                    'title' => $this->title,
                ),
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
            'get-pocket' => array(
                'base' => 'https://getpocket.com/save',
                'query' => array(
                    'url' => $this->url,
                    'title' => $this->title,
                ),
            ),
            'reddit' => array(
                'base' => 'http://www.reddit.com/submit',
                'query' => array(
                    'url' => $this->url,
                    'title' => $this->title,
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
            'technorati' => array(
                'base' => 'http://technorati.com/faves',
                'query' => array(
                    'add' => $this->url,
                    'title' => $this->title,
                ),
            ),
            'tumblr' => array(
                'base' => 'http://www.tumblr.com/share',
                'query' => array(
                    'v' => 3,
                    'u' => $this->url,
                    't' => $this->title,
                ),
            ),
            'twitter' => array(
                'base' => 'http://twitter.com/home',
                'query' => array(
                    'status' => $this->status,
                ),
            ),
            'whatsapp' => array(
                'base' => 'whatsapp://send',
                'query' => array(
                    'text' => $this->status,
                ),
            ),
        );
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
            return $this->definitions[$network]['base'] . "?" . http_build_query($this->definitions[$network]['query']);
        } else {
            throw new \RuntimeException("Social network not found (" . $network . ")", 1);
        }
    }

    /**
     * Get the HTML icon tag for social network
     * to work with a custom prefix.
     *
     * @param  string $network
     * @param  string $prefix (default: icon)
     * @return string
     */
    public function getIcon($network)
    {
        if ($network == '') {
            throw new \RuntimeException("You must choose a social network", 1);
        }

        return sprintf(
            '<i class="%s-icon %s %s-%s"></i>',
            $this->classPrefix,
            $this->iconPrefix,
            $this->iconPrefix,
            $network
        );
    }

    /**
     * Get HTML link tag with icon and text
     * for given social network.
     *
     * @param  string $network
     * @return string
     */
    public function getLinkWithIcon($network)
    {
        if ($network == '') {
            throw new \RuntimeException("You must choose a social network", 1);
        }

        return sprintf(
            '<a class="%s %s-%s" target="_blank" rel="nofollow" href="%s">%s<span class="%s-name">%s</span></a>',
            $this->classPrefix,
            $this->classPrefix,
            $network,
            $this->getUrl($network),
            $this->getIcon($network),
            $this->classPrefix,
            ucwords($network)
        );
    }

    /**
     * Get HTML links tags with icon and text
     * for given social networks.
     *
     * @param  array|string  $networks
     * @param  string $separator
     * @return string
     */
    public function getLinksWithIconForNetworks($networks = array(), $separator = '')
    {
        if (is_string($networks)) {
            return $this->getLinkWithIcon($networks);
        } elseif (is_array($networks)) {
            $output = array();
            foreach ($networks as $network) {
                if ($this->supports($network)) {
                    $output[] = $this->getLinkWithIcon($network);
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
}
