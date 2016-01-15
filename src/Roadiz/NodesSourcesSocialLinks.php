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
 * @file NodesSourcesSocialLinks.php
 * @author Ambroise Maupate
 */
namespace RZ\SocialLinks\Roadiz;

use RZ\Roadiz\Core\Entities\NodesSources;
use RZ\Roadiz\Utils\UrlGenerators\NodesSourcesUrlGenerator;
use RZ\SocialLinks\SocialLinks;
use Symfony\Component\HttpFoundation\Request;

/**
 * SocialLinks wrapper to be used with a Roadiz’ node-source.
 */
class NodesSourcesSocialLinks extends SocialLinks
{
    /**
     * @param NodesSources $source
     * @param Request      $request
     * @param boolean      $forceLocale
     * @param array        $data   To override node-source data with custom ones.
     */
    public function __construct(NodesSources $source, Request $request, $forceLocale = false, $data = array())
    {
        $this->title = $source->getTitle();

        $nsUrlGenerator = new NodesSourcesUrlGenerator($request, $source, $forceLocale);
        $this->url = $nsUrlGenerator->getUrl(true);

        parent::__construct($data);
    }
}
