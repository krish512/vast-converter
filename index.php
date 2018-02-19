<?php
header('Content-Type: text/xml');
require_once 'vendor/autoload.php';

$domain = "http://localhost";

$_GET['zone'] or die("<error>zone not passed</error>");

$URL = $domain."/www/delivery/fc.php?script=bannerTypeHtml:vastInlineBannerTypeHtml:vastInlineHtml&format=vast&nz=1&zones=pre-roll%3D".intval($_GET['zone']."&".$_SERVER['QUERY_STRING']);

$xml = simplexml_load_file($URL) or die("<error>Cannot create XML object</error>");

$factory = new \Sokil\Vast\Factory();
$document = (new \Sokil\Vast\Factory())->create('2.0');

if(!$xml->Ad) {
    return $document;
}

// insert Ad section
$ad1 = $document
    ->createInLineAdSection()
    ->setId($xml->Ad['id'])
    ->setAdSystem($xml->Ad->InLine->AdSystem)
    ->setAdTitle($xml->Ad->InLine->AdTitle)
    ->addImpression($xml->Ad->InLine->Impression->URL);

// create creative for ad section
$linearCreative = $ad1
    ->createLinearCreative()
    ->setDuration($xml->Ad->InLine->Video->Duration);

foreach($xml->Ad->InLine->TrackingEvents->Tracking as $TrackingEvent) {
    if($TrackingEvent["event"] == "replay") {
        $linearCreative->addTrackingEvent("rewind", $TrackingEvent->URL);
    }
    else if($TrackingEvent["event"] == "stop") {
        // $linearCreative->addTrackingEvent("pause", $TrackingEvent->URL);
        continue;
    }
    else {
        $linearCreative->addTrackingEvent($TrackingEvent["event"], $TrackingEvent->URL);
    }
}

// add 200x200 media file
$linearCreative
    ->createMediaFile()
    ->setProgressiveDelivery()
    ->setType($xml->Ad->InLine->Video->MediaFiles->MediaFile["type"])
    ->setHeight($xml->Ad->InLine->Video->MediaFiles->MediaFile["height"])
    ->setWidth($xml->Ad->InLine->Video->MediaFiles->MediaFile["width"])
    ->setBitrate($xml->Ad->InLine->Video->MediaFiles->MediaFile["bitrate"])
    ->setUrl($xml->Ad->InLine->Video->MediaFiles->MediaFile->URL);

$companionCreative = $ad1
    ->createCompanionCreative();

$companion = $companionCreative
    ->createCompanion()
    ->setID($xml->Ad->InLine->CompanionAds->Companion['id'])
    ->setHeight($xml->Ad->InLine->CompanionAds->Companion['height'])
    ->setWidth($xml->Ad->InLine->CompanionAds->Companion["width"])
    ->setCompanionClickThrough($xml->Ad->InLine->CompanionAds->Companion->CompanionClickThrough->URL)
    ->createHTMLResource()
    ->setHTMLResource($xml->Ad->InLine->CompanionAds->Companion->Code);


echo $document;