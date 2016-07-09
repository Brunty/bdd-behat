@reset-em
Feature: Product basket
  In order to buy products
  As a customer
  I need to be able to put products into a basket
  So that I can buy gifts for friends

  Rules:
  - Delivery is £10 on orders under (or equal to) £100
  - Delivery is free on orders over £100

  # Further tests to write could be:
  #
  # Adding multiple of the same product to the basket (would require a change to the way the basket and product entities relate to each other
  # Dealing with prices that are edge-cases to the above rules

  # When dealing with UI tests, depending on what's the important part, you can often do the setup (Given) without interacting with the UI, and only really perform the action (When) step through the UI, doing the assertion (Then) at a lower level (DB etc)

  @domain @webui
  Scenario: Buying a single product
    Given there is a "Playstation 4", which costs £250
     When I add the "Playstation 4" to the basket
     Then I should have 1 product in the basket
      And the overall basket price should be £250

  @domain @webui
  Scenario: Buying multiple products
    Given there is a "Playstation 4 Controller", which costs £45
      And there is a "HDMI Cable", which costs £10
     When I add the "Playstation 4 Controller" to the basket
      And I add the "HDMI Cable" to the basket
     Then I should have 2 products in the basket
      And the overall basket price should be £65

  @domain @webui @javascript
  Scenario: The delivery is calculated for a £100 basket
    Given there is a "24 inch TV", which costs £100
     When I add the "24 inch TV" to the basket
      Then the overall basket price should be £110

  @wip
  Scenario: This is a work-in-progress
    Given I have a known state
    When I do a thing
    Then I should see the result of doing a thing

  @inprog
  Scenario: This is also in progress
    Given I have a known state
    When I do an awesome thing
    Then I should see the result of doing a thing
    And it should be awesome