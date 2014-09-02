<?php

namespace Ekyna\Bundle\CompanyBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ekyna\Bundle\UserBundle\Entity\User;
use Ekyna\Bundle\UserBundle\Entity\Address;

/**
 * LoadUserData
 *
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        return;
        
        $faker = \Faker\Factory::create('fr_FR');

        if(null === $userGroup = $manager->getRepository('EkynaUserBundle:Group')->findOneBy(array('default' => true))) {
            throw new \Exception('Default group not found.');
        }

        for($i=0; $i<32; $i++) {

            $gender = $faker->randomElement(array('mr', 'mrs', 'miss'));
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $phone = $faker->firstName;
            $mobile = $faker->firstName;

            $address = new Address();
            $address
                ->setGender($gender)
                ->setFirstname($firstName)
                ->setLastname($lastName)
                ->setStreet($faker->streetAddress)
                ->setPostalCode($faker->postcode)
                ->setCity($faker->city)
                ->setPhone($phone)
                ->setMobile($mobile)
            ;

            $user = new User();
            $user
                ->setEmail($faker->email)
                ->setgender($gender)
                ->setFirstname($firstName)
                ->setLastname($lastName)
                ->setPhone($phone)
                ->setMobile($mobile)
                ->setUsername($faker->userName)
                ->setPlainPassword('test')
                ->setGroup($userGroup)
                ->addAddress($address)
                ->setEnabled(true)
            ;
            $manager->persist($user);

            $this->addReference('user-'.$i, $user);
        }

        $manager->flush();
    }

    public function getOrder()
    {
    	return 1;
    }
}
