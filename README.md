Google Analytics
=============

Google Analytics as per the Collection Protocol. Specifically useful for MXit.

- cURL-less
- Autohit
- Include and forget

This is v0.1, and it's super basic.. I plan to have a look at this and improve it later on.

_Note_

We're not using cURL here, and instead opening a remote file.. So, make sure your server has the `allow_url_fopen` flag set to `true`.


## Usage

Open `googleanalytics.php` and edit your UA code, then..

```php
require_once("googleanalytics.php");
```

Easy as pie.

**Pull requests welcomed.**

:{D
