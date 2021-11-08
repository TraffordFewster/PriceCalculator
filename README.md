# PriceCalculator

A simple api endpoint built with symfony.

**Setup**
* Clone the repo
* Run `composer i`
* Run a webserver in the public directory this can be done with `php -S localhost:8000` in the public directory
* Send a post request to `/premium` structured in the following way:
```
{
    "age": 20,
    "postcode": "PE3 8AF",
    "regNo": "PJ63 LXR"
}
```
