## Inventory API

This repository contains the source code for an Inventory API. The API allows users to manage inventory items, such as adding new items, updating existing items and retrieving item details.

## Features

The Inventory API offers the following features:

- **Create Item:** Users can add new items to the inventory by providing the necessary details, including the item name, description, quantity, and price.
- **Update Item:** Existing items in the inventory can be updated by specifying the item ID and providing the updated details. Users can modify the item quantity or price.
- **Retrieve Item:** Users can retrieve the details of a specific item by providing its ID. The API returns the item's name, description, quantity, and price. Users can get all product item in list API.
- **Search Item:** Items can be searched from the inventory by specifying product name. From purchase list API users can get item by searching supplier name.



## Installation

To set up the Inventory API on your local machine, follow these steps:

- Clone the repository using the following command:

```
git clone https://github.com/saanchita-paul/inventory_api.git
```

- Navigate to the cloned directory:

```
cd inventory_api
```
- Install dependencies:

```
composer install
```

- Copy the .env.example file to .env:

```
cp .env.example .env
```
- Generate an application key:

```
php artisan key:generate
```

- Configure the database in the .env file:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```
- Migrate the database:

```markdown
php artisan migrate
```

- Run the following command to seed the database:

```
php artisan db:seed
```

- Start the development server:

```
php artisan serve
```

- Visit [localhost](http://localhost:8000) in your web browser to use the application.


## API Documentation

**Authorization**

To ensure the security and authorization of API requests, all endpoints, except for the login and registration endpoints, require the use of a Bearer token. The Bearer token serves as a form of authentication.

Upon successful login, the Bearer token can be obtained from the login response. This token should be included in the Authorization header of subsequent API requests.

Alternatively, you have the option to include the Bearer token directly in the inventory collection. By doing so, there is no need to add the Authorization header for each API request.

It is essential to include the Bearer token correctly to access the protected endpoints and perform authorized operations.

Please ensure the Bearer token is provided in the appropriate manner to authenticate your API requests effectively and securely.

```http
POST /api/auth/login
```

| Key | Value |
| :--- | :--- | 
| Authorization | Bearer 16|Mpa45CgTqXyZmc0Aix0BZPvfcCftqzDT3pFChJiM |

The API endpoints and their usage are documented below:

<details>
  <summary>Registration</summary>
    
  - Endpoint:
    
    ```http
    POST /api/auth/register
    
    ```
    
  - Description:
      ```
      This API endpoint allows users to register and create an account.
      ```
    
 </details>
 
 <details>
  <summary>Login</summary>
    
  - Endpoint:
    
    ```http
    POST /api/auth/login
    
    ```
    
  - Description:
      ```
      This API endpoint enables users to log in and obtain a Bearer token for authentication.
      ```
    
 </details>
 
 
 <details>
  <summary>Get User</summary>
    
  - Endpoint:
    
    ```http
    GET api/user
    
    ```
    
  - Description:
      ```
      This API endpoint retrieves information about all authenticated users.
      ```
    
 </details>
 
 
 <details>
  <summary>Add Product</summary>
    
  - Endpoint:
    
    ```http
    POST api/product/create
    
    ```
    
  - Description:
      ```
      This API endpoint allows the addition of a new product to the database. With each product one stock will be added and by default stock quantity is zero
      ```
    
 </details>


 <details>
  <summary>Product List</summary>
    
  - Endpoint:
    
    ```http
    GET /api/product/list?per_page={per_page}&search={search}
    
    ```
    
  - Description:
      ```
      This API endpoint allows the user to retrieve a list of all products from the database. The user can apply filters to the results by adding query parameters to the endpoint. The per_page parameter specifies the number of products to be returned per page, and the search parameter allows the user to search for products by their name.
      ```
    
 </details>


  <details>
  <summary>Product Details</summary>
    
  - Endpoint:
    
    ```http
    GET /api/product/view/{id}
    
    ```
    
  - Description:
      ```
      This API endpoint allows the user to retrieve the details of a specific product based on its ID.
      ```
    
 </details>


  <details>
  <summary>Category List</summary>
    
  - Endpoint:
    
    ```http
    GET api/product/categories
    
    ```
    
  - Description:
      ```
      This API endpoint allows the user to retrieve a list of all categories of products available.
      ```
    
 </details>
 
 
 
 <details>
  <summary>Add Purchase</summary>
    
  - Endpoint:
    
    ```http
    POST api/purchase/create
    
    ```
    
  - Description:
      ```
      This API endpoint allows the user to add a purchase record, updating the stock quantity and price of multiple products.
      ```
    
 </details>



<details>
  <summary>Purchase List</summary>
    
  - Endpoint:
    
    ```http
    POST /api/purchase/list?per_page={per_page}&search={search}
    
    ```
    
  - Description:
      ```
     This API endpoint allows the user to retrieve a list of all purchases from the database. The user can apply filters to the results by adding query parameters to the       endpoint. The per_page parameter specifies the number of purchases to be returned per page, and the search parameter allows the user to search for purchases by the         supplier name.
      ```
    
 </details>
 
  
  <details>
  <summary>Logout</summary>
    
    - Endpoint: 
    
    ```http
    POST /api/auth/logout
    ```
    
   - Description:
      ```
        This API endpoint allows the user to log out from the application. When invoked, the access token associated with the user will be invalidated and removed.
      ```
  </details>
 
  
  
  
  [Check Postman API Documentation](https://documenter.getpostman.com/view/15919922/2s93ebSqft)
  


