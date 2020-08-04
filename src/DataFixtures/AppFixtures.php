<?php

namespace App\DataFixtures;

use App\Entity\Achat;
use App\Entity\Annonces;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {

        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        $adminUser = new User();
        $adminUser->setFirstName('SACKO')
            ->setLastName('Ismaél')
            ->setEmail('ismalsacko@yahoo.fr')
            ->setHash($this->encoder->encodePassword($adminUser, 'sackosacko'))
            ->setIntro('Administrateur du site')
            ->setPresentation('Je suis l\'administrateur de ce site web')
            ->setUpdatedAt(new \DateTime('now'))
            ->setPicture('381339c6144e8df70a5549163c07de78.jpeg')
            ->addUsersRole($adminRole);
        $manager->persist($adminUser);
        $user = new User();
        $user->setFirstName('NIAFO')
            ->setLastName('Aicha')
            ->setEmail('aicha@yahoo.fr')
            ->setHash($this->encoder->encodePassword($adminUser, 'sackosacko'))
            ->setIntro('simple utilisateur du site')
            ->setPresentation('Je suis un simle administrateur de ce site web')
            ->setUpdatedAt(new \DateTime('now'))
            ->setPicture('381339c6144e8df70a5549163c07de78.jpeg');
        $manager->persist($user);

        $manager->flush();
    }
}
