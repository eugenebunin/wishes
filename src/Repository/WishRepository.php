<?php
declare(strict_types=1);

namespace App\Repository;

use App\StateEnum;
use App\WishId;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Entity;
use Domain\EntityFactory;
use Domain\Exceptions\EntityNotFound;
use Domain\Id;
use Domain\Query;
use Domain\Repository as Contract;
use App\Entity\Wish;
use DateTime;

/**
 * Class WishRepository
 * @package App\Repository
 */
class WishRepository implements Contract
{
    protected EntityManagerInterface $em;
    protected string $entityClass = Wish::class;
    private EntityFactory $factory;

    public function __construct(EntityManagerInterface $em, EntityFactory $factory)
    {
        $this->em = $em;
        $this->factory = $factory;
    }

    /**
     * @param Id $id
     * @return Entity
     * @throws EntityNotFound
     */
    public function find(Id $id): Entity
    {
        /** @var $result Wish */
        if (!$result = $this->em->find($this->entityClass, (string)$id)) {
            throw new EntityNotFound();
        }
        return $this->fromPersistence($result);
    }

    public function delete(Id $id): void
    {
        $result = $this->em->find($this->entityClass, (string)$id);
        $this->em->remove($result);
        $this->em->flush();
    }

    public function create(Entity $entity): void
    {
        $model = new $this->entityClass((string)$entity->getId(), $entity->getTitle()->value(), $entity->getPrice()->value(), StateEnum::key($entity->getState()->slug()), $entity->getCreatedAt(), $entity->getUpdatedAt());
        $this->em->persist($model);
        $this->em->flush();
    }

    public function update(Entity $entity): void
    {
        /** @var Wish $model */
        $model = $this->em->find($this->entityClass, (string)$entity->getId());
        $model->setTitle($entity->getTitle()->value());
        $model->setPrice($entity->getPrice()->value());
        $model->setUpdatedAt(new DateTime());
        $model->setState(StateEnum::key($entity->getState()->slug()));
        $this->em->persist($model);
        $this->em->flush();
    }

    public function fetch(Query $query): array
    {
        $collection = [];
        $result = $this->em->createQueryBuilder()->select('w')->from($this->entityClass, 'w')->getQuery()->getResult();
        foreach ($result as $wish) {
            $collection[] = $this->fromPersistence($wish);
        }
        return $collection;
    }

    protected function fromPersistence(Wish $wish): Entity
    {
        $mapper = $this->factory->fromPersistenceMapper();
        return call_user_func_array($mapper, [new WishId($wish->getId()), $wish->getTitle(), $wish->getPrice(), $wish->getState(), $wish->getCreatedAt(), $wish->getUpdatedAt()]);
    }
}
