# Templating

Base template for latest news and news archive action is very primitive and in most cases
you will need to overwrite it.

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
</head>
    <body>
        <div>
            {% block fsi_news_content %}
            {% endblock fsi_news_content %}
        </div>
    </body>
</html>
```

It can be done by creating twig template in ``app/Resources/FSiNewsBundle/views/base.html.twig``
Just remember to keep ``fsi_news_content block``

You can also overwrite following templates

* ``app/Resources/FSiNewsBundle/views/News/news.html.twig``
* ``app/Resources/FSiNewsBundle/views/News/news_content.html.twig``
* ``app/Resources/FSiNewsBundle/views/News/archive.html.twig``
* ``app/Resources/FSiNewsBundle/views/News/archive_content.html.twig``

## Latest news

Latest news allows you to display latest news for example at homepage.
In order to do so you need to render controller in your homepage template:

```
{{ render(controller('fsi_news.controller.news:latestNewsAction', {'count' : 10})) }}
```

``count`` is number of news to display.

To overwrite latest news template just create you own template in file:

* ``app/Resources/FSiNewsBundle/views/News/Partials/latestNews.html.twig``