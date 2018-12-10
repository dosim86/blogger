<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{
    const REF_NAME = 'user';
    const REF_NAME_ADMIN = 'admin';

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, self::REF_NAME, function($index) use ($manager) {
            $user = new User();
            $user->setEmail(sprintf('user%s@email.com', $index));
            $user->setFirstname($this->faker->firstName);
            $user->setPassword($this->encoder->encodePassword($user, '123'));
            return $user;
        });

        $this->createMany(1, self::REF_NAME_ADMIN, function($index) use ($manager) {
            $user = new User();
            $user->setRoles(['ROLE_ADMIN']);
            $user->setEmail($this->faker->email);
            $user->setFirstname($this->faker->firstName);
            $user->setPassword($this->encoder->encodePassword($user, '123'));
            return $user;
        });

        $manager->flush();
    }
}
