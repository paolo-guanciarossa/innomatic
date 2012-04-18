<?php
/**
 * Innomatic
 *
 * LICENSE 
 * 
 * This source file is subject to the new BSD license that is bundled 
 * with this package in the file LICENSE.
 *
 * @copyright  1999-2012 Innoteam S.r.l.
 * @license    http://www.innomatic.org/license/   BSD License
 * @link       http://www.innomatic.org
 * @since      Class available since Release 5.0
 */
require_once ('innomatic/wui/widgets/WuiWidget.php');
/**
 * @package WUI
 */
class WuiFile extends WuiWidget
{
    //public $mHint;
    //public $mDisp;
    //public $mSize;
    /*! @public mTabIndex integer - Position of the current element in the tabbing order. */
    //public $mTabIndex = 0;
    public function __construct (
        $elemName,
        $elemArgs = '',
        $elemTheme = '',
        $dispEvents = ''
    )
    {
        parent::__construct($elemName, $elemArgs, $elemTheme, $dispEvents);
        if (! isset($this->mArgs['tabindex']))
            $this->mArgs['tabindex'] = 0;
    }
    protected function generateSource ()
    {
        require_once ('innomatic/wui/dispatch/WuiEventRawData.php');
        $event_data = new WuiEventRawData($this->mArgs['disp'], $this->mName, 'file');
        $this->mLayout = ($this->mComments ? '<!-- begin ' . $this->mName . ' file -->' : '') . '<input class="normal" ' . ((isset($this->mArgs['hint']) and strlen($this->mArgs['hint'])) ? 'onMouseOver="wuiHint(\'' . str_replace("'", "\'", $this->mArgs['hint']) . '\');" onMouseOut="wuiUnHint(); ' : '') . 'type="file" tabindex="' . $this->mArgs['tabindex'] . '"' . ((isset($this->mArgs['size']) and strlen($this->mArgs['size'])) ? ' size="' . $this->mArgs['size'] . '"' : '') . ' name="' . $event_data->getDataString() . '">' . ($this->mComments ? '<!-- end ' . $this->mName . " file -->\n" : '');
        return true;
    }
}
