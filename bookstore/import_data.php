<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookstore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to import CSV data
function importCSV($conn, $tableName, $csvFile) {
    echo "Importing data into $tableName from $csvFile...<br>";
    
    // Open the CSV file
    if (($handle = fopen($csvFile, "r")) !== FALSE) {
        // Read the header row
        $header = fgetcsv($handle, 1000, ",");
        
        // Prepare columns for SQL
        $columns = implode(", ", $header);
        
        // Read data rows
        $rowCount = 0;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Prepare values for SQL
            $values = array();
            foreach ($data as $value) {
                if ($value === "NULL") {
                    $values[] = "NULL";
                } else {
                    $values[] = "'" . $conn->real_escape_string($value) . "'";
                }
            }
            $valueString = implode(", ", $values);
            
            // Create SQL query
            $sql = "INSERT INTO $tableName ($columns) VALUES ($valueString)";
            
            // Execute query
            if ($conn->query($sql) === TRUE) {
                $rowCount++;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
            }
        }
        fclose($handle);
        echo "Imported $rowCount rows into $tableName.<br><br>";
    } else {
        echo "Could not open file: $csvFile<br>";
    }
}

// Import data from CSV files
// Import in order to respect foreign key constraints
importCSV($conn, "Subject", "../5120TermProject/data/db_subject.csv");
importCSV($conn, "Supplier", "../5120TermProject/data/db_supplier.csv");
importCSV($conn, "Book", "../5120TermProject/data/db_book.csv");
importCSV($conn, "Shipper", "../5120TermProject/data/db_shipper.csv");
importCSV($conn, "Customer", "../5120TermProject/data/db_customer.csv");
importCSV($conn, "Employee", "../5120TermProject/data/db_employee.csv");
importCSV($conn, "Order", "../5120TermProject/data/db_order.csv");
importCSV($conn, "OrderDetail", "../5120TermProject/data/db_order_detail.csv");

echo "Data import completed!";

// Close connection
$conn->close();
?>
