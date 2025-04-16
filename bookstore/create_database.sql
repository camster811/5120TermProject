-- Create the bookstore database
CREATE DATABASE IF NOT EXISTS bookstore;
USE bookstore;

-- Create the Subject table
CREATE TABLE IF NOT EXISTS Subject (
    SubjectID INT PRIMARY KEY,
    CategoryName VARCHAR(100) NOT NULL
);

-- Create the Supplier table
CREATE TABLE IF NOT EXISTS Supplier (
    SupplierID INT PRIMARY KEY,
    CompanyName VARCHAR(100) NOT NULL,
    ContactLastName VARCHAR(50),
    ContactFirstName VARCHAR(50),
    Phone VARCHAR(20)
);

-- Create the Book table
CREATE TABLE IF NOT EXISTS Book (
    BookID INT PRIMARY KEY,
    Title VARCHAR(255) NOT NULL,
    UnitPrice DECIMAL(10, 2) NOT NULL,
    Author VARCHAR(100) NOT NULL,
    Quantity INT NOT NULL,
    SupplierID INT,
    SubjectID INT,
    FOREIGN KEY (SupplierID) REFERENCES Supplier(SupplierID),
    FOREIGN KEY (SubjectID) REFERENCES Subject(SubjectID)
);

-- Create the Shipper table
CREATE TABLE IF NOT EXISTS Shipper (
    ShipperID INT PRIMARY KEY,
    ShipperName VARCHAR(100) NOT NULL
);

-- Create the Customer table
CREATE TABLE IF NOT EXISTS Customer (
    CustomerID INT PRIMARY KEY,
    LastName VARCHAR(50) NOT NULL,
    FirstName VARCHAR(50) NOT NULL,
    Phone VARCHAR(20)
);

-- Create the Employee table
CREATE TABLE IF NOT EXISTS Employee (
    EmployeeID INT PRIMARY KEY,
    LastName VARCHAR(50) NOT NULL,
    FirstName VARCHAR(50) NOT NULL
);

-- Create the Order table
CREATE TABLE IF NOT EXISTS `Order` (
    OrderID INT PRIMARY KEY,
    CustomerID INT,
    EmployeeID INT,
    OrderDate DATE,
    ShippedDate DATE,
    ShipperID INT,
    FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID),
    FOREIGN KEY (EmployeeID) REFERENCES Employee(EmployeeID),
    FOREIGN KEY (ShipperID) REFERENCES Shipper(ShipperID)
);

-- Create the OrderDetail table
CREATE TABLE IF NOT EXISTS OrderDetail (
    BookID INT,
    OrderID INT,
    Quantity INT NOT NULL,
    PRIMARY KEY (BookID, OrderID),
    FOREIGN KEY (BookID) REFERENCES Book(BookID),
    FOREIGN KEY (OrderID) REFERENCES `Order`(OrderID)
);
