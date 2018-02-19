<?php

namespace Sokil\Vast\Creative\InLine;

use Sokil\Vast\Creative\CompanionCreative;
use Sokil\Vast\Creative\InLine\CompanionAds\HTMLResource;
use Sokil\Vast\Creative\InLine\CompanionAds\CompanionAd;

class CompanionAds extends CompanionCreative
{

    /**
     * @return CompanionAd
     */
    public function createCompanion()
    {
        if (empty($this->companionDomElement)) {
            $this->companionDomElement = $this->getDomElement()->getElementsByTagName('Companion')->item(0);
            if (!$this->companionDomElement) {
                $this->companionDomElement = $this->getDomElement()->ownerDocument->createElement('Companion');
                $this->getDomElement()->firstChild->appendChild($this->companionDomElement);
            }
        }

        // object
        return new CompanionAd($this->companionDomElement);
    }
}
