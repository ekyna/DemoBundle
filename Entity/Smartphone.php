<?php

namespace Ekyna\Bundle\DemoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Ekyna\Bundle\CmsBundle\Model\ContentSubjectTrait;
use Ekyna\Bundle\CmsBundle\Model\ContentSubjectInterface;
use Ekyna\Bundle\CmsBundle\Entity\Seo;
use Ekyna\Bundle\ProductBundle\Entity\AbstractProduct;

/**
 * Smartphone.
 *
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class Smartphone extends AbstractProduct implements ContentSubjectInterface
{
    use ContentSubjectTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Category
     */
    protected $category;

    /**
     * @var Brand
     */
    protected $brand;

    /**
     * @var string
     */
    protected $html;

    /**
     * @var \DateTime
     */
    protected $releasedAt;

    /**
     * @var \Ekyna\Bundle\CmsBundle\Entity\Seo
     */
    protected $seo;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $images;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $variants;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $tags;

    /**
     * @var \Ekyna\Bundle\DemoBundle\Entity\SmartphoneCharacteristics
     */
    protected $characteristics;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->contents = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->variants = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->seo = new Seo();
        $this->setCharacteristics(new SmartphoneCharacteristics());
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Smartphone
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the category.
     *
     * @param Category $category
     * 
     * @return Smartphone
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Returns the category.
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Sets the brand.
     *
     * @param Brand $brand
     *
     * @return Smartphone
     */
    public function setBrand(Brand $brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Returns the brand.
     *
     * @return Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set html
     *
     * @param string $html
     * @return Smartphone
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * Get html
     *
     * @return string 
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * Set releasedAt
     *
     * @param \DateTime $releasedAt
     * @return Smartphone
     */
    public function setReleasedAt(\DateTime $releasedAt = null)
    {
        $this->releasedAt = $releasedAt;

        return $this;
    }

    /**
     * Get releasedAt
     *
     * @return \DateTime 
     */
    public function getReleasedAt()
    {
        return $this->releasedAt;
    }

    /**
     * Set seo
     *
     * @param \Ekyna\Bundle\CmsBundle\Entity\Seo $seo
     * @return Smartphone
     */
    public function setSeo(Seo $seo = null)
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

    /**
     * Add images
     *
     * @param SmartphoneImage $images
     * @return Smartphone
     */
    public function addImage(SmartphoneImage $image)
    {
        $image->setSmartphone($this);
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove images
     *
     * @param SmartphoneImage $images
     */
    public function removeImage(SmartphoneImage $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Sets the variants.
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $variants
     * @return Smartphone
     */
    public function setVariants($variants)
    {
        foreach($variants as $variant) {
            $variant->setSmartphone($this);
        }
        $this->variants = $variants;

        return $this;
    }

    /**
     * Adds a variant.
     * @param SmartphoneVariant $variant
     * @return Smartphone
     */
    public function addVariant(SmartphoneVariant $variant)
    {
        if (!$this->variants->contains($variant)) {
            $variant->setSmartphone($this);
            $this->variants->add($variant);
        }

        return $this;
    }

    /**
     * Removes a variant.
     *
     * @param SmartphoneVariant $variant
     * @return Smartphone
     */
    public function removeVariant(SmartphoneVariant $variant)
    {
        if ($this->variants->contains($variant)) {
            $this->variants->removeElement($variant);
        }

        return $this;
    }

    /**
     * Returns the variants.
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getVariants()
    {
        return $this->variants;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * Add tag
     *
     * @param Tag $tag
     * @return Smartphone
     */
    public function addTag(Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Removes a tag.
     *
     * @param Tag $tag
     * @return Smartphone
     */
    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param SmartphoneCharacteristics $characteristics
     * @return Smartphone
     */
    public function setCharacteristics(SmartphoneCharacteristics $characteristics)
    {
        $characteristics->setSmartphone($this);
        $this->characteristics = $characteristics;

        return $this;
    }

    /**
     * @return SmartphoneCharacteristics
     */
    public function getCharacteristics()
    {
        return $this->characteristics;
    }
}
