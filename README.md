Web archive
===========

**Requires** at least *PHP 5.3.3*. Compatible PHP 5.4 too.

[![Build Status](https://travis-ci.org/pokap/WebArchive.png?branch=master)](https://travis-ci.org/pokap/WebArchive)

Usage
-------------

Example :

``` php

$request = new Request('http://archive.org/', ['timeout' => 10]);

$client = new Client($request, new WayBackProvider(2013)));

var_dump($client->get()); // snapshots archive ...
```
