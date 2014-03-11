Feature: Access news details page
  In order to read news
  As a user interested in news content
  I should follow "Read more" link at latest news list

  Scenario: Access news details page
    Given There are 5 news in database
    And I am on the "Homepage" page
    When I follow "Read more" link from first news
    Then I should see news content