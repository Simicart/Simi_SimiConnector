<?php
namespace Simi\Simiconnector\Model\Config\Source;

use Magento\Directory\Model\AllowedCountries;
use Magento\Directory\Model\ResourceModel\Country\Collection;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\ScopeInterface;

class Country implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Countries
     *
     * @var \Magento\Directory\Model\ResourceModel\Country\Collection
     */
    protected $_countryCollection;

    /**
     * Options array
     *
     * @var array
     */
    protected $_options;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var AllowedCountries
     */
    protected $allowedCountriesReader;

    /**
     * @param AllowedCountries $allowedCountriesReader
     * @param Collection $countryCollection
     */
    public function __construct(
        AllowedCountries $allowedCountriesReader,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Directory\Model\ResourceModel\Country\Collection $countryCollection
    ) {
        $this->allowedCountriesReader = $allowedCountriesReader;
        $this->storeManager = $storeManager;
        $this->_countryCollection = $countryCollection;
    }

    /**
     * Return options array
     *
     * @param boolean $isMultiselect
     * @param string|array $foregroundCountries
     * @return array
     * @throws NoSuchEntityException
     */
    public function toOptionArray($isMultiselect = false, $foregroundCountries = '')
    {
        $simiDefaultCountries = [];
        $allCountries = $this->_countryCollection->loadData()->setForegroundCountries(
            $foregroundCountries
        )->toOptionArray(
            false
        );
        $storeId = $this->storeManager->getStore()->getId();
        $allowCountries = $this->allowedCountriesReader->getAllowedCountries(ScopeInterface::SCOPE_STORE, $storeId);
        foreach ($allCountries as $country) {
            foreach ($allowCountries as $allowCountry) {
                if ($country['value'] == $allowCountry) {
                    $simiDefaultCountries[$country['value']] = $country['label'];
                }
            }
        }

        if (!$this->_options) {
            $this->_options = $simiDefaultCountries;
        }

        $options = $this->_options;
        if (!$isMultiselect) {
            array_unshift($options, ['value' => '', 'label' => __('--Please Select--')]);
        }

        return $options;
    }
}