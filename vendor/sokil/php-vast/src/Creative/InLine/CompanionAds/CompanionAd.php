<?php

namespace Sokil\Vast\Creative\InLine\CompanionAds;

use Sokil\Vast\Creative\InLine\CompanionAds;
use Sokil\Vast\Creative\InLine\CompanionAds\HTMLResource;

class CompanionAd extends CompanionAds
{
    
    private $domElement;
    
    public function __construct(\DomElement $domElement)
    {
        $this->domElement = $domElement;
    }

    /**
     * Instance of "\Vast\Ad\(InLine|Wrapper)" emenet
     *
     * @return \DOMElement
     */
    protected function getDomElement()
    {
        return $this->domElement;
    }

    /**
     * @return HTMLResource
     */
    public function createHTMLResource()
    {
        if (empty($this->htmlResourceDomElement)) {
            $this->htmlResourceDomElement = $this->getDomElement()->getElementsByTagName('HTMLResource')->item(0);
            if (!$this->htmlResourceDomElement) {
                $this->htmlResourceDomElement = $this->getDomElement()->ownerDocument->createElement('HTMLResource');
                $this->getDomElement()->appendChild($this->htmlResourceDomElement);
            }
        }

        // object
        return new HTMLResource($this->htmlResourceDomElement);
    }

    public function setID($id)
    {
        $this->domElement->setAttribute('id', $id);
        return $this;
    }
    
    public function setWidth($width)
    {
        $this->domElement->setAttribute('width', $width);
        return $this;
    }
    
    public function setHeight($height)
    {
        $this->domElement->setAttribute('height', $height);
        return $this;
    }

    public function setCompanionClickThrough($url)
    {
        $cdata = $this->domElement->ownerDocument->createCDATASection($url);

        $clickThrough = $this->getDomElement()->getElementsByTagName('CompanionClickThrough')->item(0);
        if (!$clickThrough) {
            $clickThrough = $this->getDomElement()->ownerDocument->createElement('CompanionClickThrough');
            $this->getDomElement()->appendChild($clickThrough);
        }


        $clickThrough = $this->getDomElement()->getElementsByTagName('CompanionClickThrough')->item(0);
        $clickThrough->appendChild($cdata);

        return $this;
    }

}
