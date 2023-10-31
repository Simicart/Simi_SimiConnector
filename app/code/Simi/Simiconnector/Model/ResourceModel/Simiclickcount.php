<?php
namespace Simi\Simiconnector\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Simiclickcount extends AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('simiconnector_customer_click_count', 'entity_id');
    }
}
