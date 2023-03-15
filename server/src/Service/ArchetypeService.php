<?php

namespace App\Service;

use App\Dto\Outgoing\ArchetypeResponseDto;
use App\Entity\Archetype;
use App\Repository\ArchetypeRepository;

class ArchetypeService extends AbstractMultiTransformer
{
    private ArchetypeRepository $archetypeRepository;

    public function __construct(ArchetypeRepository $archetypeRepository)
    {
        $this->archetypeRepository = $archetypeRepository;
    }

    public function getAllArchetypes(): iterable
    {
        $allArchetypes = $this->archetypeRepository->findAll();
        return $this->transformFromObjects($allArchetypes);
    }

    public function getArchetype(int $archetypeId): ?Archetype
    {
        return $this->archetypeRepository->find($archetypeId);
    }

    /**
     * @param Archetype $object
     * @return ArchetypeResponseDto
     */
    public function transformFromObject($object): ArchetypeResponseDto
    {
        $dto = new ArchetypeResponseDto();
        $dto->setArchetypeId($object->getArchetypeId());
        $dto->setName($object->getName());
        $dto->setMinPuttSkill($object->getMinPuttSkill());
        $dto->setMinThrowPowerSkill($object->getMinThrowPowerSkill());
        $dto->setMinThrowAccuracySkill($object->getMinThrowAccuracySkill());
        $dto->setMinScrambleSkill($object->getMinScrambleSkill());
        $dto->setMaxPuttSkill($object->getMaxPuttSkill());
        $dto->setMaxThrowPowerSkill($object->getMaxThrowPowerSkill());
        $dto->setMaxThrowAccuracySkill($object->getMaxThrowAccuracySkill());
        $dto->setMaxScrambleSkill($object->getMaxScrambleSkill());

        return $dto;
    }

}