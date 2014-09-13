# BEAR.Sunday Sample Contact Form

A Sample Contact Form made with BEAR.Sunday which is a resource orientated framework with a REST centered architecture, implementing Dependency Injection and Aspect Orientated Programming' at its core.

## Requirement

* PHP 5.4 or lator

## Installation

~~~
$ git clone https://github.com/kenjis/Kenjis.Contact.git
$ cd Kenjis.Contact
$ composer install
~~~

## Configuration

Edit `server.sh`. Set your Gmail account info to send mail via Gmail.

~~~diff
--- a/server.sh
+++ b/server.sh
@@ -1,7 +1,7 @@
 #!/bin/sh
 
-export MAILER_GMAIL_ID=<your_account@gmail.com>
-export MAILER_GMAIL_PASSWORD=<your_password>
+export MAILER_GMAIL_ID=my.gmail.account@gmail.com
+export MAILER_GMAIL_PASSWORD=My.Gmail.Password
 
 # clear BEAR.Sunday's cache
 php bin/clear.php
~~~

Edit `var/conf/constants.php`. Set your Email account to receive posted data.

~~~diff
--- a/var/conf/constants.php
+++ b/var/conf/constants.php
@@ -25,9 +25,9 @@ return [
         'master_db' => $masterDb,
         'slave_db' => $slaveDb,
         'contact_form' => [
-            'subject'     => 'Contact Form',
-            'admin_email' => 'admin@example.org',
-            'admin_name'  => 'Administrator',
+            'subject'     => 'Subject of Email',
+            'admin_email' => 'you@example.com',
+            'admin_name'  => 'Your name',
         ],
     ],
     'dev' => [],
~~~

## Running App

~~~
$ sh server.sh
~~~

Access to <http://localhost:8000/contact>.

## License

MIT License. See LICENSE.md.

## Reference

* BEAR.Sunday Official Site <http://bearsunday.github.io/>
