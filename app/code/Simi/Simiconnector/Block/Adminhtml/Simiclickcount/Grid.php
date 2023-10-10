<?php

namespace Simi\Simiconnector\Block\Adminhtml\Simiclickcount;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Helper\Data;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Module\Manager;
use Simi\Simiconnector\Helper\Website;
use Simi\Simiconnector\Model\ResourceModel\Simiclickcount\CollectionFactory;
use Simi\Simiconnector\Model\SimiclickcountFactory;

/**
 * Adminhtml Connector grid
 */
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Simi\Simiconnector\Model\Simiclickcount
     */
    public $clickCountFactory;

    /**
     * @var \Simi\Simiconnector\Model\ResourceModel\Simiclickcount\CollectionFactory
     */
    public $collectionFactory;

    /**
     * @var \Magento\Framework\Module\Manager
     */
    public $moduleManager;

    /**
     * @var order model
     */
    public $resource;

    /**
     * @var \Simi\Simiconnector\Helper\Website
     * */
    public $websiteHelper;

    /**
     * @param Context $context
     * @param Data $backendHelper
     * @param SimiclickcountFactory $simiclickcountFactory
     * @param CollectionFactory $collectionFactory
     * @param Manager $moduleManager
     * @param ResourceConnection $resourceConnection
     * @param Website $websiteHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Simi\Simiconnector\Model\SimiclickcountFactory $simiclickcountFactory,
        \Simi\Simiconnector\Model\ResourceModel\Simiclickcount\CollectionFactory $collectionFactory,
        \Magento\Framework\Module\Manager $moduleManager,
        \Magento\Framework\App\ResourceConnection $resourceConnection,
        array $data = []
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->moduleManager = $moduleManager;
        $this->resource = $resourceConnection;
        $this->clickCountFactory = $simiclickcountFactory;

        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * Prepare collection
     *
     * @return \Magento\Backend\Block\Widget\Grid
     */
    public function _prepareCollection()
    {
        $collection = $this->collectionFactory->create();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * Prepare columns
     *
     * @return \Magento\Backend\Block\Widget\Grid\Extended
     */
    public function _prepareColumns()
    {
        $this->addColumn('entity_id', [
            'header' => __('Entity ID'),
            'align' => 'right',
            'width' => '50px',
            'index' => 'entity_id',
        ]);

        $this->addColumn('customer_id', [
            'header' => __('Customer ID'),
            'align' => 'left',
            'index' => 'customer_id'
        ]);

        $this->addColumn('email', [
            'header' => __('Email'),
            'align' => 'left',
            'index' => 'email'
        ]);

        $this->addColumn('count', [
            'header' => __('Count'),
            'align' => 'left',
            'index' => 'count'
        ]);

        return parent::_prepareColumns();
    }
}
