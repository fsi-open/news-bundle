Feature: News archive
  As a regular web user
  In order to read news archive
  I need to enter news archive page

  Scenario: Display news archive page
    Given There are 10 news in database
    When I open "News Archive" page
    Then I should see 5 news at list
    And I should see pagination with following buttons
      | Button   | Disabled | Current |
      | Previous | true     | false   |
      | 1        | false    | true    |
      | 2        | false    | false   |
      | Next     | false    | false   |

  Scenario: Access archive second page
    Given There are 10 news in database
    When I open "News Archive" page
    And I press pagination "Next" button
    Then I should see 5 news at list
    And I should see pagination with following buttons
      | Button   | Disabled | Current |
      | Previous | false    | false   |
      | 1        | false    | false   |
      | 2        | false    | true    |
      | Next     | true     | false   |