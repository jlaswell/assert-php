# CODEX

This document outlines the coding standards, conventions, and workflows for this project.

## Requirements

- PHP ^8.3
- Composer
- [Just](https://github.com/casey/just) task runner
- Docker (for containerized tasks)

## Getting Started

Install dependencies:

```bash
just composer install
```

## Task Runner

This project uses [Just](https://github.com/casey/just) as a task runner. Available tasks are defined in the **.justfile**. To list available tasks:

```bash
just --list
```

### Common Tasks

| Task                | Description                                          |
|---------------------|------------------------------------------------------|
| `composer <args>`   | Run Composer commands inside a container             |
| `phpstan <args>`    | Run PHPStan static analysis                          |
| `phpstan-baseline`  | Generate a PHPStan baseline                          |
| `phpunit <args>`    | Run PHPUnit tests (no coverage)                      |
| `phpunit-coverage`  | Run PHPUnit tests with code coverage report          |
| `test`              | Run both PHPUnit and PHPStan                         |
| `run <cmd>`         | Run an arbitrary command inside PHP CLI container    |

See **.justfile** for full details on task definitions.

## Coding Standards

### PHP

- **PSR-12** coding style
- **PSR-4** autoloading
- `declare(strict_types=1);` at the top of all PHP files
- Type declarations for function/method parameters and return types
- PHPDoc blocks for all public classes, methods, and constants
- Avoid unused imports and variables

### Code Quality

- Static analysis with [PHPStan](https://phpstan.org/) at level 9
- Unit testing with [PHPUnit](https://phpunit.de/)
- Tests located under `tests/`, matching the `src/` namespace and folder structure
- Code coverage reports generated under `cov/` via `just phpunit-coverage`

## CI / CD

This project uses GitHub Actions to run CI on `main`. The workflow is defined in `.github/workflows/php.yml`:

- Validates `composer.json` and `composer.lock`
- Installs dependencies with lowest and stable flags
- Runs PHPUnit tests
- (Optional) Add code coverage and static analysis steps

## Contribution

- Pull requests should pass `just test` and `composer validate --strict` locally
- Follow commit message conventions (e.g., Conventional Commits)
- Write tests for new features and bug fixes
- Ensure all tests and analysis checks pass before merging

## Versioning & Releases

- This library follows [Semantic Versioning](https://semver.org/)
- Releases are tagged on `main` using Git tags

## License

This project is licensed under the MIT License, as specified in `composer.json`.
