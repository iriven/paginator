# Table
A simple paginator

## Usage
### Basic usage

```php
//Create a paginator
$totalPages = 5;
$paginator = new \Studiow\Paginator\Paginator($totalPages);
echo (string) $paginator;
```

## Known Issues 
### Standard warning about rendering HTML
If you find yourself rendering large pieces of HTML within a PHP script, you'd probably be better of using a template system.