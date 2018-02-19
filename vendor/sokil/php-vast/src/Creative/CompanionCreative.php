<?php

namespace Sokil\Vast\Creative;

use Sokil\Vast\Document\AbstractNode;

abstract class CompanionCreative extends AbstractNode
{

    /**
     * @var \DOMElement
     */
    private $companionCreativeDomElement;

    /**
     * @var \DOMElement
     */
    private $trackingEventsDomElement;

    /**
     * @param \DOMElement $companionCreativeDomElement
     */
    public function __construct(\DOMElement $companionCreativeDomElement)
    {
        $this->companionCreativeDomElement = $companionCreativeDomElement;
    }

    /**
     * @return \DOMElement
     */
    protected function getDomElement()
    {
        return $this->companionCreativeDomElement;
    }

    /**
     * Set creative click through url
     *
     * @param string $url
     * @return $this
     */
    public function setCreativeClickThrough($url)
    {
        // create cdata
        $cdata = $this->getDomElement()->ownerDocument->createCDATASection($url);

        // create ClickThrough
        $clickThroughDomElement = $this->getCompanionAdsDomElement()->getElementsByTagName('CompanionClickThrough')->item(0);
        if (!$clickThroughDomElement) {
            $clickThroughDomElement = $this->getDomElement()->ownerDocument->createElement('CompanionClickThrough');
            $this->getCompanionAdsDomElement()->appendChild($clickThroughDomElement);
        }

        // update CData
        if ($clickThroughDomElement->hasChildNodes()) {
            $clickThroughDomElement->replaceChild($cdata, $clickThroughDomElement->firstChild);
        } else { // insert CData
            $clickThroughDomElement->appendChild($cdata);
        }

        return $this;
    }
}