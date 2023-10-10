<?php

/**
 * Adminhtml simiconnector list block
 *
 */

namespace Simi\Simiconnector\Block\Adminhtml;

class Simiclickcount extends \Magento\Backend\Block\Widget\Grid\Container
{

    /**
     * Constructor
     *
     * @return void
     */
    public function _construct()
    {
        $this->_controller = 'adminhtml_simiclickcount';
        $this->_blockGroup = 'Simi_Simiconnector';
        parent::_construct();
        $this->buttonList->remove('add');
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    public function _isAllowedAction($resourceId)
    {
        return true;
    }
}
