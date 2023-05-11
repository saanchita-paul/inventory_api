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

## Authorization

All API requests require the use of a generated API key. You can find your API key, or generate a new one, by navigating to the /settings endpoint, or clicking the “Settings” sidebar item.

To authenticate an API request, you should provide your API key in the `Authorization` header.

Alternatively, you may append the `api_key=[API_KEY]` as a GET parameter to authorize yourself to the API. But note that this is likely to leave traces in things like your history, if accessing the API through a browser.

```http
GET /api/campaigns/?api_key=12345678901234567890123456789012
```

| Key | Value |
| :--- | :--- | 
| Authorization | Bearer 16|Mpa45CgTqXyZmc0Aix0BZPvfcCftqzDT3pFChJiM |

The API endpoints and their usage are documented below:

- Registration
  - Endpoint: POST api/auth/register
  - Request body:
  ```
    {
      "name": "admin@sokrio.com",
      "email": "admin@sokrio.com",
      "password": "12345678"
    }
  ```
  - Response:
  ```
    {
    "status": true,
    "message": "User Created Successfully",
    "token": "22|tYGcMDte4F6AyBfPckOAhMqJULBjJSSfONgKEnz7"
    }
  ```

- Login
  - Endpoint: POST api/auth/login
  - Request body:
  ```
    {
      "email": "admin@sokrio.com",
      "password": "12345678"
    }
  ```
  - Response:
  ```
    {
      {
    "status": true,
    "message": "User Logged In Successfully",
    "user": {
        "id": 1,
        "name": "admin",
        "email": "admin@sokrio.com",
        "email_verified_at": null,
        "created_at": "2023-05-07T10:22:42.000000Z",
        "updated_at": "2023-05-07T10:22:42.000000Z"
    },
    "token": "21|zib5Zy7MKmdA4jLWVH4iCy0wgi33xiRT4tdBhX6N"
    }
      }
    }
  ```
  
  - Get User
  - Endpoint: POST api/user
  - Headers:
  ```
    Authorization:Bearer 16|Mpa45CgTqXyZmc0Aix0BZPvfcCftqzDT3pFChJiM
    Accept:application/json
  ```
  - Response:
  ```
    {
    "id": 1,
    "name": "admin",
    "email": "admin@sokrio.com",
    "email_verified_at": null,
    "created_at": "2023-05-07T10:22:42.000000Z",
    "updated_at": "2023-05-07T10:22:42.000000Z"
    }
  ```
  
  - Add Product
  - Endpoint: POST api/user
  - Headers:
  ```
    Authorization:Bearer 16|Mpa45CgTqXyZmc0Aix0BZPvfcCftqzDT3pFChJiM
    Accept:application/json
  ```
   - Request body:
  ```
    {
    "product_name": "Product1",
    "category_id": 2,
    "description": "Lorem ipsum",
    "price": 200,
    "image": "test.jpg",
    "unit": "gm"
    }
  ```
  - Response:
  ```
    {
    "status": true,
        "product": {
            "product_name": "Product1",
            "category_id": 2,
            "description": "Lorem ipsum",
            "price": 200,
            "image": "test.jpg",
            "updated_at": "2023-05-11T06:27:57.000000Z",
            "created_at": "2023-05-11T06:27:57.000000Z",
            "id": 242
        },
        "stock": {
            "product_id": 242,
            "quantity": 0,
            "unit": "gm",
            "updated_at": "2023-05-11T06:27:57.000000Z",
            "created_at": "2023-05-11T06:27:57.000000Z",
            "id": 24
        }
    }
  ```
  
  - Product List
  - Endpoint: GET api/product/list?per_page=2&search=Product1
  - Headers:
  ```
    Authorization:Bearer 16|Mpa45CgTqXyZmc0Aix0BZPvfcCftqzDT3pFChJiM
    Accept:application/json
  ```
  - Response:
  ```
    {
    "current_page": 1,
    "data": [
        {
            "id": 242,
            "product_name": "Product1",
            "category_id": 2,
            "description": "Lorem ipsum",
            "price": 200,
            "image": "test.jpg",
            "created_at": "2023-05-11T06:27:57.000000Z",
            "updated_at": "2023-05-11T06:27:57.000000Z",
            "category": {
                "id": 2,
                "category_title": "Non.",
                "created_at": "2023-05-08T06:04:27.000000Z",
                "updated_at": "2023-05-08T06:04:27.000000Z"
            },
            "stock": {
                "id": 24,
                "product_id": 242,
                "quantity": 0,
                "unit": "gram",
                "created_at": "2023-05-11T06:27:57.000000Z",
                "updated_at": "2023-05-11T06:27:57.000000Z"
            }
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/product/list?page=1",
    "from": 1,
    "last_page": 7,
    "last_page_url": "http://127.0.0.1:8000/api/product/list?page=7",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/product/list?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": "http://127.0.0.1:8000/api/product/list?page=2",
            "label": "2",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/product/list?page=3",
            "label": "3",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/product/list?page=4",
            "label": "4",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/product/list?page=5",
            "label": "5",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/product/list?page=6",
            "label": "6",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/product/list?page=7",
            "label": "7",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/product/list?page=2",
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": "http://127.0.0.1:8000/api/product/list?page=2",
    "path": "http://127.0.0.1:8000/api/product/list",
    "per_page": "2",
    "prev_page_url": null,
    "to": 2,
    "total": 14
    }
  ```
  
  - Product Details
  - Endpoint: GET api/product/view/1
  - Headers:
  ```
    Authorization:Bearer 16|Mpa45CgTqXyZmc0Aix0BZPvfcCftqzDT3pFChJiM
    Accept:application/json
  ```
  - Response:
  ```
    {
        "id": 1,
        "product_name": "Debitis dolore.",
        "category_id": 6,
        "description": "Debitis recusandae harum maxime dolorum beatae dolorum.",
        "price": 10,
        "image": "https://via.placeholder.com/640x480.png/0077cc?text=ratione",
        "created_at": "2023-05-06T12:50:48.000000Z",
        "updated_at": "2023-05-10T18:36:38.000000Z",
        "category": {
            "id": 6,
            "category_title": "Sit.",
            "created_at": "2023-05-08T06:04:27.000000Z",
            "updated_at": "2023-05-08T06:04:27.000000Z"
        }
    }
  ```
  
   - Category List
  - Endpoint: GET api/product/categories
  - Headers:
  ```
    Authorization:Bearer 16|Mpa45CgTqXyZmc0Aix0BZPvfcCftqzDT3pFChJiM
    Accept:application/json
  ```
  - Response:
  ```
   [
        {
            "id": 1,
            "category_title": "Reiciendis.",
            "created_at": "2023-05-08T06:04:27.000000Z",
            "updated_at": "2023-05-08T06:04:27.000000Z"
        },
        {
            "id": 2,
            "category_title": "Non.",
            "created_at": "2023-05-08T06:04:27.000000Z",
            "updated_at": "2023-05-08T06:04:27.000000Z"
        },
        {
            "id": 3,
            "category_title": "Non.",
            "created_at": "2023-05-08T06:04:27.000000Z",
            "updated_at": "2023-05-08T06:04:27.000000Z"
        },
        {
            "id": 4,
            "category_title": "Nihil.",
            "created_at": "2023-05-08T06:04:27.000000Z",
            "updated_at": "2023-05-08T06:04:27.000000Z"
        },
        {
            "id": 5,
            "category_title": "Amet.",
            "created_at": "2023-05-08T06:04:27.000000Z",
            "updated_at": "2023-05-08T06:04:27.000000Z"
        },
        {
            "id": 6,
            "category_title": "Sit.",
            "created_at": "2023-05-08T06:04:27.000000Z",
            "updated_at": "2023-05-08T06:04:27.000000Z"
        },
        {
            "id": 7,
            "category_title": "Omnis.",
            "created_at": "2023-05-08T06:04:27.000000Z",
            "updated_at": "2023-05-08T06:04:27.000000Z"
        },
        {
            "id": 8,
            "category_title": "Consequatur.",
            "created_at": "2023-05-08T06:04:27.000000Z",
            "updated_at": "2023-05-08T06:04:27.000000Z"
        },
        {
            "id": 9,
            "category_title": "Facilis.",
            "created_at": "2023-05-08T06:04:27.000000Z",
            "updated_at": "2023-05-08T06:04:27.000000Z"
        },
        {
            "id": 10,
            "category_title": "Qui.",
            "created_at": "2023-05-08T06:04:27.000000Z",
            "updated_at": "2023-05-08T06:04:27.000000Z"
        }
    ]
  ```
  
  - Add Purchase
  - Endpoint: POST api/purchase/create
  - Headers:
  ```
    Authorization:Bearer 16|Mpa45CgTqXyZmc0Aix0BZPvfcCftqzDT3pFChJiM
    Accept:application/json
  ```
   - Request body:
  ```
    {
        "date": "2023-12-12",
        "invoice_no": 1234,
        "supplier_name": "supplier1",
        "note": "this is a note",
        "products": [
            {
                "id": 1,
                "quantity": 2,
                "price": 10
            },
            {
                "id": 2,
                "quantity": 3,
                "price": 10
            }
        ]
    }
  ```
  - Response:
  ```
   {
    "status": "success",
    "message": "Purchase created successfully."
    }
  ```
  
  - Purchase List
  - Endpoint: POST api/purchase/list?per_page=1&search=supplier 
  - Headers:
  ```
    Authorization:Bearer 16|Mpa45CgTqXyZmc0Aix0BZPvfcCftqzDT3pFChJiM
    Accept:application/json
  ```
  
  - Response:
  ```
  {
    "current_page": 1,
    "data": [
        {
            "id": 90,
            "supplier_name": "supplier1",
            "date": "2023-12-12",
            "status": null,
            "invoice_no": "1234",
            "note": "this is a note",
            "grant_total": 50,
            "created_at": "2023-05-11T06:44:26.000000Z",
            "updated_at": "2023-05-11T06:44:26.000000Z"
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/purchase/list?page=1",
    "from": 1,
    "last_page": 7,
    "last_page_url": "http://127.0.0.1:8000/api/purchase/list?page=7",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/purchase/list?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": "http://127.0.0.1:8000/api/purchase/list?page=2",
            "label": "2",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/purchase/list?page=3",
            "label": "3",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/purchase/list?page=4",
            "label": "4",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/purchase/list?page=5",
            "label": "5",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/purchase/list?page=6",
            "label": "6",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/purchase/list?page=7",
            "label": "7",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/purchase/list?page=2",
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": "http://127.0.0.1:8000/api/purchase/list?page=2",
    "path": "http://127.0.0.1:8000/api/purchase/list",
    "per_page": "1",
    "prev_page_url": null,
    "to": 1,
    "total": 7
    }
  ```
  <details>
  <summary>Logout</summary>
    
    - Endpoint: 
    
    ```http
    POST /api/auth/logout
    ```
    
    - Headers:
  ```
    Authorization:Bearer 16|Mpa45CgTqXyZmc0Aix0BZPvfcCftqzDT3pFChJiM
    Accept:application/json
  ```
  - Response:
  ```
     {
        "status": true,
        "message": "User Logged Out Successfully",
     }

  ```
  </details>
 
  
  
  
  [Check Postman API Documentation](https://documenter.getpostman.com/view/15919922/2s93ebSqft)
  


