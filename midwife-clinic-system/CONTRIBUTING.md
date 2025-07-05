# Contributing to Midwife Clinic Management System

Thank you for your interest in contributing to the Midwife Clinic Management System! We welcome contributions from the community and are grateful for any help you can provide.

## Code of Conduct

By participating in this project, you agree to abide by our Code of Conduct. Please be respectful and professional in all interactions.

## How to Contribute

### Reporting Bugs

Before creating bug reports, please check the existing issues to avoid duplicates. When you create a bug report, include as many details as possible:

- **Use a clear and descriptive title**
- **Describe the exact steps to reproduce the problem**
- **Provide specific examples to demonstrate the steps**
- **Describe the behavior you observed and what behavior you expected**
- **Include screenshots if applicable**
- **Specify your environment** (PHP version, Laravel version, browser, OS)

### Suggesting Enhancements

Enhancement suggestions are welcome! Please provide:

- **A clear and descriptive title**
- **A detailed description of the suggested enhancement**
- **Explain why this enhancement would be useful**
- **List any drawbacks or considerations**

### Pull Requests

1. **Fork the repository** and create your branch from `main`
2. **Follow the coding standards** outlined below
3. **Write or update tests** for your changes
4. **Update documentation** if necessary
5. **Ensure all tests pass**
6. **Submit a pull request**

## Development Setup

### Prerequisites

- PHP 8.2+
- Composer
- Node.js & NPM
- SQLite/MySQL/PostgreSQL

### Local Development

1. Fork and clone the repository
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```
3. Copy environment file and generate key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Run migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```
5. Start the development server:
   ```bash
   php artisan serve
   npm run dev
   ```

## Coding Standards

### PHP/Laravel Standards

- Follow **PSR-12** coding style
- Use **meaningful variable and method names**
- Write **comprehensive docblocks**
- Follow **Laravel naming conventions**:
  - Controllers: `PascalCase` (e.g., `PatientController`)
  - Models: `PascalCase` singular (e.g., `Patient`)
  - Variables: `camelCase` (e.g., `$patientName`)
  - Database tables: `snake_case` plural (e.g., `patient_records`)

### Frontend Standards

- Use **Bootstrap 5.3** classes consistently
- Follow **BEM methodology** for custom CSS
- Ensure **responsive design** principles
- Test on multiple browsers and devices

### Database Standards

- Use **descriptive column names**
- Include **proper foreign key constraints**
- Write **clear migration files**
- Include **rollback functionality** in migrations

## Testing

### Running Tests

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/PatientTest.php

# Run with coverage
php artisan test --coverage
```

### Writing Tests

- Write **feature tests** for user interactions
- Write **unit tests** for individual methods
- Use **meaningful test names** that describe the behavior
- Include **edge cases** and **error scenarios**

Example test structure:
```php
public function test_user_can_create_patient_with_valid_data()
{
    // Arrange
    $userData = ['name' => 'John Doe', 'email' => 'john@example.com'];
    
    // Act
    $response = $this->post('/patients', $userData);
    
    // Assert
    $response->assertStatus(201);
    $this->assertDatabaseHas('patients', $userData);
}
```

## Translation Guidelines

### Adding New Translations

1. Add translation keys to both `lang/en/app.php` and `lang/id/app.php`
2. Use **descriptive keys** (e.g., `patient_registration_success`)
3. Keep translations **contextually appropriate**
4. Test translations in both languages

### Translation Best Practices

- Use **professional medical terminology**
- Keep **consistent tone** across languages
- Consider **cultural context** for Indonesian translations
- Test **UI layout** with longer translations

## Documentation

### Code Documentation

- Document all **public methods** with docblocks
- Include **parameter types** and **return types**
- Explain **complex business logic**
- Update **API documentation** for endpoint changes

### README Updates

- Update feature lists for new functionality
- Include **installation steps** for new dependencies
- Update **screenshots** if UI changes significantly

## Database Changes

### Migrations

- Create **reversible migrations**
- Use **descriptive migration names**
- Include **proper indexing** for performance
- Test **rollback functionality**

### Seeders

- Create **realistic test data**
- Include **both English and Indonesian** sample data
- Ensure **consistent data relationships**

## Security Considerations

- **Validate all input** data
- Use **Laravel's built-in security features**
- Follow **OWASP guidelines**
- **Never commit sensitive information**
- Use **environment variables** for configuration

## Performance Guidelines

- Use **eager loading** to prevent N+1 queries
- **Cache frequently accessed data**
- **Optimize database queries**
- **Minimize asset sizes**

## Git Workflow

### Commit Messages

Use the conventional commit format:
```
type(scope): description

feat(patient): add patient search functionality
fix(translation): correct Indonesian medical terms
docs(readme): update installation instructions
style(dashboard): improve responsive design
refactor(auth): simplify login logic
test(patient): add patient creation tests
```

### Branch Naming

- `feature/feature-name` for new features
- `bugfix/bug-description` for bug fixes
- `hotfix/critical-fix` for urgent fixes
- `docs/documentation-update` for documentation

## Release Process

### Version Numbering

We follow [Semantic Versioning](https://semver.org/):
- **MAJOR**: Incompatible API changes
- **MINOR**: New functionality (backward compatible)
- **PATCH**: Bug fixes (backward compatible)

### Changelog

Update `CHANGELOG.md` with:
- **Added** features
- **Changed** functionality
- **Fixed** bugs
- **Security** improvements

## Questions and Support

- **GitHub Issues**: For bug reports and feature requests
- **GitHub Discussions**: For questions and general discussion
- **Email**: For security concerns or private matters

Thank you for contributing! 🎉
