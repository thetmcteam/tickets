## Installation
> **Note:** This application is currently in Beta.

To start off you need to clone the repository to your environment. Once the repository is cloned you can install any necessary dependencies.

```
git clone https://github.com/thetmcteam/tickets
cd tickets
git checkout [release]
composer install
```

## Configuration
After cloning the repository you need to configure your application. First off, copy the `.env.example` file located in the root directory to `.env`. Here you need to configure your mail and database settings. If you are going to use Active Directory you can configure those settings here also. After you have finished the above steps you can go ahead and run the installation command. This will cache your configuration, run migrations and seed your tables.

```
cp .env.example .env
php artisan key:generate
php artisan app:install
```

# First Login
After all the above steps have been ran, you should now be able to login to your application. The users table seeder will generate an admin user for you.

- `username admin`
- `password secret`

# Contribution
If you experience any bugs go ahead and either open an issue or create a pull request with a solution and a clear description of the issue along with tests. Any new, major features should be sent to the master branch.
