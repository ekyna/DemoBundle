<?php

namespace Ekyna\Bundle\DemoBundle\Controller\Admin;

use Ekyna\Bundle\AdminBundle\Controller\Context;
use Ekyna\Bundle\AdminBundle\Controller\ResourceController;
use Ekyna\Bundle\AdminBundle\Controller\Resource\TinymceTrait;
use Ekyna\Bundle\CmsBundle\Entity\Content;
use Ekyna\Bundle\CmsBundle\Entity\TinymceBlock;
use Symfony\Component\HttpFoundation\Request;

/**
 * SmartphoneController.
 *
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class SmartphoneController extends ResourceController
{
    use TinymceTrait;

    /**
     * {@inheritDoc}
     */
	protected function createNew(Context $context)
	{
	    $resource = parent::createNew($context);

	    $block = new TinymceBlock();
	    $block
    	    ->setRow(1)
    	    ->setColumn(1)
    	    ->setSize(12)
    	    ->setHtml('<p>Page en cours de rédaction.</p>')
	    ;

	    $content = new Content();
	    $content
    	    ->setVersion(1)
    	    ->addBlock($block)
	    ;

	    $resource->addContent($content);

        return $resource;
	}
}
