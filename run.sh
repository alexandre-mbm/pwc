#!/bin/bash

export PHP_INI_SCAN_DIR="$(pwd)"

php pro.php
php rot.php
php merge.php
php rot.php 2
