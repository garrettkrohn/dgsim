<?php

namespace App\Service;

use App\Entity\Archetype;
use App\Repository\ArchetypeRepository;

class ArchetypeService
{
    private ArchetypeRepository $archetypeRepository;

    public function __construct(ArchetypeRepository $archetypeRepository)
    {
        $this->archetypeRepository = $archetypeRepository;
    }


    public function getArchetype(int $archetypeId): ?Archetype
    {
        return $this->archetypeRepository->find($archetypeId);
    }
}