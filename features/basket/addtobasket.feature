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

  @domain
  Scenario: Buying a single product
    Given there is a "Playstation 4", which costs £250.00
     When I add the "Playstation 4" to the basket
     Then I should have 1 product in the basket
      And the overall basket price should be £250.00

  @domain
  Scenario: Buying multiple products
    Given there is a "Playstation 4 Controller", which costs £45.00
      And there is a "HDMI Cable", which costs £10.00
     When I add the "Playstation 4 Controller" to the basket
      And I add the "HDMI Cable" to the basket
     Then I should have 2 products in the basket
      And the overall basket price should be £65.00

  @domain
  Scenario: The delivery is calculated for a £100 basket
    Given there is a "24 inch TV", which costs £100.00
     When I add the "24 inch TV" to the basket
      Then the overall basket price should be £110.00