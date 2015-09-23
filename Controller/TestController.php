<?php

namespace Ekyna\Bundle\DemoBundle\Controller;

use Ekyna\Bundle\CoreBundle\Controller\Controller;
use FOS\JsRoutingBundle\Extractor\ExtractedRoute;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TestController
 * @package Ekyna\Bundle\DemoBundle\Controller
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class TestController extends Controller
{
    public function testAction()
    {
        $exposedRoutes = [
            'literal'   => new ExtractedRoute([['text', '/literal']], [], []),
            'blog_post' => new ExtractedRoute([['variable', '/', '[^/]+?', 'slug'], ['text', '/blog-post']], [], []),
            'list'      => new ExtractedRoute([['variable', '/', '\d+', 'page'], ['text', '/list']], ['page' => 1], ['page' => '\d+'])
        ];

        $json = $this->get('fos_js_routing.serializer')->serialize($exposedRoutes, 'json');

        $response = new Response($json);
        $response->headers->add(['Content-Type: application/json']);

        return $response;
    }

    public function homeAction()
    {
        $response = $this->render('EkynaDemoBundle:Test:home.html.twig', [
            'message' => 'Uber home',
            'date' => new \DateTime(),
        ]);

        return $this
            ->tagResponse($response, 'demo_test.home[id:2]')
            ->setSharedMaxAge(60)
        ;
    }

    public function partOneAction()
    {
        $response = $this->render('EkynaDemoBundle:Test:part_one.html.twig', [
            'date' => new \DateTime(),
        ]);

        return $this
            ->tagResponse($response, 'test-part-one')
            ->setSharedMaxAge(30)
        ;
    }

    public function partTwoAction()
    {
        $response = $this->render('EkynaDemoBundle:Test:part_two.html.twig', [
            'date' => new \DateTime(),
        ]);

        return $this
            ->tagResponse($response, 'test-part-two')
            ->setSharedMaxAge(20)
        ;
    }

    public function partThreeAction()
    {
        $response = $this->render('EkynaDemoBundle:Test:part_three.html.twig', [
            'date' => new \DateTime(),
        ]);

        return $this
            ->tagResponse($response, 'test-part-three')
            ->setSharedMaxAge(10)
        ;
    }

    public function purgeAction()
    {
        $this->getCacheManager()
            ->invalidateTags(['demo_test.home[id:2]', 'test-part-one', 'test-part-two', 'test-part-three'])
            ->flush()
        ;

        return $this->redirect($this->generateUrl('test_home'));
    }

    /**
     * @param Response $response
     * @param $tags
     * @param bool $replace
     * @return Response
     */
    protected function tagResponse(Response $response, $tags, $replace = false)
    {
        if (!is_array($tags)) {
            $tags = [$tags];
        }
        $this->getCacheManager()->tagResponse($response, $tags, $replace);

        return $response;
    }

    /**
     * @return \FOS\HttpCacheBundle\CacheManager
     */
    protected function getCacheManager()
    {
        return $this->get('fos_http_cache.cache_manager');
    }
}
