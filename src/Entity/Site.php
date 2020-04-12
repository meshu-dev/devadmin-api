<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *   attributes={"security"="is_granted('ROLE_USER')"},
 *   normalizationContext={"groups"={"sites:read"}},
 *   denormalizationContext={"groups"={"sites:write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\SiteRepository")
 */
class Site
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"sites:read", "environments:item:get"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Environment", inversedBy="sites")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"sites:read", "sites:write", "environments:item:get"})
     */
    private $environment;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"sites:read", "sites:write", "environments:item:get"})
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups({"sites:read", "sites:write", "environments:item:get"})
     */
    private $url;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEnvironment(): ?environment
    {
        return $this->environment;
    }

    public function setEnvironment(?environment $environment): self
    {
        $this->environment = $environment;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
