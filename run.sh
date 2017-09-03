#!/bin/bash

export PHP_INI_SCAN_DIR="$(pwd)"

php pro.php 2>/dev/null
php rot.php 2>/dev/null
php merge.php 2>/dev/null
php rot.php 2 2>/dev/null
