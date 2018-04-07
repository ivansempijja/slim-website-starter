# slim-website-starter
a slim php starter park with eloquent and twig templating

Slim is a PHP micro framework that helps you quickly write simple yet powerful web applications and APIs.

Folder structure

index.php - calls app/app.php
.htacess - Restricts access to composer.json and composer.lock, also has url rewrite rules

assets - folder includes public and static files
  |--img
  |--js
  |--css

Views - folder includes twigs templates
  |--app.twig - this is the base twig file
  |--pages
    |-- 404.twig

app
  |--app.php
  |--routes.php
  |--Controllers
  |  |--Controller.php
  |--Middleware
  |  |--Middleware.php       
  |--Helpers
  |  |--Helper.php
  |--Models