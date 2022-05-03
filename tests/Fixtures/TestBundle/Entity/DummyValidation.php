<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\Tests\Fixtures\TestBundle\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(operations: [new Get(), new Put(), new Patch(), new Delete(), new GetCollection(), new Post(uriTemplate: 'dummy_validation.{_format}'), new GetCollection(routeName: 'post_validation_groups', validationContext: ['groups' => ['a']]), new GetCollection(routeName: 'post_validation_sequence', validationContext: ['groups' => 'app.dummy_validation.group_generator'])])]
#[ORM\Entity]
class DummyValidation
{
    /**
     * @var int|null The id
     */
    #[ORM\Column(type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;
    /**
     * @var string|null The dummy name
     */
    #[ORM\Column(nullable: true)]
    #[Assert\NotNull(groups: ['a'])]
    private ?string $name = null;
    /**
     * @var string|null The dummy title
     */
    #[ORM\Column(nullable: true)]
    #[Assert\NotNull(groups: ['b'])]
    private ?string $title = null;
    /**
     * @var string The dummy code
     */
    #[ORM\Column]
    private ?string $code = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
