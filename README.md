Google Analytics
=============

Google Analytics as per the [Collection Protocol](https://developers.google.com/analytics/devguides/collection/protocol/v1/reference).

Specifically useful for MXit & Mobile sites.

----

There are 2 different ways you can use this library.

**PHP**
- Non-blocking using `exec` & `cURL`. ([src](https://segment.io/blog/how-to-make-async-requests-in-php/))
- Blocking using `file_get_contents`, but `cURL`-less.

----

**Features**

- Easy config
- Autohit
- Include and forget

### Notes

_Non-blocking_

Make sure your server has `php_curl` installed.

_Blocking_

Make sure your server has the `allow_url_fopen` flag set to `On`.


## Usage

**PHP**
Open and edit `googleanalytics.php`.

```php
require_once("googleanalytics.php");
```

**C#**

**Events**
```cs
GoogleAnalytics ga = new GoogleAnalytics();
ga.GoogleAnalyticsTracking(Request.Url.GetLeftPart(UriPartial.Authority), HttpUtility.UrlEncode(Request.Url.PathAndQuery), Page.Title, "event", "click", "action", "label");
```

**PageViews**
```cs
GoogleAnalytics ga = new GoogleAnalytics();
ga.GoogleAnalyticsTracking(Request.Url.GetLeftPart(UriPartial.Authority), HttpUtility.UrlEncode(Request.Url.PathAndQuery),Page.Title, "pageview", "", "", "");
```
Easy as pie.

**Pull requests welcomed.**

:{D
