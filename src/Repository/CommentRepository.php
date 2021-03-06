<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Entity\User;
use App\Service\Like\LikeableInterface;
use App\Service\Like\LikeRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function getUserComments(User $user)
    {
        return $this->createQueryBuilder('c')
            ->addSelect('a')
            ->leftJoin('c.article', 'a')
            ->andWhere('c.owner = :c_owner')
            ->setParameter('c_owner', $user)
            ;
    }
}
