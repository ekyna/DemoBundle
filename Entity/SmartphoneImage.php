<?php

namespace Ekyna\Bundle\DemoBundle\Entity;

use Ekyna\Bundle\CoreBundle\Entity\AbstractGalleryImage;

/**
 * SmartphoneImage.
 *
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class SmartphoneImage extends AbstractGalleryImage
{
    /**
     * The smartphone.
     * 
     * @var \Ekyna\Bundle\DemoBundle\Entity\Smartphone
     */
    protected $smartphone;

    /**
     * Sets the smartphone.
     *
     * @param \Ekyna\Bundle\DemoBundle\Entity\Smartphone $product
     * @return \Ekyna\Bundle\DemoBundle\Entity\ProductImage
     */
    public function setSmartphone(Smartphone $smartphone = null)
    {
        $this->smartphone = $smartphone;

        return $this;
    }

    /**
     * Returns the product.
     *
     * @return \Ekyna\Bundle\DemoBundle\Entity\Smartphone
     */
    public function getSmartphone()
    {
        return $this->smartphone;
    }
}
