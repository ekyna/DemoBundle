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
     * @var Smartphone
     */
    protected $smartphone;

    /**
     * Sets the smartphone.
     *
     * @param Smartphone $smartphone
     * @return SmartphoneImage
     */
    public function setSmartphone(Smartphone $smartphone = null)
    {
        $this->smartphone = $smartphone;

        return $this;
    }

    /**
     * Returns the smartphone.
     *
     * @return Smartphone
     */
    public function getSmartphone()
    {
        return $this->smartphone;
    }
}
