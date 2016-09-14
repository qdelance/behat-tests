Feature: VSCT tests
  
  Scenario: Test access to site
    Given I am on the homepage
    Then I should see "Train"
    And I should see "Vol"

  Scenario: Checks search is performed
    Given I am on the homepage
    When  I fill in "vsb-origin-train" with "Toulouse"
    And  I fill in "vsb-destination-train" with "Paris"
    And I fill in "vsb-departure-date-train" with "04/12/2016"
    # We need to expand form first
    # And I click on css element ".booking__button--expandable"
    # And I check "vsb-direct-travel"
    # And I check "vsb-first-class-train"
    And I press "Rechercher"
    And I wait 7000
    Then I should see "Toulouse"
    And I should see "Paris"

  Scenario: Switch to UK
    Given I am on the homepage
    When I click on css element ".vsc__language-ico-fr"
    And I wait 1000
    And I follow "United Kingdom"
    And I dismiss welcome popup
    Then I should see "Train tickets"

  Scenario: Select a ticket
    Given I am on the homepage
    When  I fill in "vsb-origin-train" with "Toulouse"
    And  I fill in "vsb-destination-train" with "Paris"
    And I fill in "vsb-departure-date-train" with "04/12/2016"
    And I press "Rechercher"
    And I wait 7000
    And I select the first price
    And I wait 1000
    # Displays a huge pane, that may not be visible with low resolution unless we scroll before clicking!
    And I scroll "proposal-1-select-button" into view
    And I wait 2000
    # After many identical search (this is the case with tests...),
    # we get a popup telling us many people are search this destination ... hidding the button
    And I dismiss warning telling this destination is attractive
    And I wait 2000
    And I press "proposal-1-select-button"
    And I wait 5000
    Then I should see "Votre réservation"

    # TODO outline