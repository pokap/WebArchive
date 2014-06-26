Web archive
===========

**Requires** at least *PHP 5.3.3*.

This is a client for retrieve list of snapshots archives from web.archive.org, or another depending on provider.

[![Build Status](https://travis-ci.org/pokap/WebArchive.png?branch=master)](https://travis-ci.org/pokap/WebArchive)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/0aac9a60-2c04-4d55-a909-4986e9b61bc5/mini.png)](https://insight.sensiolabs.com/projects/0aac9a60-2c04-4d55-a909-4986e9b61bc5)

### Installation using Composer

Add the dependency:

```bash
php composer.phar require pokap/webarchive
```

### Usage

If you need a list of archive snapshot from WayBack in 2013.

``` php
<?php

use WebArchive\Request;
use WebArchive\Client;
use WebArchive\Provider\WayBackProvider;

$request = new Request('http://archive.org/', ['timeout' => 10]);

$client = new Client($request, new WayBackProvider(2013)));

var_dump($client->retrieve()); // returns an instance of \WebArchive\SnapshotCollection
```
