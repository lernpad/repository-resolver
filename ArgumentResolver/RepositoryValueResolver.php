<?php

namespace Lernpad\RepositoryResolverBundle\ArgumentResolver;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class RepositoryValueResolver implements ContainerAwareInterface, ArgumentValueResolverInterface
{
    use ContainerAwareTrait;

    /**
     *
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return is_subclass_of($argument->getType(), EntityRepository::class);
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $reflection = $function = new \ReflectionClass($argument->getType());
        $shortName = $reflection->getShortName();
        yield $this->container->get('app.entity.' . $this->underscoreCase($shortName));
    }

    private function underscoreCase($key)
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $key));
    }
}