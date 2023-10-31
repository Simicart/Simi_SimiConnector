<?php
namespace Simi\Simiconnector\Model;

use Magento\Framework\Model\AbstractModel;

class Simiclickcount extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init(\Simi\Simiconnector\Model\ResourceModel\Simiclickcount::class);
    }
}
