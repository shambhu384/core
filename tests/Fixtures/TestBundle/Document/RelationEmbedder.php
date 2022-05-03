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
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Relation Embedder.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 * @ODM\Document
 */
#[ApiResource(operations: [new Get(), new Put(), new Delete(), new Get(routeName: 'relation_embedded.custom_get'), new Get(uriTemplate: '/api/custom-call/{id}'), new Put(uriTemplate: '/api/custom-call/{id}'), new Post(), new GetCollection()], normalizationContext: ['groups' => ['barcelona']], denormalizationContext: ['groups' => ['chicago']], hydraContext: ['@type' => 'hydra:Operation', 'hydra:title' => 'A custom operation', 'returns' => 'xmls:string'])]
class RelationEmbedder
{
    /**
     * @ODM\Id(strategy="INCREMENT", type="int")
     */
    public $id;
    /**
     * @ODM\Field
     */
    #[Groups(['chicago'])]
    public $paris = 'Paris';
    /**
     * @ODM\Field
     */
    #[Groups(['barcelona', 'chicago'])]
    public $krondstadt = 'Krondstadt';
    /**
     * @ODM\ReferenceOne(targetDocument=RelatedDummy::class, cascade={"persist"})
     */
    #[Groups(['chicago', 'barcelona'])]
    public $anotherRelated;
    /**
     * @ODM\ReferenceOne(targetDocument=RelatedDummy::class)
     */
    #[Groups(['barcelona', 'chicago'])]
    protected $related;

    public function getRelated()
    {
        return $this->related;
    }

    public function setRelated(RelatedDummy $relatedDummy)
    {
        $this->related = $relatedDummy;
    }
}
