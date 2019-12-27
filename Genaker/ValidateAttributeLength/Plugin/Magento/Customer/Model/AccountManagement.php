<?php


namespace Genaker\ValidateAttributeLength\Plugin\Magento\Customer\Model;

use \Magento\Framework\Exception\LocalizedException;

class AccountManagement
{

    public function beforeCreateAccount(
        \Magento\Customer\Model\AccountManagement $subject,
        $customer
    )
    {
        $regexp = '/(?:(?:https?|ftp|file):\/\/|www\.|ftp\.)(?:\([-A-Z0-9+&@#\/%=~_|$?!:,.]*\)|[-A-Z0-9+&@#\/%=~_|$?!:,.])*(?:\.[A-Z0-9]{1,})\.?/im';
        $firstName = $customer->getFirstname();
        $lastName = $customer->getLastname();

        if (strlen($firstName) > 70 || strlen($lastName) > 70) {
            throw new \Exception(__("Name to long"));
        } elseif (preg_match($regexp, $lastName . $firstName)) {
            throw new LocalizedException(__("Site name doesn't allowed"));
        }
    }
}
