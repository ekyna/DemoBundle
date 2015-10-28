<?php

namespace Ekyna\Bundle\DemoBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Ekyna\Bundle\AdminBundle\Operator\ResourceOperatorInterface;
use Ekyna\Bundle\CmsBundle\Entity\MenuRepository;
use Ekyna\Bundle\CmsBundle\Entity\PageRepository;
use Ekyna\Bundle\CmsBundle\Entity\SeoRepository;
use Ekyna\Bundle\CmsBundle\Model\PageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadCustomPageData
 * @package Ekyna\Bundle\DemoBundle\DataFixtures\ORM
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class LoadCustomPageData extends AbstractFixture
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @var ResourceOperatorInterface
     */
    private $pageOperator;

    /**
     * @var PageRepository
     */
    private $pageRepository;

    /**
     * @var MenuRepository
     */
    private $menuRepository;

    /**
     * @var SeoRepository
     */
    private $seoRepository;

    /**
     * @var bool
     */
    private $subTree = false;


    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);

        $this->pageOperator = $this->container->get('ekyna_cms.page.operator');
        $this->pageRepository = $this->container->get('ekyna_cms.page.repository');
        $this->menuRepository = $this->container->get('ekyna_cms.menu.repository');
        $this->seoRepository = $this->container->get('ekyna_cms.seo.repository');
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $om)
    {
        $this->om = $om;

        $unlockedPages = $this->pageRepository->findBy(['locked' => false], ['left' => 'desc']);
        foreach ($unlockedPages as $unlockedPage) {
            $this->createPageChildren($unlockedPage);
            if ($this->subTree) {
                return;
            }
        }
    }

    private function createPageChildren(PageInterface $page, $level = 0)
    {
        for ($p = 0; $p < rand(1,3); $p++) {
            /** @var PageInterface $child */
            $child = $this->pageRepository->createNew();
            $name = $this->faker->sentence(rand(4,6), false);
            $child
                ->setName($name)
                ->setTitle($name)
                ->setStatic(false)
                ->setLocked(false)
                ->setController('default')
                ->setAdvanced(true)
                ->setDynamicPath(false)
            ;

            /** @var \Ekyna\Bundle\CmsBundle\Model\SeoInterface $seo */
            $seo = $this->seoRepository->createNew();
            $seo
                ->setTitle($this->faker->sentence(rand(4,6), false))
                ->setDescription($this->faker->sentence(rand(4,6), false))
            ;
            $child->setSeo($seo);

            $this->pageRepository->persistAsLastChildOf($child, $page);
            $this->pageOperator->persist($child);

            $this->createMenu($page, $child);

            if (!$this->subTree && $level < 2) {
                $this->createPageChildren($child, $level + 1);
            }
            if ($level >= 2) {
                $this->subTree = true;
            }
        }
    }

    /**
     * Creates the child page menu.
     *
     * @param PageInterface $page
     * @param PageInterface $childPage
     */
    private  function createMenu(PageInterface $page, PageInterface $childPage)
    {
        if (null !== $menu = $this->menuRepository->findOneByName('main:'.$page->getRoute())) {
            /** @var \Ekyna\Bundle\CmsBundle\Model\MenuInterface $childMenu */
            $childMenu = $this->menuRepository->createNew();
            $childMenu
                ->setName($childPage->getRoute())
                ->setTitle($childPage->getTitle())
                ->setRoute($childPage->getRoute())
                ->setEnabled(true)
            ;
            $this->menuRepository->persistAsLastChildOf($childMenu, $menu);
            $this->om->persist($menu);
            $this->om->flush();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 99;
    }
}
