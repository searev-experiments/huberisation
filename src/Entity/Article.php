<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string $title
     *
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * Small text that will be displayed in the thumbnail
     *
     * @var string $epigraph
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $epigraph;

    /**
     * Tags to easily find this article
     *
     * @var ArrayCollection $tags
     * @ORM\ManyToMany(targetEntity="Tag")
     */
    private $tags;

    /**
     * Date the article was published.
     *
     * @var \DateTime $date
     *
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * Markdown content of the article.
     *
     * @var string $content
     *
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * URI of the article "/article/<uri>"
     *
     * @var string url;
     *
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @var boolean $blog
     *
     * @ORM\Column(type="boolean")
     */
    private $blog = true;

    /**
     * Is this a simple article, or a tutorial ?
     *
     * @var boolean $tutorial
     *
     * @ORM\Column(type="boolean")
     */
    private $tutorial = false;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Une vignette est nécessaire pour cet article")
     * @Assert\File(mimeTypes={ "image/gif", "image/jpeg", "image/png", "image/svg+xml" })
     */
    private $vignette;

    /**
     * Article constructor.
     */
    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return ArrayCollection
     */
    public function getTags(): ?ArrayCollection
    {
        return $this->tags;
    }

    /**
     * @param ArrayCollection $tags
     */
    public function setTags(ArrayCollection $tags): void
    {
        $this->tags = $tags;
    }

    /**
     * @param Tag $tag
     */
    public function addTag(Tag $tag)
    {
        $this->tags->add($tag);
    }

    /**
     * @param Tag $tag
     */
    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * @return \DateTime
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return bool
     */
    public function isBlog(): ?bool
    {
        return $this->blog;
    }

    /**
     * @param bool $blog
     */
    public function setBlog(bool $blog): void
    {
        $this->blog = $blog;
    }

    /**
     * @return bool
     */
    public function isTutorial(): ?bool
    {
        return $this->tutorial;
    }

    /**
     * @param bool $tutorial
     */
    public function setTutorial(bool $tutorial): void
    {
        $this->tutorial = $tutorial;
    }

    /**
     * @return string
     */
    public function getEpigraph(): ?string
    {
        return $this->epigraph;
    }

    /**
     * @param string $epigraph
     */
    public function setEpigraph(string $epigraph): void
    {
        $this->epigraph = $epigraph;
    }

    /**
     * @return mixed
     */
    public function getVignette()
    {
        return $this->vignette;
    }

    /**
     * @param mixed $vignette
     */
    public function setVignette($vignette): void
    {
        $this->vignette = $vignette;
    }

}
