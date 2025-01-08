
# SQL Commands and Examples

## 1. `SELECT`
Retrieve specific columns from a table:
```sql
SELECT CustomerName, City FROM Customers;
```

## 2. `FROM`
Specifies the table to retrieve data from:
```sql
SELECT DISTINCT Country FROM Customers;
```

## 3. `WHERE`
Filters records based on a condition:
```sql
SELECT * FROM Customers WHERE Country='Mexico';
```

## 4. `ORDER BY`
Sorts the result set by one or more columns:
```sql
SELECT * FROM Products ORDER BY Price;
```

## 5. `AND`
Combines multiple conditions:
```sql
SELECT * FROM Customers WHERE Country = 'Spain' AND CustomerName LIKE 'G%';
```

## 6. `OR`
Filters based on multiple conditions (either of them must be true):
```sql
SELECT * FROM Customers WHERE Country = 'Germany' OR Country = 'Spain';
```

## 7. `NOT`
Excludes certain records:
```sql
SELECT * FROM Customers WHERE NOT Country = 'Spain';
```

## 8. `INSERT INTO`
Inserts new data into a table:
```sql
INSERT INTO Customers (CustomerName, ContactName, Address, City, PostalCode, Country)
VALUES ('Cardinal', 'Tom B. Erichsen', 'Skagen 21', 'Stavanger', '4006', 'Norway');
```

## 9. `NULL` value
Checks for `NULL` values:
```sql
SELECT CustomerName, ContactName, Address FROM Customers WHERE Address IS NULL;
```

## 10. `UPDATE`
Modifies existing records:
```sql
UPDATE Customers SET ContactName = 'Alfred Schmidt', City = 'Frankfurt' WHERE CustomerID = 1;
```

## 11. `DELETE`
Deletes records:
```sql
DELETE FROM Customers WHERE CustomerName='Alfreds Futterkiste';
```

## 12. SQL Aggregate Functions

### `MIN()`
Returns the smallest value in a column:
```sql
SELECT MIN(Price) AS SmallestPrice FROM Products;
```

### `MAX()`
Returns the largest value in a column:
```sql
SELECT MAX(Price) AS LargestPrice FROM Products;
```

### `COUNT()`
Counts the number of rows in a column:
```sql
SELECT COUNT(*) FROM Products;
```

### `SUM()`
Returns the total sum of a numerical column:
```sql
SELECT SUM(Quantity) FROM Order_Details;
```

### `AVG()`
Returns the average of a numerical column:
```sql
SELECT AVG(Price) FROM Products;
```

## 13. `LIKE`
Searches for a specified pattern:
```sql
SELECT * FROM Customers WHERE CustomerName LIKE 'a%';
```

## 14. `IN`
Checks if a value is within a set of values:
```sql
SELECT * FROM Customers WHERE Country IN ('Germany', 'France', 'UK');
```

## 15. `BETWEEN`
Filters records within a range:
```sql
SELECT * FROM Products WHERE Price BETWEEN 10 AND 20;
```

## 16. `AS`
Renames a column or table for better readability:
```sql
SELECT CustomerID AS ID, CustomerName AS Customer FROM Customers;
```

## 17. `INNER JOIN`
Combines rows from two tables where there is a match:
```sql
SELECT ProductID, ProductName, CategoryName
FROM Products
INNER JOIN Categories ON Products.CategoryID = Categories.CategoryID;
```

## 18. `LEFT JOIN`
Includes all records from the left table, and matching records from the right table:
```sql
SELECT Customers.CustomerName, Orders.OrderID
FROM Customers
LEFT JOIN Orders ON Customers.CustomerID = Orders.CustomerID
ORDER BY Customers.CustomerName;
```

## 19. `RIGHT JOIN`
Includes all records from the right table, and matching records from the left table:
```sql
SELECT Orders.OrderID, Employees.LastName, Employees.FirstName
FROM Orders
RIGHT JOIN Employees ON Orders.EmployeeID = Employees.EmployeeID
ORDER BY Orders.OrderID;
```

## 20. `FULL OUTER JOIN`
Returns records when there is a match in either left or right table:
```sql
SELECT Customers.CustomerName, Orders.OrderID
FROM Customers
FULL OUTER JOIN Orders ON Customers.CustomerID = Orders.CustomerID
ORDER BY Customers.CustomerName;
```

## 21. `SELF JOIN`
Joins a table with itself to retrieve related records:
```sql
SELECT A.CustomerName AS CustomerName1, B.CustomerName AS CustomerName2, A.City
FROM Customers A, Customers B
WHERE A.CustomerID <> B.CustomerID AND A.City = B.City
ORDER BY A.City;
```

## 22. `UNION`
Combines results from two or more `SELECT` statements:
```sql
SELECT City FROM Customers
UNION
SELECT City FROM Suppliers
ORDER BY City;
```

## 23. `GROUP BY`
Groups rows that have the same values in specified columns:
```sql
SELECT COUNT(CustomerID), Country
FROM Customers
GROUP BY Country
ORDER BY COUNT(CustomerID) DESC;
```

## 24. `HAVING`
Filters records after grouping:
```sql
SELECT COUNT(CustomerID), Country
FROM Customers
GROUP BY Country
HAVING COUNT(CustomerID) > 5;
```

## 25. `EXISTS`
Checks if a subquery returns any results:
```sql
SELECT SupplierName
FROM Suppliers
WHERE EXISTS (SELECT ProductName FROM Products WHERE Products.SupplierID = Suppliers.supplierID AND Price < 20);
```

## 26. `ANY, ALL`
Filters records based on comparison with a set of values:
```sql
SELECT ProductName FROM Products WHERE ProductID = ANY(SELECT ProductID FROM Order_Details WHERE Quantity = 10);
SELECT ProductName FROM Products WHERE ProductID = ALL(SELECT ProductID FROM OrderDetails WHERE Quantity = 10);
```

## 27. `INSERT INTO SELECT`
Inserts data from another table:
```sql
INSERT INTO Customers (CustomerName, City, Country)
SELECT SupplierName, City, Country FROM Suppliers;
```

## 28. `CASE`
Performs conditional logic in a query:
```sql
SELECT OrderID, Quantity,
CASE
    WHEN Quantity > 30 THEN 'The quantity is greater than 30'
    WHEN Quantity = 30 THEN 'The quantity is 30'
    ELSE 'The quantity is under 30'
END AS QuantityText
FROM OrderDetails;
```