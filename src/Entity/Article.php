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
     * @var string $epigraphe
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $epigraphe;

    /**
     * @var ArrayCollection $tags
     * @ORM\ManyToMany(targetEntity="Tag")
     */
    private $tags;

    /**
     * @var \DateTime $date
     *
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @var string $content
     *
     * @ORM\Column(type="text")
     */
    private $content;

    /**
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
     * @var boolean $tutoriel
     *
     * @ORM\Column(type="boolean")
     */
    private $tutoriel = false;

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
    public function isTutoriel(): ?bool
    {
        return $this->tutoriel;
    }

    /**
     * @param bool $tutoriel
     */
    public function setTutoriel(bool $tutoriel): void
    {
        $this->tutoriel = $tutoriel;
    }

    /**
     * @return string
     */
    public function getEpigraphe(): ?string
    {
        return $this->epigraphe;
    }

    /**
     * @param string $epigraphe
     */
    public function setEpigraphe(string $epigraphe): void
    {
        $this->epigraphe = $epigraphe;
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
