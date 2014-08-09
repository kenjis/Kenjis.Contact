#!/bin/sh

export MAILER_GMAIL_ID=アカウント@gmail.com
export MAILER_GMAIL_PASSWORD=パスワード

# clear BEAR.Sunday's cache
php bin/clear.php

vendor/bin/bear.server --port=8000 --context=dev .
#php -S 0.0.0.0:8000 -t var/www/ bootstrap/contexts/dev.php
