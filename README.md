# SpamUsersFilter
Adds fields limitation rules for Customer attributes. By default it is 256 and spammers can send spam messages also it checks if  attribute has URLs.

Bots automatically create customer accounts, but the email addresses used are not wrong. In recent cases, there were mostly e-mail accounts from @ mail.ru, @ gmail.ru, @inbox.ru, @ Bk.ru, @ List.ru, @ qq.com and other Russian mail hosting. Generally, there probably most of the mail addresses and thus available after login in the respective shop a confirmation email from that = it therefore be true emails from a real shop (-sender) sent to real people. That would be so intent 1. Now the question “Why? It's just a normal sign-up confirmation email…”. Ja, BUT it is the bots use for their “advertising message” the customer name. Main idea of the spammers to use yours email server to send spam emails.

Spam registrations are a result of bots all over the internet, trying to exploit your store and harm your business. The fake signup process uses the fake email address or the real Email IDs without the knowledge of the owners. Such activity harms your email marketing campaign. The email addresses used in registration or newsletter subscriptions receive undesirable newsletters. Your store may be marked spam due to such unwanted emails and if done on large scale, Gmail may blacklist you, hence your newsletter will not be delivered to subscribers.

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

# Installation 

cd [magento root dir]/app/code/

git clone   https://github.com/Genaker/SpamUsersFilter.git 

mv SpamUsersFilter/* .
rm -rf SpamUsersFilter
cd ../..

php bin/magento setup:static-content:deploy --keep-generated
php bin/magento  setup:di:compile

If you can contribute composer installation please do it 
