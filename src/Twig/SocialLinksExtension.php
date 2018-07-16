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
 * @file SocialLinksExtension.php
 * @author Ambroise Maupate
 */
namespace RZ\SocialLinks\Twig;

use RZ\SocialLinks\SocialLinks;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Provide a handy twig extension to use SocialLinks.
 */
class SocialLinksExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('social_links', [$this, 'getSocialLinks'], ['is_safe' => ['html']]),
            new TwigFilter('icon_social_links', [$this, 'getSocialLinksWithIcon'], ['is_safe' => ['html']]),
            new TwigFilter('svg_social_links', [$this, 'getSocialLinksWithSVG'], ['is_safe' => ['html']]),
            new TwigFilter('tweet_links', [$this, 'parseTweetLinks'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @param $string
     * @return mixed
     */
    public function parseTweetLinks($string)
    {
        $string = preg_replace(
            "@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@",
            '<a rel="nofollow noopener" target="_blank" href="$1">$1</a>',
            $string
        );
        $string = preg_replace(
            "/@(\w+)/",
            ' <a rel="nofollow noopener" target="_blank" href="http://twitter.com/$1">@$1</a>',
            $string
        );
        $string = preg_replace(
            "/\s+#(\w+)/",
            ' <a rel="nofollow noopener" target="_blank" href="http://twitter.com/search?q=%23$1">#$1</a>',
            $string
        );
        return $string;
    }

    /**
     * @param array|string $data
     * @param array|string $networks
     * @param string $iconPrefix Default: 'fa'
     * @param string $classPrefix Default: 'social-link'
     * @param string $linkClasses Default: ''
     * @param string $shareActionLabel
     *
     * @return string
     * @throws \Exception
     */
    public function getSocialLinks(
        $data,
        $networks,
        $iconPrefix = 'fa',
        $classPrefix = 'social-link',
        $linkClasses = '',
        $shareActionLabel = 'Share on %s'
    ) {
        if (is_string($data)) {
            $data = array(
                'url' => $data,
            );
        } elseif (!is_array($data)) {
            throw new \Exception("Social links data must be an array or a string", 1);
        }

        $share = new SocialLinks($data);
        $share->setLinkClasses($linkClasses);
        $share->setClassPrefix($classPrefix);
        $share->setIconPrefix($iconPrefix);
        $share->setShareActionLabel($shareActionLabel);
        return $share->getLinks($networks);
    }

    /**
     * @param array|string $data
     * @param array|string $networks
     * @param string $iconPrefix Default: 'fa'
     * @param string $classPrefix Default: 'social-link'
     * @param string $linkClasses Default: ''
     * @param string $shareActionLabel
     *
     * @return string
     * @throws \Exception
     */
    public function getSocialLinksWithIcon(
        $data,
        $networks,
        $iconPrefix = 'fa',
        $classPrefix = 'social-link',
        $linkClasses = '',
        $shareActionLabel = 'Share on %s'
    ) {
        if (is_string($data)) {
            $data = array(
                'url' => $data,
            );
        } elseif (!is_array($data)) {
            throw new \Exception("Social links data must be an array or a string", 1);
        }

        $share = new SocialLinks($data);
        $share->setLinkClasses($linkClasses);
        $share->setClassPrefix($classPrefix);
        $share->setIconPrefix($iconPrefix);
        $share->setShareActionLabel($shareActionLabel);
        return $share->getLinksWithIcon($networks);
    }

    /**
     * @param array|string $data
     * @param array|string $networks
     * @param string $iconPrefix Default: 'fa'
     * @param string $classPrefix Default: 'social-link'
     * @param string $linkClasses Default: ''
     * @param string $shareActionLabel
     *
     * @return string
     * @throws \Exception
     */
    public function getSocialLinksWithSVG(
        $data,
        $networks,
        $iconPrefix = 'fa',
        $classPrefix = 'social-link',
        $linkClasses = '',
        $shareActionLabel = 'Share on %s'
    ) {
        if (is_string($data)) {
            $data = array(
                'url' => $data,
            );
        } elseif (!is_array($data)) {
            throw new \Exception("Social links data must be an array or a string", 1);
        }

        $share = new SocialLinks($data);
        $share->setLinkClasses($linkClasses);
        $share->setClassPrefix($classPrefix);
        $share->setIconPrefix($iconPrefix);
        $share->setShareActionLabel($shareActionLabel);
        return $share->getLinksWithSVG($networks);
    }
}
