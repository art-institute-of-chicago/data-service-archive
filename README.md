![Art Institute of Chicago](https://raw.githubusercontent.com/Art-Institute-of-Chicago/template/master/aic-logo.gif)

# Archives Data Service
> A slim API in front of our institutional image archive

This API standardizes and simplifies access to data that is available through the CONTENTdm API.
Clients don't have to know all the parameters that CONTENTdm's API requires, or how to filter the data.
Nor do they need to worry about limitations in the number of records they's able to retrieve.
They have a few simple endpoints to retrieve the data they're most likely going to need.

This API was built in-house and is maintained by in-house developers. It is planned to go to production in 2018.

## Features

This project provides the following endpoints. You can see their details in swagger.json:

* `/v1/archival-images` - Get a list of all archival images, sorted by the date they were last updated in descending order. Includes pagination options.
* `/v1/archival-images/X` - Get a single archival image

## Overview

This API is part of a larger project at the Art Institute of Chicago to build a data hub for all of
our published data—a single place that our forthcoming website and future products can access all the
data they might be interested in in a simple, normalized, RESTful way. This project provides an
API in front of our institutional image archive that will feed into the data hub.

## Requirements

In our development, we've used the following software:

* PHP 7.1 (may work in earlier versions but hasn't been tested)
* MySQL 5.7 (may work in earlier versions but hasn't been tested)
* [Composer](https://getcomposer.org/)

## Installing

To get started with this project, use the following commands:

```shell
# Clone the repo to your computer
git clone https://github.com/art-institute-of-chicago/data-service-archives.git

# Enter the folder that was created by the clone
cd data-service-archives

# Install PHP dependencies
composer install

# Create a symlink for generated files
php artisan storage:link
```

## Developing

First you'll need to create a `.env` file and update it to reflect your environment. We've provided an
example file to get you started:

```shell
# Copy the example file
cp .env.example .env

# Generate a new key for your Laravel project
php artisan key:generate
```

Then, to create the database tables and seed them with fake data, run:

```shell
php artisan migrate --seed
```

This will create all the tables and relationships, and fill the tables with data from the
[Faker](https://github.com/fzaninotto/Faker) PHP library.

### Importing real data

We've broken up the import process into two step. First, download a local copy of all the JSON
data the API returns. This represents the full source data:

```shell
php artisan archives:download
```

The using your local cache, import all the JSON data to your database:

```shell
php artisan archives:import
```

## Contributing

We encourage your contributions. Please fork this repository and make your changes in a separate branch. To better understand how we organize our code, please review our [version control guidelines](https://docs.google.com/document/d/1B-27HBUc6LDYHwvxp3ILUcPTo67VFIGwo5Hiq4J9Jjw).

```bash
# Clone the repo to your computer
git clone git@github.com:your-github-account/data-service-archive.git

# Enter the folder that was created by the clone
cd data-service-archive

# Install PHP dependencies
composer install

# Start a feature branch
git checkout -b feature/good-short-description

# ... make some changes, commit your code

# Push your branch to GitHub
git push origin feature/good-short-description
```

Then on github.com, create a Pull Request to merge your changes into our
`develop` branch.

This project is released with a Contributor Code of Conduct. By participating in
this project you agree to abide by its [terms](CODE_OF_CONDUCT.md).

We also welcome bug reports and questions under GitHub's [Issues](issues).


## Licensing

This project is licensed under the [GNU Affero General Public License
Version 3](LICENSE).

