As of Symfony 3.3 this bundle has DEPRECATED status, you need to use autowire and 
autoconfigure. Following is make for you the same staff without this bundle::

Step 1: Register repository as a service
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Register required repository as a service

.. code-block:: yaml

    'AppBundle\Repository\UserRepository':
        factory: ["@doctrine.orm.entity_manager", "getRepository"]
        arguments: [ AppBundle\Entity\User ]

Step 2: Do not forget at your repository using annotations
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 
@ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 

Step 3: Using
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Voila! Now you can pass UserRepository to your controller::

    <?php
    // src/AppBundle/Controller/DefaultController.php
    use AppBundle\Repository\UserRepository;
    
    class DefaultController extends Controller
    {
        public function indexAction(UserRepository $repository)
        {
            ...
        }
    }
