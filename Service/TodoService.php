<?php

declare(strict_types=1);

namespace Neo\Bundle\TodoBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Repository\ContainerRepositoryFactory;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Neo\Bundle\TodoBundle\Entity\TodoEntityInterface;

class TodoService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ObjectRepository
     */
    private $repository;

    /**
     * @var string
     */
    private $entityName;

    /**
     * @param EntityManagerInterface $entityManager
     * @param ContainerRepositoryFactory $repositoryFactory
     * @param string $entityName
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        ContainerRepositoryFactory $repositoryFactory,
        string $entityName
    ) {
        $this->entityManager = $entityManager;
        $this->entityName = $entityName;
        $this->repository = $repositoryFactory->getRepository($entityManager, $entityName);
    }

    /**
     * TODO: add pagintaion
     *
     * @return TodoEntityInterface[]
     */
    public function getList(): array
    {
        return $this->repository->findBy([], ['id' => 'DESC']);
    }

    /**
     * @param string $id
     *
     * @return TodoEntityInterface|object|null
     */
    public function getById(string $id): ?TodoEntityInterface
    {
        return $this->repository->find($id);
    }

    /**
     * @param string $id
     * @param bool $isDone
     */
    public function changeStatus(string $id, bool $isDone): void
    {
        $entity = $this->getById($id);

        $entity->setIsDone($isDone);

        $this->save($entity);
    }


    /**
     * @param TodoEntityInterface $entity
     */
    public function save(TodoEntityInterface $entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    /**
     * @param TodoEntityInterface[] $entityList
     */
    public function saveList(array $entityList)
    {
        foreach ($entityList as $entity) {
            $this->entityManager->persist($entity);
        }

        $this->entityManager->flush();
    }

    /**
     * @param string $id
     */
    public function remove(string $id): void
    {
        $entity = $this->entityManager->getReference($this->entityName, $id);

        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}
