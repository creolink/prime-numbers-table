Feature: Prime Table
  In order to display table with prime numbers
  I need to provide quantity of numbers
  Or last prime number for generator
  Then I should get table with prime numbers
  Or error for wrong values

  Scenario: Trying to display table with empty values
    Given I do not provide any parameters
    When I execute command
    Then I should get empty table

  Scenario Outline: Trying to display table with quantity bigger than 0
    Given I provide <quantity> in command
    When I execute command
    Then I should get <total> prime numbers
    And I should get table with <min_multiplication> value
    And table should contain <max_multiplication>

    Examples:
      | quantity | total | min_multiplication | max_multiplication |
      | 2        | 2     | 4                  | 9                  |
      | 5        | 5     | 4                  | 121                |
      | 12       | 12    | 4                  | 1369               |

