<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore Sample Queries</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        h1, h2 {
            color: #333;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .query {
            margin-bottom: 30px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
        }
        .query-text {
            background-color: #f5f5f5;
            padding: 10px;
            border-radius: 4px;
            font-family: monospace;
            white-space: pre-wrap;
            margin-top: 10px;
        }
        .btn {
            display: inline-block;
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bookstore Sample Queries</h1>
        <p>Below are sample SQL queries for the bookstore database. Click "Run Query" to execute any query in the main interface.</p>
        
        <div class="query">
            <h2>1. Show the subject names of books supplied by supplier2</h2>
            <div class="query-text">SELECT DISTINCT s.CategoryName
FROM Subject s
JOIN Book b ON s.SubjectID = b.SubjectID
JOIN Supplier sup ON b.SupplierID = sup.SupplierID
WHERE sup.CompanyName = 'supplier2';</div>
            <a href="index.php?query=<?php echo urlencode("SELECT DISTINCT s.CategoryName
FROM Subject s
JOIN Book b ON s.SubjectID = b.SubjectID
JOIN Supplier sup ON b.SupplierID = sup.SupplierID
WHERE sup.CompanyName = 'supplier2';"); ?>" class="btn">Run Query</a>
        </div>
        
        <div class="query">
            <h2>2. Show the name and price of the most expensive book supplied by supplier3</h2>
            <div class="query-text">SELECT b.Title, b.UnitPrice
FROM Book b
JOIN Supplier s ON b.SupplierID = s.SupplierID
WHERE s.CompanyName = 'supplier3'
ORDER BY b.UnitPrice DESC
LIMIT 1;</div>
            <a href="index.php?query=<?php echo urlencode("SELECT b.Title, b.UnitPrice
FROM Book b
JOIN Supplier s ON b.SupplierID = s.SupplierID
WHERE s.CompanyName = 'supplier3'
ORDER BY b.UnitPrice DESC
LIMIT 1;"); ?>" class="btn">Run Query</a>
        </div>
        
        <div class="query">
            <h2>3. Show the unique names of all books ordered by lastname1 firstname1</h2>
            <div class="query-text">SELECT DISTINCT b.Title
FROM Book b
JOIN OrderDetail od ON b.BookID = od.BookID
JOIN `Order` o ON od.OrderID = o.OrderID
JOIN Customer c ON o.CustomerID = c.CustomerID
WHERE c.LastName = 'lastname1' AND c.FirstName = 'firstname1';</div>
            <a href="index.php?query=<?php echo urlencode("SELECT DISTINCT b.Title
FROM Book b
JOIN OrderDetail od ON b.BookID = od.BookID
JOIN `Order` o ON od.OrderID = o.OrderID
JOIN Customer c ON o.CustomerID = c.CustomerID
WHERE c.LastName = 'lastname1' AND c.FirstName = 'firstname1';"); ?>" class="btn">Run Query</a>
        </div>
        
        <div class="query">
            <h2>4. Show the title of books which have more than 10 units in stock</h2>
            <div class="query-text">SELECT Title
FROM Book
WHERE Quantity > 10;</div>
            <a href="index.php?query=<?php echo urlencode("SELECT Title
FROM Book
WHERE Quantity > 10;"); ?>" class="btn">Run Query</a>
        </div>
        
        <div class="query">
            <h2>5. Show the total price lastname1 firstname1 has paid for the books</h2>
            <div class="query-text">SELECT SUM(b.UnitPrice * od.Quantity) AS TotalPrice
FROM Book b
JOIN OrderDetail od ON b.BookID = od.BookID
JOIN `Order` o ON od.OrderID = o.OrderID
JOIN Customer c ON o.CustomerID = c.CustomerID
WHERE c.LastName = 'lastname1' AND c.FirstName = 'firstname1';</div>
            <a href="index.php?query=<?php echo urlencode("SELECT SUM(b.UnitPrice * od.Quantity) AS TotalPrice
FROM Book b
JOIN OrderDetail od ON b.BookID = od.BookID
JOIN `Order` o ON od.OrderID = o.OrderID
JOIN Customer c ON o.CustomerID = c.CustomerID
WHERE c.LastName = 'lastname1' AND c.FirstName = 'firstname1';"); ?>" class="btn">Run Query</a>
        </div>
        
        <div class="query">
            <h2>6. Show the names of the customers who have paid less than $80 in totals</h2>
            <div class="query-text">SELECT c.FirstName, c.LastName
FROM Customer c
JOIN `Order` o ON c.CustomerID = o.CustomerID
JOIN OrderDetail od ON o.OrderID = od.OrderID
JOIN Book b ON od.BookID = b.BookID
GROUP BY c.CustomerID
HAVING SUM(b.UnitPrice * od.Quantity) < 80;</div>
            <a href="index.php?query=<?php echo urlencode("SELECT c.FirstName, c.LastName
FROM Customer c
JOIN `Order` o ON c.CustomerID = o.CustomerID
JOIN OrderDetail od ON o.OrderID = od.OrderID
JOIN Book b ON od.BookID = b.BookID
GROUP BY c.CustomerID
HAVING SUM(b.UnitPrice * od.Quantity) < 80;"); ?>" class="btn">Run Query</a>
        </div>
        
        <div class="query">
            <h2>7. Show the name of books supplied by supplier2</h2>
            <div class="query-text">SELECT b.Title
FROM Book b
JOIN Supplier s ON b.SupplierID = s.SupplierID
WHERE s.CompanyName = 'supplier2';</div>
            <a href="index.php?query=<?php echo urlencode("SELECT b.Title
FROM Book b
JOIN Supplier s ON b.SupplierID = s.SupplierID
WHERE s.CompanyName = 'supplier2';"); ?>" class="btn">Run Query</a>
        </div>
        
        <div class="query">
            <h2>8. Show the total price each customer paid and their names. List the result in descending price</h2>
            <div class="query-text">SELECT c.FirstName, c.LastName, SUM(b.UnitPrice * od.Quantity) AS TotalPrice
FROM Customer c
JOIN `Order` o ON c.CustomerID = o.CustomerID
JOIN OrderDetail od ON o.OrderID = od.OrderID
JOIN Book b ON od.BookID = b.BookID
GROUP BY c.CustomerID
ORDER BY TotalPrice DESC;</div>
            <a href="index.php?query=<?php echo urlencode("SELECT c.FirstName, c.LastName, SUM(b.UnitPrice * od.Quantity) AS TotalPrice
FROM Customer c
JOIN `Order` o ON c.CustomerID = o.CustomerID
JOIN OrderDetail od ON o.OrderID = od.OrderID
JOIN Book b ON od.BookID = b.BookID
GROUP BY c.CustomerID
ORDER BY TotalPrice DESC;"); ?>" class="btn">Run Query</a>
        </div>
        
        <div class="query">
            <h2>9. Show the names of all the books shipped on 08/04/2016 and their shippers' names</h2>
            <div class="query-text">SELECT b.Title, s.ShipperName
FROM Book b
JOIN OrderDetail od ON b.BookID = od.BookID
JOIN `Order` o ON od.OrderID = o.OrderID
JOIN Shipper s ON o.ShipperID = s.ShipperID
WHERE o.ShippedDate = '2016-08-04';</div>
            <a href="index.php?query=<?php echo urlencode("SELECT b.Title, s.ShipperName
FROM Book b
JOIN OrderDetail od ON b.BookID = od.BookID
JOIN `Order` o ON od.OrderID = o.OrderID
JOIN Shipper s ON o.ShipperID = s.ShipperID
WHERE o.ShippedDate = '2016-08-04';"); ?>" class="btn">Run Query</a>
        </div>
        
        <div class="query">
            <h2>10. Show the unique names of all the books lastname1 firstname1 and lastname4 firstname4 both ordered</h2>
            <div class="query-text">SELECT b.Title
FROM Book b
JOIN OrderDetail od ON b.BookID = od.BookID
JOIN `Order` o ON od.OrderID = o.OrderID
JOIN Customer c ON o.CustomerID = c.CustomerID
WHERE (c.LastName = 'lastname1' AND c.FirstName = 'firstname1')
AND b.BookID IN (
    SELECT b2.BookID
    FROM Book b2
    JOIN OrderDetail od2 ON b2.BookID = od2.BookID
    JOIN `Order` o2 ON od2.OrderID = o2.OrderID
    JOIN Customer c2 ON o2.CustomerID = c2.CustomerID
    WHERE c2.LastName = 'lastname4' AND c2.FirstName = 'firstname4'
);</div>
            <a href="index.php?query=<?php echo urlencode("SELECT b.Title
FROM Book b
JOIN OrderDetail od ON b.BookID = od.BookID
JOIN `Order` o ON od.OrderID = o.OrderID
JOIN Customer c ON o.CustomerID = c.CustomerID
WHERE (c.LastName = 'lastname1' AND c.FirstName = 'firstname1')
AND b.BookID IN (
    SELECT b2.BookID
    FROM Book b2
    JOIN OrderDetail od2 ON b2.BookID = od2.BookID
    JOIN `Order` o2 ON od2.OrderID = o2.OrderID
    JOIN Customer c2 ON o2.CustomerID = c2.CustomerID
    WHERE c2.LastName = 'lastname4' AND c2.FirstName = 'firstname4'
);"); ?>" class="btn">Run Query</a>
        </div>
        
        <div class="query">
            <h2>11. Show the names of all the books lastname6 firstname6 was responsible for</h2>
            <div class="query-text">SELECT DISTINCT b.Title
FROM Book b
JOIN OrderDetail od ON b.BookID = od.BookID
JOIN `Order` o ON od.OrderID = o.OrderID
JOIN Employee e ON o.EmployeeID = e.EmployeeID
WHERE e.LastName = 'lastname6' AND e.FirstName = 'firstname6';</div>
            <a href="index.php?query=<?php echo urlencode("SELECT DISTINCT b.Title
FROM Book b
JOIN OrderDetail od ON b.BookID = od.BookID
JOIN `Order` o ON od.OrderID = o.OrderID
JOIN Employee e ON o.EmployeeID = e.EmployeeID
WHERE e.LastName = 'lastname6' AND e.FirstName = 'firstname6';"); ?>" class="btn">Run Query</a>
        </div>
        
        <div class="query">
            <h2>12. Show the names of all the ordered books and their total quantities. List the result in ascending quantity</h2>
            <div class="query-text">SELECT b.Title, SUM(od.Quantity) AS TotalQuantity
FROM Book b
JOIN OrderDetail od ON b.BookID = od.BookID
GROUP BY b.BookID
ORDER BY TotalQuantity ASC;</div>
            <a href="index.php?query=<?php echo urlencode("SELECT b.Title, SUM(od.Quantity) AS TotalQuantity
FROM Book b
JOIN OrderDetail od ON b.BookID = od.BookID
GROUP BY b.BookID
ORDER BY TotalQuantity ASC;"); ?>" class="btn">Run Query</a>
        </div>
        
        <div class="query">
            <h2>13. Show the names of the customers who ordered at least 2 books</h2>
            <div class="query-text">SELECT c.FirstName, c.LastName
FROM Customer c
JOIN `Order` o ON c.CustomerID = o.CustomerID
JOIN OrderDetail od ON o.OrderID = od.OrderID
GROUP BY c.CustomerID
HAVING SUM(od.Quantity) >= 2;</div>
            <a href="index.php?query=<?php echo urlencode("SELECT c.FirstName, c.LastName
FROM Customer c
JOIN `Order` o ON c.CustomerID = o.CustomerID
JOIN OrderDetail od ON o.OrderID = od.OrderID
GROUP BY c.CustomerID
HAVING SUM(od.Quantity) >= 2;"); ?>" class="btn">Run Query</a>
        </div>
        
        <div class="query">
            <h2>14. Show the name of the customers who have ordered at least a book in category3 or category4 and the book names</h2>
            <div class="query-text">SELECT c.FirstName, c.LastName, b.Title
FROM Customer c
JOIN `Order` o ON c.CustomerID = o.CustomerID
JOIN OrderDetail od ON o.OrderID = od.OrderID
JOIN Book b ON od.BookID = b.BookID
JOIN Subject s ON b.SubjectID = s.SubjectID
WHERE s.CategoryName IN ('category3', 'category4');</div>
            <a href="index.php?query=<?php echo urlencode("SELECT c.FirstName, c.LastName, b.Title
FROM Customer c
JOIN `Order` o ON c.CustomerID = o.CustomerID
JOIN OrderDetail od ON o.OrderID = od.OrderID
JOIN Book b ON od.BookID = b.BookID
JOIN Subject s ON b.SubjectID = s.SubjectID
WHERE s.CategoryName IN ('category3', 'category4');"); ?>" class="btn">Run Query</a>
        </div>
        
        <div class="query">
            <h2>15. Show the name of the customer who has ordered at least one book written by author1</h2>
            <div class="query-text">SELECT DISTINCT c.FirstName, c.LastName
FROM Customer c
JOIN `Order` o ON c.CustomerID = o.CustomerID
JOIN OrderDetail od ON o.OrderID = od.OrderID
JOIN Book b ON od.BookID = b.BookID
WHERE b.Author = 'author1';</div>
            <a href="index.php?query=<?php echo urlencode("SELECT DISTINCT c.FirstName, c.LastName
FROM Customer c
JOIN `Order` o ON c.CustomerID = o.CustomerID
JOIN OrderDetail od ON o.OrderID = od.OrderID
JOIN Book b ON od.BookID = b.BookID
WHERE b.Author = 'author1';"); ?>" class="btn">Run Query</a>
        </div>
        
        <div class="query">
            <h2>16. Show the name and total sale (price of orders) of each employee</h2>
            <div class="query-text">SELECT e.FirstName, e.LastName, SUM(b.UnitPrice * od.Quantity) AS TotalSale
FROM Employee e
JOIN `Order` o ON e.EmployeeID = o.EmployeeID
JOIN OrderDetail od ON o.OrderID = od.OrderID
JOIN Book b ON od.BookID = b.BookID
GROUP BY e.EmployeeID;</div>
            <a href="index.php?query=<?php echo urlencode("SELECT e.FirstName, e.LastName, SUM(b.UnitPrice * od.Quantity) AS TotalSale
FROM Employee e
JOIN `Order` o ON e.EmployeeID = o.EmployeeID
JOIN OrderDetail od ON o.OrderID = od.OrderID
JOIN Book b ON od.BookID = b.BookID
GROUP BY e.EmployeeID;"); ?>" class="btn">Run Query</a>
        </div>
        
        <div class="query">
            <h2>17. Show the book names and their respective quantities for open orders (the orders which have not been shipped) at midnight 08/04/2016</h2>
            <div class="query-text">SELECT b.Title, od.Quantity
FROM Book b
JOIN OrderDetail od ON b.BookID = od.BookID
JOIN `Order` o ON od.OrderID = o.OrderID
WHERE (o.ShippedDate IS NULL OR o.ShippedDate > '2016-08-04')
AND o.OrderDate <= '2016-08-04';</div>
            <a href="index.php?query=<?php echo urlencode("SELECT b.Title, od.Quantity
FROM Book b
JOIN OrderDetail od ON b.BookID = od.BookID
JOIN `Order` o ON od.OrderID = o.OrderID
WHERE (o.ShippedDate IS NULL OR o.ShippedDate > '2016-08-04')
AND o.OrderDate <= '2016-08-04';"); ?>" class="btn">Run Query</a>
        </div>
        
        <div class="query">
            <h2>18. Show the names of customers who have ordered more than 1 book and the corresponding quantities. List the result in the descending quantity</h2>
            <div class="query-text">SELECT c.FirstName, c.LastName, SUM(od.Quantity) AS TotalQuantity
FROM Customer c
JOIN `Order` o ON c.CustomerID = o.CustomerID
JOIN OrderDetail od ON o.OrderID = od.OrderID
GROUP BY c.CustomerID
HAVING TotalQuantity > 1
ORDER BY TotalQuantity DESC;</div>
            <a href="index.php?query=<?php echo urlencode("SELECT c.FirstName, c.LastName, SUM(od.Quantity) AS TotalQuantity
FROM Customer c
JOIN `Order` o ON c.CustomerID = o.CustomerID
JOIN OrderDetail od ON o.OrderID = od.OrderID
GROUP BY c.CustomerID
HAVING TotalQuantity > 1
ORDER BY TotalQuantity DESC;"); ?>" class="btn">Run Query</a>
        </div>
        
        <div class="query">
            <h2>19. Show the names of customers who have ordered more than 3 books and their respective telephone numbers</h2>
            <div class="query-text">SELECT c.FirstName, c.LastName, c.Phone
FROM Customer c
JOIN `Order` o ON c.CustomerID = o.CustomerID
JOIN OrderDetail od ON o.OrderID = od.OrderID
GROUP BY c.CustomerID
HAVING SUM(od.Quantity) > 3;</div>
            <a href="index.php?query=<?php echo urlencode("SELECT c.FirstName, c.LastName, c.Phone
FROM Customer c
JOIN `Order` o ON c.CustomerID = o.CustomerID
JOIN OrderDetail od ON o.OrderID = od.OrderID
GROUP BY c.CustomerID
HAVING SUM(od.Quantity) > 3;"); ?>" class="btn">Run Query</a>
        </div>
        
        <p><a href="index.php" style="color: #4CAF50;">Back to Query Interface</a></p>
    </div>
</body>
</html>
