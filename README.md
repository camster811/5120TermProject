# Bookstore Database System

This project implements a database system for a hypothetical online bookstore. The system maintains information about books, subjects, suppliers, and shipping carriers. It also keeps track of orders, customers, and employees.

## Features

- MySQL database with tables for books, subjects, suppliers, shippers, customers, employees, orders, and order details
- PHP/HTML web interface for querying the database
- Support for various SQL operations (SELECT, INSERT, UPDATE, DELETE, CREATE, etc.)
- Protection against DROP statements
- Sample queries for common operations

## Setup Instructions

### Prerequisites

- MySQL Server
- PHP (with mysqli extension)
- Web server (Apache, Nginx, etc.)

### Database Setup

1. **Create the database and tables**:
   - Open a MySQL client (e.g., MySQL Workbench, phpMyAdmin, or command line)
   - Run the SQL script in `create_database.sql` to create the database and tables

   ```bash
   mysql -u username -p < create_database.sql
   ```

2. **Import the data**:
   - Place the project files in your web server's document root
   - Access the import script through your web browser:
   ```
   http://localhost/bookstore/import_data.php
   ```
   - This will import data from the CSV files into the database

### Web Interface Setup

1. **Configure database connection**:
   - Open `index.php` and `import_data.php` in a text editor
   - Update the database connection parameters if needed:
   ```php
   $servername = "localhost";
   $username = "root";  // Change to your MySQL username
   $password = "";      // Change to your MySQL password
   $dbname = "bookstore";
   ```

2. **Access the web interface**:
   - Open your web browser and navigate to:
   ```
   http://localhost/bookstore/index.php
   ```

## Using the Web Interface

1. **Execute SQL queries**:
   - Enter your SQL query in the text area
   - Click "Execute Query" to run the query
   - Results will be displayed below the form

2. **View sample queries**:
   - Click "view sample queries" to see examples of queries
   - Click "Run Query" next to any sample query to execute it

3. **Interface features**:
   - The interface displays query results in a table format
   - For SELECT queries, it shows the number of rows retrieved
   - For INSERT, UPDATE, DELETE, and CREATE operations, it shows success messages
   - Error messages are displayed for invalid queries
   - DROP statements are not allowed

## Sample Queries

The system includes 19 sample queries that demonstrate various operations:

1. Show the subject names of books supplied by a specific supplier
2. Find the most expensive book from a supplier
3. List books ordered by a specific customer
4. Show books with more than a certain quantity in stock
5. Calculate total price paid by a customer
6. Find customers who have paid less than a certain amount
7. List books from a specific supplier
8. Show total price paid by each customer
9. Find books shipped on a specific date
10. Show books ordered by multiple customers
11. List books handled by a specific employee
12. Show ordered books and their quantities
13. Find customers who ordered at least a certain number of books
14. List customers who ordered books in specific categories
15. Find customers who ordered books by a specific author
16. Calculate total sales by employee
17. Show open orders at a specific date
18. List customers who ordered multiple books
19. Find customers who ordered more than a certain number of books

## File Structure

- `create_database.sql`: SQL script to create the database and tables
- `import_data.php`: PHP script to import data from CSV files
- `index.php`: Main web interface for executing queries
- `sample_queries.php`: Page with sample queries
- `README.md`: This documentation file

## Notes

- The database uses InnoDB engine to support foreign key constraints
- The web interface prevents DROP statements for security
- All SQL operations are sanitized to prevent SQL injection
