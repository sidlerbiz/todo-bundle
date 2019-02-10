Todo Bundle
===========

Установка
---------

### Шаг 1: Загрузка бандла

Откройте консоль и, перейдя в директорию проекта, выполните следующую команду для загрузки наиболее подходящей
стабильной версии этого бандла:
```bash
    composer require neo/todo-bundle
```
*Эта команда подразумевает что [Composer](https://getcomposer.org) установлен и доступен глобально.*

### Шаг 2: Подключение бандла

После включите бандл добавив его в список зарегистрированных бандлов в `app/AppKernel.php` файл вашего проекта:

```php
<?php
// config/bundles.php

return [
    // ...
    Neo\Bundle\TodoBundle\NeoTodoBundle::class => ['all' => true],
];

```

Конфигурация
------------

Чтобы начать использовать бандл требуется предварительная конфигурация.

```yaml
neo_todo:
    entity_name: Acme\Entity\Todo
```


Использвание
------------

Создание сущности на основе трейта:

```php
<?php

namespace Acme\Entity;

use Doctrine\ORM\Mapping as ORM;
use Neo\Bundle\TodoBundle\Entity\TodoEntityInterface;
use Neo\Bundle\TodoBundle\Entity\TodoEntityTrait;

/**
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class Todo implements TodoEntityInterface
{
    use TodoEntityTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    // ...
}
```

Использование сервиса по управлению TODO списком:

```php
<?php 

/** @var $todoService \Neo\Bundle\TodoBundle\Service\TodoService*/

// получить сущность
$entity = $todoService->getById('15');

// получить список всех сущностей
$todoService->getList();

// Изменить статуч Todo 
$todoService->changeStatus('15', true);

// Удалить запись
$todoService->remove('15');


// создать/обновить сущность
$todoService->save($entity);

// создать/обновить список сущностей
$todoService->saveList([$entity]);

```

Использование форм:
```php
<?php

class CreateTodoType extends \Neo\Bundle\TodoBundle\FormType\AbstractCreateTodoType
{

    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Acme\Entity\Todo',
        ]);
    }
}

class EditTodoType extends \Neo\Bundle\TodoBundle\FormType\AbstractEditTodoType
{
    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Acme\Entity\Todo',
        ]);
    }
}
```
