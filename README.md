## Inventory API

This repository contains the source code for an Inventory API. The API allows users to manage inventory items, such as adding new items, updating existing items, retrieving item details, and deleting items.

## Features

The Inventory API offers the following features:

- **Create Item:** Users can add new items to the inventory by providing the necessary details, including the item name, description, quantity, and price.
- **Update Item:** Existing items in the inventory can be updated by specifying the item ID and providing the updated details. Users can modify the item name, description, quantity, or price.
- **Retrieve Item:** Users can retrieve the details of a specific item by providing its ID. The API returns the item's name, description, quantity, and price.
- **Delete Item:** Items can be deleted from the inventory by specifying their ID. Once deleted, the item will no longer be accessible through the API.



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

```
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

- Visit http://localhost:8000 in your web browser to use the application.


## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
