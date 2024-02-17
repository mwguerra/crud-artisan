# CRUD Artisan by mwguerra

CRUD Artisan is a Laravel package designed to accelerate development by simplifying the creation of CRUD (Create, Read, Update, Delete) operations. With a series of intuitive Artisan commands, developers can generate models, controllers, views, and routes for their application's entities, focusing more on developing unique features rather than boilerplate code.

## Features

- Generate complete CRUD operations with a single command.
- Customizable templates for views, models, and controllers.
- Support for Laravel's latest versions.
- Easy integration into existing Laravel projects.
- Configuration options to tailor the CRUD operations to your project's needs.

## Installation

You can install the package via Composer. Run the following command in your Laravel project:

```bash
composer require mwguerra/crud-artisan
```

After installation, publish the package's configuration file to customize the templates and settings:

```bash
php artisan vendor:publish --provider="Mwguerra\CrudArtisan\CrudArtisanServiceProvider"
```

## Usage

To create a complete CRUD for an entity, run:

```bash
php artisan make:crud NameOfYourEntity
```

This command will generate:
- A Model for the entity.
- A Controller with methods for creating, reading, updating, and deleting the entity.
- Views for each of the CRUD operations.
- Routes for accessing the CRUD operations.

### Customizing Templates

You can customize the templates used for generating views, models, and controllers by editing the published configuration file and the template files in the `resources/views/vendor/crud-artisan` directory.

## Configuration

The `config/crud-artisan.php` file allows you to define defaults and behaviors for the CRUD generation. You can specify namespaces, paths, and template specifics.

## Contributing

Contributions are welcome and will be fully credited. Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The CRUD Artisan package is open-sourced software licensed under the [MIT license](LICENSE.md).

## Support

If you have any questions or encounter issues, please open an issue on the GitHub repository.
