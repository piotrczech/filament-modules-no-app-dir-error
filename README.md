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

# Issue comment

LINK: https://github.com/savannabits/filament-modules/issues/127

Hi, the issue is still present, so I’m opening this. I’ve prepared a demo repository to reproduce the problem:
`https://github.com/piotrczech/filament-modules-no-app-dir-error`

### Setup
A fresh Laravel project with the following installed:
- laravel sail
- laravel modules
- changed `modules.paths.app_folder` to `/`
- filament
- filament-modules

Using VibeCoding, I created two simple models inside the module to have some data for testing. Then I changed the setting `modules.paths.app_folder` to `/`.

The module folder structure is simplified due to this configuration.

### Errors

1) `artisan module:filament:install`

- The generated Filament configuration is created inside the `app` folder instead of the `/` module.
- To attempt a fix, I moved the generated Filament folder to the root directory and then tried generating a resource.

2) `artisan module:make:filament-resource`

- The command fails with: The "/var/www/html/Modules/MyModule/app/Models" directory does not exist.
- The plugin still searches in the `app` folder despite the configuration pointing to `/`.
- Providing the model name explicitly (e.g., `artisan module:make:filament-resource Post`) generates files in the correct path, but the resource still doesn’t show up in the admin because discovery only looks in `app`.

### Summary

Expected behavior:
1. Filament configuration should respect the `modules.paths.app_folder` setting.
2. Resources should be generated and recognized correctly in the configured `modules.paths.app_folder`.

Actual behavior:
1. Configuration is always created in `app`.
2. Resource generation fails unless the model is explicitly specified.
3. Even generated resources are not detected if they are outside the `app` folder.

This demo repository reproduces the problem reliably and should help avoid misunderstandings when discussing a fix.
