Todo Bundle
===========

Installation
---------

### Step 1: Bundle upload

Open the console and go to the project directory. Run the following command to load the most suitable stable version of this bundle.
```bash
    composer require neo/todo-bundle
```
*This command implies that [Composer](https://getcomposer.org) installed and available globally.*

### Step 2: Hook up bundle

Next step will be turn on the bundle by adding it to the list of registered bundles in `app/AppKernel.php` :

```php
<?php
// config/bundles.php

return [
    // ...
    Neo\Bundle\TodoBundle\NeoTodoBundle::class => ['all' => true],
];

```

Configuration
------------

Pre-configuration is required to start using the bundle.

```yaml
neo_todo:
    entity_name: Acme\Entity\Todo
```


Using
------------
Creating a trait based entity:

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

Using the TODO list management service:

```php
<?php 

/** @var $todoService \Neo\Bundle\TodoBundle\Service\TodoService*/

// get instance
$entity = $todoService->getById('15');

// get instances list 
$todoService->getList();

// change Todo status 
$todoService->changeStatus('15', true);

// Remove todo
$todoService->remove('15');


// create/update instance
$todoService->save($entity);

// create/update instances list
$todoService->saveList([$entity]);

```

Using Form:
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
