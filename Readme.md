# Order Processing System

## Introduction

The Order Processing System is a software application designed to manage and process customer orders efficiently. 

This README provides an overview of the application's main components and its design patterns used .

## Table of Contents

- [Order](#Order)
  - [Order Receipt](#order_receipt)
  - [Order Status](#order_status)
- [Shipping](#shipping)
- [Products](#products)
- [Testing](#testing)
- [Docker](#docker)
- [Usage](#Usage)

### Order

#### Creating an Order

- I have used **Builder Design pattern**

- The OrderBuilder can be useful in your code when you need to create Order objects with various optional parameters in a more flexible and structured manner. Here are some scenarios where you might use the OrderBuilder:
  1. **Creating Orders with Different Configurations**: If your application allows for different types of orders or configurations, you can use the OrderBuilder to create orders with specific properties and statuses. 
  2. **Improving Code Readability**: it makes a code becomes more readable and self-explanatory when you use the builder pattern, then it's a valid reason to employ it. It can make the code more understandable, especially when dealing with complex object initialization

- To create an Order instance, you can use the (OrderBuilder class).

#### Order Status

- I have used **Factory Method Design pattern** to encapsulate object creation and make it more flexible.
- It allows me to create objects without specifying the exact class of object that will be created,
 which can be helpful for achieving loose coupling and better code maintainability.

>  A factory class (OrderStatusHandlerFactory in this case) is responsible for creating objects (handlers)
 based on certain conditions or input parameters.
> The factory method (createHandler in this case) is used to create instances of different classes 
 (implementations of OrderStatusHandlerInterface in this case) depending on the provided input ($status in this case).

#### ReceiptFormatter

- I have used **Strategy Design Pattern** because it's allow to select an appropriate algorithm (formatter) 
 and use it without needing to know the details of how the formatting is done. 
- This promotes flexibility and allows me to easily switch between different formatting strategies without changing the client code.

> Each Implementation define a family of algorithms in this case, (various methods for formatting receipts) 
and encapsulate each one of them within a separate class that implements a common interface (ReceiptFormatter in this case).
> Each implementation of the (ReceiptFormatter interface) represents a different strategy for formatting order receipts,
such as formatting them as XML or JSON. 


### Shipping

Shipping Strategy

- I have implemented a "Shipping TaxCalculator Class" for calculating shipping taxes based on the shipping company and destination country.
- This logic for encapsulating the varying tax calculation algorithms and selecting the appropriate one at runtime.

> It loads the tax rates from a configuration file and provides a method, calculateTaxRate, to calculate the tax rate based on the shipping company and country.

Shipping

- The Shipping class represents a shipping method with a name, cost, and tax.
- It uses the Shipping TaxCalculator to calculate the tax based on the shipping company and the user's country.
- Shipping TaxCalculator based on config file which contains the tax rates for each country based on the shipping company.


### Products

#### calculatePrice Method
- The calculatePrice method calculates the final price of the product based on its attributes. It uses the match expression to apply price adjustments based on specific attributes like size and color. This approach allows for easy extension if more attributes need to be considered in the future.

#### Price Adjustment Methods
- There are two private methods, updatePriceBasedOnSize and updatePriceBasedOnColor, responsible for adjusting the price based on size and color attributes, respectively. These methods encapsulate the logic for modifying the product price.

### Testing

> You can use PHPUnit to run tests for various components, including order status handling, receipt formatting, and shipping tax calculation.

### Docker

I have implemented Docker for this project.

Its Main advantages are:
- Portability: Docker containers encapsulate an application and its dependencies into a single, portable unit. This means you can run the same container on any platform that supports Docker, ensuring consistent behavior across different environments, from development to production.
- Isolation: Containers provide process and file system isolation. Each container runs in its own isolated environment, separate from the host system and other containers. This isolation ensures that applications and their dependencies do not interfere with one another.

### Usage

For more information about commands : commands.txt file