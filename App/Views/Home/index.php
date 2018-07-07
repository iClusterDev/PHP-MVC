<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Home</title>
</head>
<body>

  <h1>Welcome {{name}}</h1>
  <p>Here are your colors:</p>
  <ul>
    {% for color in colors %}
      <li>{{color}}</li>
    {% endfor %}
  </ul>

</body>
</html>