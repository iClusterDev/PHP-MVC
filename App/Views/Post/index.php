{% extends "main.php" %}

{% block title %}Post{% endblock %}

{% block body %}
  <h1>Post</h1>
  <ul>
    {% for post in posts %}
      <li>
        <h4>{{ post.title }}</h4>
        <p>{{ post.content }}</p>
      </li>
    {% endfor %}  
  </ul>

{% endblock %}