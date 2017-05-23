Getting Started With LernpadRepositoryResolverBundle
====================================================

Step 1: Download LernpadRepositoryResolverBundle using composer
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Require the bundle with composer:

.. code-block:: bash

    $ composer require lernpad/repository-resolver dev-master
    
Step 2: Enable the bundle
~~~~~~~~~~~~~~~~~~~~~~~~~

Enable the bundle in the kernel::

    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Lernpad\RepositoryResolverBundle\LernpadRepositoryResolverBundle(),
            // ...
        );
    }
    
Step 3: Register repository as a service
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Register required repository as a service

.. code-block:: yaml
    
    # services.yml
    
    app.entity.user_repository:
        class: AppBundle\Repository\UserRepository
        factory: ["@doctrine.orm.entity_manager", "getRepository"]
        arguments: [ AppBundle\Entity\User ]

Step 4: That's it!
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Finally you need to pass ``UserRepository`` to any action in your controller::

    <?php
    // src/AppBundle/Controller/DefaultController.php
    
    ...
    public function indexAction(Request $request, UserRepository $repository)
    {
        $user = $repository->find(1);
        dump($user);
        ...
 
