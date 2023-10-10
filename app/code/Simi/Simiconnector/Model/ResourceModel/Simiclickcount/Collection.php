<?php
namespace Simi\Simiconnector\Model\ResourceModel\Simiclickcount;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            \Simi\Simiconnector\Model\Simiclickcount::class,
            \Simi\Simiconnector\Model\ResourceModel\Simiclickcount::class
        );
    }
}
