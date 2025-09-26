<?php

namespace MagentoBackendProjects\CatalogDiscount\Model\Quote\Total;

use Magento\Quote\Model\Quote\Address\Total\AbstractTotal;
use Magento\Quote\Api\Data\ShippingAssignmentInterface;
use Magento\Quote\Model\Quote;
use MagentoBackendProjects\CatalogDiscount\Helper\Data;
use Magento\Customer\Model\Session;

class Discount extends AbstractTotal
{
    protected $helper;
    protected $customerSession;

    public function __construct(
        Data $helper,
        Session $customerSession
    ) {
        $this->helper = $helper;
        $this->customerSession = $customerSession;
        $this->setCode('catalogdiscount');
    }

    public function collect(Quote $quote, ShippingAssignmentInterface $shippingAssignment, \Magento\Quote\Model\Quote\Address\Total $total)
    {
        parent::collect($quote, $shippingAssignment, $total);

        $discountGroup = $this->helper->getCustomerGroup();
        $discountPercent = $this->helper->getDiscountPercent();

        if (!$this->customerSession->isLoggedIn() || !$discountGroup || $discountPercent <= 0) {
            return $this;
        }

        if ($this->customerSession->getCustomerGroupId() != $discountGroup) {
            return $this;
        }

        $subtotal = $total->getSubtotal();
        $discountAmount = $subtotal * ($discountPercent / 100);

        $total->addTotalAmount($this->getCode(), -$discountAmount);
        $total->addBaseTotalAmount($this->getCode(), -$discountAmount);

        $quote->setData('catalogdiscount_amount', $discountAmount);

        return $this;
    }
}
