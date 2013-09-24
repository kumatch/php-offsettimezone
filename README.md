OffsetTimezone
===========

Create a DateTimeZone object by offset.


Install
-----

Add "kumatch/offsettimezone" as a dependency in your project's composer.json file.


    {
      "require": {
        "kumatch/offsettimezone": "*"
      }
    }

And install your dependencies.

    $ composer install



Usage
-----

```php
use Kumatch\OffsetTimeZone\OffsetTimeZone

$offsetTimeZone = new OffsetTimeZone();

$tz0 = $offsetTimeZone->createTimeZone(0);         // UTC timezone
$tz1 = $offsetTimeZone->createTimeZone( 9 * 3600); // UTC +9
$tz2 = $offsetTimeZone->createTimeZone(-7 * 3600); // UTC -7

// print UTC datetime.
$date = new DateTime("now", $tz0);
echo $date->format('Y-m-d H:i:s'), "\n";

// print UTC +9 datetime
$date->setTimetime($tz1);
echo $date->format('Y-m-d H:i:s'), "\n";
```


License
--------

Licensed under the MIT License.

Copyright (c) 2013 Yosuke Kumakura

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
