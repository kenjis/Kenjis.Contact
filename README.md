# BEAR.Sunday Sample Contact Form

A Sample Contact Form maed with BEAR.Sunday which is a resource orientated framework with a REST centered architecture, implementing Dependency Injection and Aspect Orientated Programming' at its core.

## Requirement

* PHP 5.4 or lator

## Installation

~~~
$ git clone https://github.com/kenjis/Kenjis.Contact.git
$ cd Kenjis.Contact
$ composer install
~~~

## Configuration

Edit server.sh. Set your Gmail account info to send mail via Gmail.

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

Edit src/Resource/App/Contact/Form.php. Set your Email account for recieving posted data.

~~~diff
--- a/src/Resource/App/Contact/Form.php
+++ b/src/Resource/App/Contact/Form.php
@@ -20,8 +20,8 @@ class Form extends ResourceObject
     private $mailer;
 
     // Email account to send mail
-    private $adminEmail = 'admin@example.org';
-    private $adminName = 'Administrator';
+    private $adminEmail = 'you@example.com';
+    private $adminName = 'Name what you want';
 
     /**
      * @Inject
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
