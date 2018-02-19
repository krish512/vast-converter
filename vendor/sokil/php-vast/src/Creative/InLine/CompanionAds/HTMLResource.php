<?php

namespace Sokil\Vast\Creative\InLine\CompanionAds;

class HTMLResource
{
    
    private $domElement;
    
    public function __construct(\DomElement $domElement)
    {
        $this->domElement = $domElement;
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

    public function setHTMLResource($html)
    {
        $cdata = $this->domElement->ownerDocument->createCDATASection($html);
    
        // update CData
        if ($this->domElement->hasChildNodes()) {
            $this->domElement->replaceChild($cdata, $this->domElement->firstChild);
        } // insert CData
        else {
            $this->domElement->appendChild($cdata);
        }
        return $this;
    }

}
