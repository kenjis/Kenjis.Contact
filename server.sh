#!/bin/sh

export MAILER_GMAIL_ID=<your_account@gmail.com>
export MAILER_GMAIL_PASSWORD=<your_password>

# clear BEAR.Sunday's cache
php bin/clear.php

vendor/bin/bear.server --port=8000 --context=dev .
#php -S 0.0.0.0:8000 -t var/www/ bootstrap/contexts/dev.php
