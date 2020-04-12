<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *   attributes={"security"="is_granted('ROLE_USER')"},
 *   normalizationContext={"groups"={"environments:read"}},
 *   denormalizationContext={"groups"={"environments:write"}},
 *   itemOperations={
 *      "get"={
 *          "normalization_context"={"groups"={"environments:read", "environments:item:get"}}
 *      },
 *      "put",
 *      "delete"
 *   }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\EnvironmentRepository")
 */
class Environment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"environments:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"environments:read", "environments:write"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Site", mappedBy="environment", orphanRemoval=true)
     * @Groups({"environments:read"})
     */
    private $sites;

    public function __construct()
    {
        $this->sites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Site[]
     */
    public function getSites(): Collection
    {
        return $this->sites;
    }

    public function addSite(Site $site): self
    {
        if (!$this->sites->contains($site)) {
            $this->sites[] = $site;
            $site->setEnvironmentId($this);
        }

        return $this;
    }

    public function removeSite(Site $site): self
    {
        if ($this->sites->contains($site)) {
            $this->sites->removeElement($site);
            // set the owning side to null (unless already changed)
            if ($site->getEnvironmentId() === $this) {
                $site->setEnvironmentId(null);
            }
        }

        return $this;
    }
}
