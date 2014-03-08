# Installation in 5 simple steps

## 1. Download News Bundle

Add to composer.json

```
"require": {
    "fsi/news-bundle": "dev-master"
}
```

## 2. Register bundles

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // Bundles required by FSiGalleryBundle
        new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),

        // FSiGalleryBundle
        new FSi\Bundle\NewsBundle\FSiNewsBundle(),
    );
}
```

## 3. Configure routing

```
# app/config/routing.yml

news:
    resource: "@FSiNewsBundle/Resources/config/routing/news.yml"
    prefix: /
```

## 4. Create entities

```php
# /src/FSi/FixturesBundle/Entity/News.php

<?php

namespace FSi\FixturesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FSi\Bundle\NewsBundle\Model\News as BaseNews;

/**
 * @ORM\Entity
 * @ORM\Table(name="fsi_news")
 */
class News extends BaseNews
{
}

```

5. Configure application

```
# app/config/config.yml

fsi_news:
    db_driver: orm
    news_class: FSi\FixturesBundle\Entity\News
```

You are now ready to read about [templating](templating.md) gallery


