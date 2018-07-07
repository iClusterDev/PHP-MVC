{% extends "main.php" %}

{% block title %}Home{% endblock %}

{% block body %}
  <h1>Welcome {{name}}</h1>
  <p>Here are your colors:</p>
  <ul>
    {% for color in colors %}
      <li>{{color}}</li>
    {% endfor %}
  </ul>
{% endblock %}