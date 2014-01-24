Web archive
===========

**Requires** at least *PHP 5.3.3*. Compatible PHP 5.4 too.

[![Build Status](https://travis-ci.org/pokap/WebArchive.png?branch=master)](https://travis-ci.org/pokap/WebArchive)

Usage
-------------

Example :

``` php
$client = new Client(new Request('http://archive.org/', 2013));

$response = $client->send();

var_dump($response->getDateArchives()); // date for each archive ...
```
