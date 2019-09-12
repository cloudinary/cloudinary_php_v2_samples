<?php

namespace Cloudinary\Samples;

require_once __DIR__ . '/../../SamplePageUtils.php';

/**
 * Class TagTab
 *
 * @package Cloudinary\Samples
 */
class TagTab extends BaseTab
{
    /**
     * @var string
     */
    protected $html;

    /**
     * TagTab constructor.
     *
     * @param string $code
     * @param string $html
     * @param string $title
     */
    public function __construct($code = "", $html = "", $title = "TAG")
    {
        parent::__construct($title, $code);

        $this->html = $html;
    }

    public function getTabContent()
    {
        // TODO: add getFormattedHtml() function to SamplePageUtils

        return '
        <div
         class="url-content ml-3 tab-pane fade"
         role="tabpanel"
         aria-labelledby="url-tab"
        >' .
            getFormattedHtml($this->html) .
               '</div>
        </div>           
          </div>';
    }
}
