<?php
/**
 * Copyright © 2023, Ambroise Maupate
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

class SocialLinks
{
    protected ?string $url = null;
    protected ?string $title = null;
    protected string $imageUrl = '';
    protected ?string $status = null;
    protected string $linkClasses = '';
    protected string $svgUrl = '';
    protected string $classPrefix = 'social-link';
    protected string $iconPrefix = 'fa';
    protected ?string $facebookAppId = null;
    protected string $shareActionLabel = 'Share on %s';

    /**
     * An array of services and their corresponding share/bookmarking URLs.
     *
     * @see drmonkeyninja/cakephp-social-share <https://github.com/drmonkeyninja/cakephp-social-share/blob/master/src/View/Helper/SocialShareHelper.php>
     * @var array<string, array<string, mixed>>
     */
    protected array $definitions = [];

    /**
     * @param array<string, string|int> $data
     */
    public function __construct(array $data = [])
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
     * @return array<string, array<string, mixed>>
     */
    protected function buildDefinitions(): array
    {
        $definitions = array(
            'delicious' => array(
                'base' => 'https://delicious.com/post',
                'query' => array(
                    'url' => $this->url,
                    'title' => $this->title,
                ),
                'fontawesome' => 'fa-brands fa-delicious',
            ),
            'digg' => array(
                'base' => 'http://digg.com/submit',
                'query' => array(
                    'url' => $this->url,
                    'title' => $this->title,
                ),
                'fontawesome' => 'fa-brands fa-digg',
            ),
            'email' => array(
                'base' => 'mailto:',
                'query' => array(
                    'body' => $this->status,
                    'subject' => $this->title,
                ),
                'icon' => 'envelope',
                'fontawesome' => 'fa-regular fa-envelope',
            ),
            'evernote' => array(
                'base' => 'https://www.evernote.com/clip.action',
                'query' => array(
                    'url' => $this->url,
                    'title' => $this->title,
                ),
                'fontawesome' => 'fa-brands fa-evernote',
            ),
            'facebook' => array(
                'base' => 'https://www.facebook.com/sharer/sharer.php',
                'query' => array(
                    'u' => $this->url,
                    't' => $this->title,
                    'app_id' => $this->facebookAppId,
                ),
                'fontawesome' => 'fa-brands fa-square-facebook',
            ),
            'google' => array(
                'base' => 'http://www.google.com/bookmarks/mark',
                'query' => array(
                    'op' => 'edit',
                    'bkmk' => $this->url,
                    'title' => $this->title,
                ),
                'fontawesome' => 'fa-brands fa-google',
            ),
            'google-plus' => array(
                'display_title' => 'Google +',
                'base' => 'https://plus.google.com/share',
                'query' => array(
                    'url' => $this->url,
                ),
                'fontawesome' => 'fa-brands fa-square-google-plus',
            ),
            'linked-in' => array(
                'display_title' => 'LinkedIn',
                'base' => 'https://www.linkedin.com/shareArticle',
                'query' => array(
                    'mini' => 'true',
                    'url' => $this->url,
                    'title' => $this->title,
                ),
                'icon' => 'linkedin',
                'fontawesome' => 'fa-brands fa-linkedin',
            ),
            // Other spelling for linked-in
            'linkedin' => array(
                'display_title' => 'LinkedIn',
                'base' => 'https://www.linkedin.com/shareArticle',
                'query' => array(
                    'mini' => 'true',
                    'url' => $this->url,
                    'title' => $this->title,
                ),
                'icon' => 'linkedin',
                'fontawesome' => 'fa-brands fa-linkedin',
            ),
            'pinterest' => array(
                'base' => 'http://www.pinterest.com/pin/create/button/',
                'query' => array(
                    'url' => $this->url,
                    'description' => $this->title,
                    'media' => $this->imageUrl,
                ),
                'fontawesome' => 'fa-brands fa-pinterest',
            ),
            'pocket' => array(
                'base' => 'https://getpocket.com/save',
                'query' => array(
                    'url' => $this->url,
                    'title' => $this->title,
                ),
                'icon' => 'get-pocket',
                'fontawesome' => 'fa-brands fa-get-pocket',
            ),
            'reddit' => array(
                'base' => 'http://www.reddit.com/submit',
                'query' => array(
                    'url' => $this->url,
                    'title' => $this->title,
                ),
                'fontawesome' => 'fa-brands fa-reddit',
            ),
            'scoop-it' => array(
                'display_title' => 'Scoop.It!',
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
                'fontawesome' => 'fa-brands fa-stumbleupon',
            ),
            'tumblr' => array(
                'base' => 'https://www.tumblr.com/share',
                'query' => array(
                    'v' => 3,
                    'u' => $this->url,
                    't' => $this->title,
                ),
                'fontawesome' => 'fa-brands fa-square-tumblr',
            ),
            'twitter' => array(
                'base' => 'https://twitter.com/intent/tweet',
                'query' => array(
                    'text' => $this->status,
                ),
                'fontawesome' => 'fa-brands fa-x-twitter',
            ),
            'whatsapp' => array(
                'base' => 'whatsapp://send',
                'query' => array(
                    'text' => $this->status,
                ),
                'fontawesome' => 'fa-brands fa-whatsapp',
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
                'fontawesome' => 'fa-brands fa-square-facebook',
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
    public function getUrl(string $network): string
    {
        if ($network == '') {
            throw new \RuntimeException("You must choose a social network", 1);
        }

        if (isset($this->definitions[$network]['query']) && isset($this->definitions[$network]['base'])) {
            $queryString = http_build_query(
                array_filter($this->definitions[$network]['query']),
                '',
                '&amp;',
                PHP_QUERY_RFC3986
            );
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
    public function getIcon(string $network): string
    {
        if ($network == '') {
            throw new \RuntimeException("You must choose a social network", 1);
        }

        $icon = $network;

        if (isset($this->definitions[$network]['icon'])) {
            $icon = $this->definitions[$network]['icon'];
        }

        /*
         * Use real font-awesome icon name
         * if using FA prefix.
         */
        if ($this->iconPrefix == 'fa' &&
            !empty($this->definitions[$network]['fontawesome'])) {
            $icon = $this->definitions[$network]['fontawesome'];
            // Since fontawesome 6, need to set fa-brands, regular or solid
            return sprintf(
                '<i aria-hidden="true" class="%s-icon %s %s"></i>',
                $this->classPrefix,
                $this->iconPrefix,
                $icon
            );
        }

        return sprintf(
            '<i aria-hidden="true" class="%s-icon %s %s-%s"></i>',
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
    public function getUseSVG(string $network): string
    {
        if ($network == '') {
            throw new \RuntimeException("You must choose a social network", 1);
        }

        $icon = $network;
        if (isset($this->definitions[$network]['icon'])) {
            $icon = $this->definitions[$network]['icon'];
        }

        return sprintf(
            '<svg aria-hidden="true" class="%s-icon %s %s-%s"><use xlink:href="%s#%s-%s"></use></svg>',
            $this->classPrefix,
            $this->iconPrefix,
            $this->iconPrefix,
            $icon,
            $this->svgUrl,
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
    public function getLink(string $network, string $icon = ''): string
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
            '<a title="%s" class="%s" target="_blank" rel="nofollow noopener" href="%s">%s<span class="%s-name">%s</span></a>',
            $this->getNetworkShareActionLabel($network),
            implode(' ', $linkClassesMerged),
            $this->getUrl($network),
            $icon,
            $this->classPrefix,
            $this->getNetworkDisplayTitle($network)
        );
    }

    /**
     * Returns network display title to populate button and links labels.
     *
     * @param string $network
     * @return string
     */
    public function getNetworkDisplayTitle(string $network): string
    {
        if (!empty($this->definitions[$network]['display_title'])) {
            return $this->definitions[$network]['display_title'];
        }
        return ucfirst(str_replace('-', ' ', $network));
    }

    /**
     * @param string $network
     * @return string Return the action label for accessibility matters.
     */
    public function getNetworkShareActionLabel(string $network): string
    {
        return sprintf($this->getShareActionLabel(), $this->getNetworkDisplayTitle($network));
    }

    /**
     * Get HTML links tags without icon but text
     * for given social networks.
     *
     * @param array<string>|string $networks
     * @param  string $separator
     * @return string
     */
    public function getLinks($networks = [], string $separator = ''): string
    {
        if (\is_string($networks)) {
            return $this->getLink($networks);
        } elseif (\is_array($networks)) {
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
     * @param  array<string>|string  $networks
     * @param  string $separator
     * @return string
     */
    public function getLinksWithIcon($networks = [], string $separator = ''): string
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
     * @param array<string>|string  $networks
     * @param  string $separator
     * @return string
     */
    public function getLinksWithSVG($networks = [], string $separator = ''): string
    {
        if (is_string($networks)) {
            return $this->getLink($networks, $this->getUseSVG($networks));
        } elseif (\is_array($networks)) {
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
     * @return array<string>
     */
    public function getAvailableSocialNetworks(): array
    {
        return array_keys($this->definitions);
    }

    /**
     * Tell if SocialLinks supports given network.
     *
     * @param  string $network
     * @return bool
     */
    public function supports(string $network): bool
    {
        return isset($this->definitions[$network]);
    }

    /**
     * Gets the value of classPrefix.
     *
     * @return string
     */
    public function getClassPrefix(): string
    {
        return $this->classPrefix;
    }

    /**
     * Sets the value of classPrefix.
     *
     * @param string $classPrefix the class prefix
     *
     * @return static
     */
    public function setClassPrefix(string $classPrefix): self
    {
        $this->classPrefix = $classPrefix;

        return $this;
    }

    /**
     * Gets the value of iconPrefix.
     *
     * @return string
     */
    public function getIconPrefix(): string
    {
        return $this->iconPrefix;
    }

    /**
     * Sets the value of iconPrefix.
     *
     * @param string $iconPrefix the icon prefix
     *
     * @return static
     */
    public function setIconPrefix(string $iconPrefix): self
    {
        $this->iconPrefix = $iconPrefix;

        return $this;
    }

    /**
     * Gets the value of svgUrl.
     *
     * @return string
     */
    public function getSvgUrl(): string
    {
        return $this->svgUrl;
    }

    /**
     * Sets the value of svgUrl.
     *
     * @param string $svgUrl the icon prefix
     *
     * @return self
     */
    public function setSvgUrl(string $svgUrl): self
    {
        $this->svgUrl = $svgUrl;

        return $this;
    }

    /**
     * Gets the value of linkClasses.
     *
     * @return string
     */
    public function getLinkClasses(): string
    {
        return $this->linkClasses;
    }

    /**
     * Sets the value of linkClasses.
     *
     * @param string $linkClasses the link classes
     *
     * @return self
     */
    public function setLinkClasses(string $linkClasses): self
    {
        $this->linkClasses = $linkClasses;

        return $this;
    }

    /**
     * @return string
     */
    public function getShareActionLabel(): string
    {
        return $this->shareActionLabel;
    }

    /**
     * @param string $shareActionLabel
     *
     * @return SocialLinks
     */
    public function setShareActionLabel(string $shareActionLabel): self
    {
        $this->shareActionLabel = $shareActionLabel;

        return $this;
    }
}
