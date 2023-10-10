<?php
namespace Simi\Simiconnector\Model\Api;

use Magento\Framework\Exception\LocalizedException;

class Trackuser extends Apiabstract
{
    /**
     * @return mixed
     */
    public function setBuilderQuery()
    {
        $clickCountCollection = $this->simiObjectManager
            ->get('Simi\Simiconnector\Model\Simiclickcount')->getCollection();
        $this->builderQuery = $clickCountCollection;
        return $clickCountCollection;
    }

    /**
     * @return void
     * @throws LocalizedException
     */
    public function store()
    {
        $collection = $this->builderQuery;
        $data = $this->getData();
        $parameters = null;
        if (isset($data['contents'])) {
            $parameters = (array)$data['contents'];
        }
        try {
            $customerId = 0;
            if (isset($parameters['customer_id'])) {
                $customerId = $parameters['customer_id'];
            }
            $customer = $collection->addFieldToFilter('customer_id', $customerId)->getFirstItem();
            if ($customer->getEntityId()) {
                $count = $customer->getCount();
                $count += 1;
                $customer->setCount($count);
                $customer->save();
            } else {
                $customerEmail = "Guest";
                if ($customerId != 0) {
                    $customerById = $this->simiObjectManager->create('Magento\Customer\Api\CustomerRepositoryInterface')->getById($customerId);
                    if ($customerById->getId()) {
                        $customerEmail = $customerById->getEmail();
                    } else {
                        throw new LocalizedException(__("Customer doesn't exists."));
                    }
                }
                $count = 1;
                $newRecord = $collection->getNewEmptyItem();
                $newRecord->setData(
                    [
                        'customer_id' => $customerId,
                        'email' => $customerEmail,
                        'count' => $count
                    ]
                );
                $collection->addItem($newRecord);
                $collection->save();
            }
        } catch (\Exception $exception) {
            throw new LocalizedException(__("Customer does not exists."));
        }
    }
}
