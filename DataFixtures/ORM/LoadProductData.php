<?php

namespace Ekyna\Bundle\DemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Ekyna\Bundle\DemoBundle\Entity\Category;
use Ekyna\Bundle\CmsBundle\Entity\Seo;
use Ekyna\Bundle\DemoBundle\Entity\Smartphone;
use Ekyna\Bundle\ProductBundle\Entity\Tax;
use Ekyna\Bundle\DemoBundle\Entity\SmartphoneImage;
use Ekyna\Component\Sale\Product\ProductTypes;

/**
 * LoadProductData
 *
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        //return;
        
        $faker = \Faker\Factory::create('fr_FR');
        $photosCategory = array('business', 'city', 'technics', 'transport');

        // Taxes
        $tax = new Tax();
        $tax
            ->setName('TVA 20%')
            ->setRate(0.2)
        ;
        $manager->persist($tax);
        $manager->flush();


        // Categories
        $smartphonesSeo = new Seo();
        $smartphonesSeo
            ->setTitle('Tous les smartphones')
            ->setDescription('Tous les smartphones')
        ;
        $smartphones = new Category();
        $smartphones
            ->setName('Smartphones')
            ->setHtml('<p>Smartphones</p>')
            ->setSeo($smartphonesSeo)
        ;
        $manager->persist($smartphones);
        $manager->flush();


        // Smartphones
        for ($i=0; $i<32; $i++) {
            $smartphoneName = rtrim($faker->sentence(rand(1,3)), '.');

            $smartphoneSeo = new Seo();
            $smartphoneSeo
                ->setTitle($smartphoneName)
                ->setDescription($smartphoneName)
            ;
            $smartphone = new Smartphone();
            $smartphone
                ->setName($smartphoneName)
                ->setCategory($smartphones)
                ->setSeo($smartphoneSeo)
                ->setHtml('')
                ->setReleasedAt(new \DateTime())
                ->setReference('SMART-'.str_pad($i+1, 4, '0', STR_PAD_LEFT))
                ->setDesignation($smartphoneName)
                ->setType(ProductTypes::PHYSICAL)
                ->setPrice(rand(1,5)*100 + 99)
                ->setTax($tax)
                ->setWeight(800)
            ;

            for ($j=0; $j<rand(0, 4); $j++) {
                $realpath = $faker->image(sys_get_temp_dir(), 800, 600, $faker->randomElement($photosCategory));
                $filename = pathinfo($realpath, PATHINFO_BASENAME);
                $image = new SmartphoneImage();
                $image
                    ->setPosition($j)
                    ->setFile(new UploadedFile($realpath, $filename))
                    ->setRename(sprintf('%s photo %s', $smartphoneName, $j+1))
                    ->setAlt(sprintf('%s photo %s', $smartphoneName, $j+1))
                ;
                $smartphone->addImage($image);
            }

            $manager->persist($smartphone);
            $manager->flush();
        }
    }

    public function getOrder()
    {
    	return 2;
    }
}
