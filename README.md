# filament modules issue demo

This repository demonstrates a critical issue with the `filament-modules` package when using Laravel Modules with a custom `app_folder` configuration.

## description

When setting `'app_folder' => '/'` in `config/modules.php`, the entire `filament-modules` library breaks completely. This repository serves as a demonstration project to reproduce and showcase this issue for reporting purposes.

## project

This is a minimal Laravel project that has been configured to reproduce the issue:

### dependencies
- **Laravel Sail** - For Docker-based development environment compatibility
- **Laravel Modules** - Modular architecture package
- **Filament** - Admin panel framework
- **Filament-Modules** - Filament integration for Laravel Modules

### configuration
- Modified `config/modules.php` with `'app_folder' => '/'` setting
- This configuration removes the `app/` prefix from module paths, causing the issue

### demo module
- **MyModule** - Contains two simple models created with VibeCoding:
  - `Post` - Blog post model with relationships
  - `Category` - Category model for organizing posts

## start

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd example-app
   ```

2. **Start Laravel Sail**
   ```bash
   sail up -d
   ```

3. **Install dependencies**
   ```bash
   sail composer install
   ```

4. **Run migrations**
   ```bash
   sail artisan migrate
   ```

5. **Access the application**

## reproduction

The issue manifests when:
1. `config/modules.php` has `'app_folder' => '/'`
2. Filament-Modules tries to resolve module paths
3. Path resolution fails due to missing `app/` prefix
4. Admin panel becomes inaccessible

## details

- **Laravel Version**: 12.x
- **PHP Version**: 8.2+
- **Database**: MySQL 8.0 (via Docker)
- **Module System**: Laravel Modules v12
- **Admin Panel**: Filament v4

## purpose

This repository serves as:
- **Issue Reproduction**: Demonstrates the exact problem
- **Testing Environment**: Allows developers to test fixes
- **Documentation**: Provides clear steps to reproduce the issue
- **Collaboration**: Enables community members to contribute solutions

## notes

- This is intentionally a minimal setup to isolate the issue
- The models are basic examples created with VibeCoding for demonstration
- All paths and configurations are set to trigger the filament-modules failure
- Use this repository to report issues or test potential fixes
