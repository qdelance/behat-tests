<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Definition\Call\When;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{

    /**
     * Price stored while selecting a ticket
     *
     * @var string
     */
    private $price = '';

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * Click on an element selected by CSS
     *
     * @When /^I click on css element "([^"]*)"$/
     */
    public function iClickOnCssElement($element)
    {
        $page = $this->getSession()->getPage();
        $findName = $page->find("css", $element);
        if (!$findName) {
            throw new Exception($element." could not be found");
        } else {
            $findName->click();
        }
    }

    /**
     * @When /^I click on xpath element "([^"]*)"$/
     */
    public function iClickOnXpathElement($element)
    {
        $page = $this->getSession()->getPage();
        $findName = $page->find("xpath", $element);
        if (!$findName) {
            throw new Exception($element." could not be found");
        } else {
            $findName->click();
        }
    }

    /**
     * @Then /^I should be redirected to "([^"]*)"$/
     */
    public function iShouldBeRedirectedTo($path)
    {
        $this->getSession()->wait(5000);

        $this->assertPageAddress($path);
    }

    /**
     * @Given /^I wait (\d+)$/
     */
    public function iWait($nbMillisec)
    {
        $this->getSession()->wait($nbMillisec);
    }

    /**
     * @Given /^I select the first price$/
     */
    public function iSelectTheFirstPrice()
    {
        $page = $this->getSession()->getPage();
        $elements = $page->findAll("css", ".price-btn");

        if ($elements == null) {
            throw new Exception("Not price proposition found");
        }
        $first = $elements[0];
        $this->price = $first->getText();
        $first->click();
    }

    /**
     * @Given /^I scroll "([^"]*)" into view$/
     */
    public function iScrollIntoView($elementId)
    {
        $function = <<<JS
(function(){
  var elem = document.getElementById("$elementId");
  elem.scrollIntoView(false);
})()
JS;

        try {
            $this->getSession()->executeScript($function);
        } catch (Exception $e) {
            throw new \Exception("ScrollIntoView failed");
        }
    }

    /**
     * @When /^I dismiss warning telling this destination is attractive$/
     */
    public function iDismissWarningTellingThisDestinationIsAttractive()
    {
        $this->iDismissModal("#ab-close-button");
    }

    /**
     * @When /^I dismiss welcome popup$/
     */
    public function iDismissWelcome()
    {
        $this->iDismissModal("#close-modal");
    }

    /**
     * @When /^I dismiss modal "([^"]*)"$/
     */
    public function iDismissModal($closeButtonId)
    {
        $page = $this->getSession()->getPage();
        $button = $page->find("css", $closeButtonId);

        if ($button != null) {
            $button->click();
        }
    }
}
