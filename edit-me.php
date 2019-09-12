<?php

namespace Cloudinary\Samples;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/SamplePage/SamplePage.php';
require_once __DIR__ . '/SamplePage/Sample/TransformationSample.php';

use Cloudinary\ClassUtils;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Transformation\Common\Argument\Text\FontFamily;
use Cloudinary\Transformation\Common\Argument\Text\FontWeight;
use Cloudinary\Transformation\Common\Argument\Text\TextStyle;
use Cloudinary\Transformation\Effect;
use Cloudinary\Transformation\ImageLayer;
use Cloudinary\Transformation\Position;
use Cloudinary\Transformation\Resize;
use Cloudinary\Transformation\Transformation;

Configuration::instance(['account' => ['cloud_name' => 'demo']]);

$sample = [
    "name"      => "Sample", //group name
    "iconClass" => "fas fa-camera",
    "items"     => [
        [
            "name"  => "Your Transformation", //subGroup name
            "items" => [
                [
                    (new Transformation())
                        ->resize(
                            Resize::fill(220, 140)
                        )->overlay(
                            ImageLayer::image('brown_sheep')->resize(Resize::fill(220, 140)),
                            Position::absolute(220)
                        )->overlay(
                            ImageLayer::image('horses')->resize(Resize::fill(220, 140)),
                            Position::absolute(-110, 140)
                        )->overlay(
                            ImageLayer::image('white_chicken')->resize(Resize::fill(220, 140)),
                            Position::absolute(110, 70)
                        )->overlay(
                            ImageLayer::image('butterfly')->resize(Resize::scale()->height(200))->rotate(10),
                            Position::absolute(-10)
                        )->resize(Resize::crop(400, 260))
                        ->roundCorners(20)
                        ->overlay(
                            ImageLayer::text('Memories from our trip')
                                      ->style((new TextStyle(FontFamily::PARISIENNE, 35))->fontWeight(FontWeight::BOLD))
                                      ->color('#990C47'),
                            Position::absolute()->y(155)
                        )->effect(Effect::shadow())
                    ,
                    '(new Transformation())
    ->resize(
        Resize::fill(220, 140)
    )->overlay(
        ImageLayer::image(\'brown_sheep\')->resize(Resize::fill(220, 140)),
        Position::absolute(220)
    )->overlay(
        ImageLayer::image(\'horses\')->resize(Resize::fill(220, 140)),
        Position::absolute(-110, 140)
    )->overlay(
        ImageLayer::image(\'white_chicken\')->resize(Resize::fill(220, 140)),
        Position::absolute(110, 70)
    )->overlay(
        ImageLayer::image(\'butterfly\')->resize(Resize::scale()->height(200))->rotate(10),
        Position::absolute(-10)
    )->resize(Resize::crop(400, 260))
    ->roundCorners(20)
    ->overlay(
        ImageLayer::text(\'Memories from our trip\')
                  ->style((new TextStyle(FontFamily::PARISIENNE, 35))->fontWeight(FontWeight::BOLD))
                  ->color(\'#990C47\'),
        Position::absolute()->y(155)
    )->effect(Effect::shadow())',
                ],
            ],
        ],
    ],
];

/**
 * Converts arrays to TransformationSample
 *
 * @param $group
 *
 * @return mixed
 */
function createSampleGroup($group)
{
    foreach ($group['items'] as &$subGroup) {
        if (! isset($subGroup['publicId'])) {
            $subGroup['publicId'] = isset($group['publicId']) ? $group['publicId'] : "yellow_tulip";
        }

        foreach ($subGroup['items'] as &$sampleArray) {
            array_push($sampleArray, ($subGroup['publicId']));
            $sampleArray = ClassUtils::verifyVarArgsInstance($sampleArray, TransformationSample::class);
        }
    }

    return $group;
}

$page = new SamplePage(
    "PHP SDK v2 Transformation Sample",
    "Cloudinary - PHP SDK v2 Transformation Samples"
);

$page->addGroup(createSampleGroup($sample));
$page->currentNavLink = 2;

echo $page;
