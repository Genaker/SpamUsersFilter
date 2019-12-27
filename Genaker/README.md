# SpamUsersFilter
Adds fields limitation rules from Customer attributes. By default it is 256 and spammers can send spam messages also it checks if  attribute has URLs.

# How it works
Check some logic before creating user account 

```php
  public function beforeCreateAccount(
        \Magento\Customer\Model\AccountManagement $subject,
        $customer
    )
    {
        $regexp = '/(?:(?:https?|ftp|file):\/\/|www\.|ftp\.)(?:\([-A-Z0-9+&@#\/%=~_|$?!:,.]*\)|[-A-Z0-9+&@#\/%=~_|$?!:,.])*(?:\.[A-Z0-9]{1,})\.?/im';
        $firstName = $customer->getFirstname();
        $lastName = $customer->getLastname();

        if (strlen($firstName) > 70 || strlen($lastName) > 70) {
            throw new \Exception(__("Name is to long"));
        } elseif (preg_match($regexp, $lastName . $firstName)) {
            throw new LocalizedException(__("Site name doesn't allowed"));
        }
    }
```

#Installation 

cd [magento root dir]/app/code/

git clone   https://github.com/Genaker/SpamUsersFilter.git 

mv SpamUsersFilter/* .
rm -rf SpamUsersFilter
cd ../..

php bin/magento setup:static-content:deploy --keep-generated
php bin/magento  setup:di:compile

If you can contribute composer installation please do it 