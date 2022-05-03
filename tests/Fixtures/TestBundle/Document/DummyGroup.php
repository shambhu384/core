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

namespace ApiPlatform\Tests\Fixtures\TestBundle\Document;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GraphQl\Mutation;
use ApiPlatform\Metadata\GraphQl\Query;
use ApiPlatform\Metadata\GraphQl\QueryCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * DummyGroup.
 *
 * @author Baptiste Meyer <baptiste.meyer@gmail.com>
 * @author Alan Poulain <contact@alanpoulain.eu>
 * @ODM\Document
 */
#[ApiResource(graphQlOperations: [new Query(name: 'item_query', normalizationContext: ['groups' => ['dummy_foo']]), new QueryCollection(name: 'collection_query', normalizationContext: ['groups' => ['dummy_foo']]), new Mutation(name: 'delete'), new Mutation(name: 'create', normalizationContext: ['groups' => ['dummy_bar']], denormalizationContext: ['groups' => ['dummy_bar', 'dummy_baz']])], normalizationContext: ['groups' => ['dummy_read']], denormalizationContext: ['groups' => ['dummy_write']], filters: ['dummy_group.group', 'dummy_group.override_group', 'dummy_group.whitelist_group', 'dummy_group.override_whitelist_group'])]
class DummyGroup
{
    /**
     * @ODM\Id(strategy="INCREMENT", type="int")
     */
    #[Groups(['dummy', 'dummy_read', 'dummy_id'])]
    private ?int $id = null;
    /**
     * @var string|null
     *
     * @ODM\Field(nullable=true)
     */
    #[Groups(['dummy', 'dummy_read', 'dummy_write', 'dummy_foo'])]
    public $foo;
    /**
     * @var string|null
     *
     * @ODM\Field(nullable=true)
     */
    #[Groups(['dummy', 'dummy_read', 'dummy_write', 'dummy_bar'])]
    public $bar;
    /**
     * @var string|null
     *
     * @ODM\Field(nullable=true)
     */
    #[Groups(['dummy', 'dummy_read', 'dummy_baz'])]
    public $baz;
    /**
     * @var string|null
     *
     * @ODM\Field(nullable=true)
     */
    #[Groups(['dummy', 'dummy_write', 'dummy_qux'])]
    public $qux;

    public function getId(): ?int
    {
        return $this->id;
    }
}
