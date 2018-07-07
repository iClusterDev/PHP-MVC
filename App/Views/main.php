<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{% block title %}{% endblock %}</title>
</head>
<body>
  <!-- common navigation here -->
  <nav>
    <a href="/">Home</a><span> | </span>
    <a href="/post">Posts</a>
  </nav>

  <!-- body content -->
  {% block body %}{% endblock %}
  
</body>
</html>