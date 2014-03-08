Feature: Display news list
  As a regular web user
  In order to read news
  I need to enter page with news list

  Scenario: Access page with latest news
    Given There are 10 news in database
    And I am on the "Homepage" page
    Then I should see latest news
