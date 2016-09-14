# Behat Tests

Sample tests done for a PHP meetup (https://github.com/qdelance/drink_and_drupal/tree/master/functionnal_tests)

Should work with:
```bash
composer install
java -jar selenium/selenium-server-standalone-2.53.0.jar  -Dwebdriver.chrome.driver=/usr/lib/chromium-browser/chromedriver
./vendor/behat/behat/bin/behat features/*.feature
```

04/12/2016 is hardcoded somewhere in scenarii, so it won't work after ;)
