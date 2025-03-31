# Product-API
INTEGRATIVE PROGRAMMING (PHP) [Hands-On Exam] 
JOHN PAUL P. MAHILOM
BSIT 2-B

-- OVERVIEW --
Complete the implementation of the Product API by adding the following functionalities:
GetAll() - Retrieve all products with price and productdate from the database.
GetAllLatestProductPrice() - Retrieve all products along with their latest prices and productdate.

Clone the GitHub repository containing the existing code. Set up the database by locating the SQL query file in the config folder. Copy and paste the SQL script into PHPMyAdmin’s SQL tab, then run the script to create the necessary database tables and data.

-- API ENDPOINTS --

http://localhost/product-api/Product
Retrieve all products with their price and product date.

http://localhost/product-api/Product/1
Retrieve product details by ID.

http://localhost/product-api/Product/LatestPrice
Retrieve all products with their latest prices.

-- NOTE --
My Port : 3307 instead of 3306
