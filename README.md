# Submission Dependancy
This package is already composer'd into my submission.  Just run composer install on the other repo.

## bythepixel-weather-challenge
PHP package for openweathermap.org

Add repo section to composer.json
```
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/kobatron/bythepixel-composer-package"
        }
    ],
```

```composer require by-the-pixel/weather-challenge dev-master```

