<?php

namespace Ekyna\Bundle\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * CatalogController.
 *
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class CatalogController extends Controller
{
    public function sideMenuAction()
    {
        $categories = $this->get('ekyna_demo.category.repository')->findAll();

        return $this->render(
            'EkynaDemoBundle:Catalog:side_menu.html.twig',
            array(
                'categories' => $categories
            )
        );
    }

    public function indexAction(Request $request)
    {
        $products = $this->get('ekyna_demo.smartphone.search')
            ->setPage($request->query->get('page', 1))
            ->findProducts()
        ;

        return $this->render(
            'EkynaDemoBundle:Catalog:index.html.twig',
            array(
        	    'products' => $products
            )
        );
    }

    public function categoryAction(Request $request)
    {
        $categorySlug = $request->attributes->get('categorySlug');

        if(null === $category = $this->get('ekyna_demo.category.repository')->findBySlug($categorySlug)) {
            throw new NotFoundHttpException(sprintf('Can\'t find "%s" category', $categorySlug));
        }

        $products = $this->get('ekyna_demo.smartphone.search')
            ->setCategory($category)
            ->setPage($request->query->get('page', 1))
            ->findProducts()
        ;

        return $this->render(
            'EkynaDemoBundle:Catalog:category.html.twig',
            array(
                'category' => $category,
                'products' => $products
            )
        );
    }

    public function productAction(Request $request)
    {
        $productSlug = $request->attributes->get('productSlug');

        if(null === $product = $this->get('ekyna_demo.smartphone.repository')->findOneBySlug($productSlug)) {
            throw new NotFoundHttpException(sprintf('Can\'t find "%s" product', $productSlug));
        }

        $form = $this->get('ekyna_order.order_item.factory')->buildAddForm($product, 1, array(
        	'action' => $this->generateUrl('ekyna_cart_add_item')
        ));

        return $this->render(
            'EkynaDemoBundle:Catalog:product.html.twig',
            array(
                'product' => $product,
                'form' => $form->createView()
            )
        );
    }
}
