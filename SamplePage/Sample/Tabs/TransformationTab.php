<?php

namespace Cloudinary\Samples;

require_once __DIR__ . '/../../SamplePageUtils.php';

use Cloudinary\Asset\Image;
use Cloudinary\Asset\Video;
use Cloudinary\Transformation\Transformation;

/**
 * Class TransformationTab
 *
 * @package Cloudinary\Samples
 */
class TransformationTab extends BaseTab
{
    /**
     * @var string
     */
    protected $publicId;

    /**
     * @var Transformation
     */
    protected $transformation;

    /**
     * @var string
     */
    protected $type;

    /**
     * SampleTransformationTab constructor.
     * @param $transformation
     * @param $code
     * @param $publicId
     * @param string $title
     * @param string $type
     */
    public function __construct($transformation, $code, $publicId, $title = "URL", $type = "image")
    {
        parent::__construct($title);
        $this->transformation = $transformation;
        $this->publicId       = $publicId;
        $this->text           = $code;
        $this->type           = $type;
    }

    public function getTabContent()
    {
        $url = $this->calculateUrl();
        return '
        <div
         class="url-content ml-3 tab-pane fade"
         role="tabpanel"
         aria-labelledby="url-tab"
        >
            <a href="' . $url . '">' .
            getFormattedUrl(
                $url,
                $this->transformation
            ) .
            '</a>
        </div>
        </div>           
          </div>';
    }

    private function calculateUrl()
    {
        $tag = $this->type == "video" ? Video::upload($this->publicId) : Image::upload($this->publicId);
        return $tag->toUrl($this->transformation);
    }
}
