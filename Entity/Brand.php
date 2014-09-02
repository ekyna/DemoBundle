<?php

namespace Ekyna\Bundle\DemoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Ekyna\Bundle\CmsBundle\Entity\Seo;
use Ekyna\Bundle\CmsBundle\Model\ContentSubjectInterface;
use Ekyna\Bundle\CmsBundle\Model\ContentSubjectTrait;

/**
 * Brand
 */
class Brand implements ContentSubjectInterface
{
    use ContentSubjectTrait;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var \Ekyna\Bundle\CmsBundle\Entity\Seo
     */
    private $seo;

    public function __construct()
    {
        $this->seo = new Seo();
        $this->contents = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Brand
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set seo
     *
     * @param \Ekyna\Bundle\CmsBundle\Entity\Seo $seo
     * @return Brand
     */
    public function setSeo(Seo $seo)
    {
        $this->seo = $seo;

        return $this;
    }

    /**
     * Get seo
     *
     * @return \Ekyna\Bundle\CmsBundle\Entity\Seo
     */
    public function getSeo()
    {
        return $this->seo;
    }
}
