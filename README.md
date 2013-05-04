Web archive dot com API
=======

**Requires** at least *PHP 5.3.3*. Compatible PHP 5.4 too.

Usage
-------------

Example :

``` php
$client = new Client(new Request('http://archive.org/', 2013));

$response = $client->send();

var_dump($response->getDateArchives()); // date for each archive ...
```