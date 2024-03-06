# Glasses Shop - Live Demo [Here](http://mostafaroshdy.great-site.net/PHPCourse/Lab4/index.php)

Welcome to the Glasses Shop project! This is a simple PHP web application for managing and browsing a collection of glasses products.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Features

- Browse glasses products with details like ID, product name, and more.
- Search for glasses products based on specific criteria.
- Navigate through pages of glasses products using pagination.

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/mostafaroshdy1/glasses-shop.git
   ```

2. Navigate to the project directory:

   ```bash
   cd glasses-shop
   ```

3. Install dependencies using Composer:

   ```bash
   composer install
   ```

4. Set up your database connection by updating the `MainDatabase` class in `vendor/autoload.php` with your database credentials.

5. Import the SQL schema located in `database/schema.sql` into your MySQL database.

6. Start your PHP server:

   ```bash
   php -S localhost:8000
   ```

## Usage

1. Open your web browser and go to `http://localhost:8000`.
2. Use the search feature to find specific glasses products based on criteria like ID or product name.
3. Browse through the list of glasses products and click "More" to view additional details.
4. Use the pagination buttons to navigate through pages of glasses products.

## Contributing

Contributions are welcome! If you'd like to contribute to this project, please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/your-feature-name`).
3. Make your changes.
4. Commit your changes (`git commit -am 'Add some feature'`).
5. Push to the branch (`git push origin feature/your-feature-name`).
6. Create a new pull request.

## License

This project is licensed under the [MIT License](LICENSE).

