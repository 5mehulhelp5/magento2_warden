<?php

namespace RajNishad\Checkout\Plugin;

use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Quote\Api\CartRepositoryInterface;

class SaveContactInfoPlugin
{
    protected $quoteRepository;

    public function __construct(CartRepositoryInterface $quoteRepository)
    {
        $this->quoteRepository = $quoteRepository;
    }

    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        ShippingInformationInterface $addressInformation
    ) {
        $extensionAttributes = $addressInformation->getExtensionAttributes();
        if ($extensionAttributes) {
            $quote = $this->quoteRepository->getActive($cartId);
            $quote->setData('contact_firstname', $extensionAttributes->getContactFirstname());
            $quote->setData('contact_lastname', $extensionAttributes->getContactLastname());
            $quote->setData('contact_email', $extensionAttributes->getContactEmail());
            $quote->setData('contact_telephone', $extensionAttributes->getContactTelephone());
            $this->quoteRepository->save($quote);
        }
    }
}
