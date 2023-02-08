<?php

namespace App\Dto\Request\Transformer;

use App\Entity\Player;
use App\Repository\ArchetypeRepository;
use Symfony\Component\HttpFoundation\Request;

class PlayerRequestDtoTransformer extends AbstractRequestDtoTransformer
{
    private ArchetypeRepository $archetypeRepository;

    public function __construct(ArchetypeRepository $archetypeRepository)
    {
        $this->archetypeRepository = $archetypeRepository;
    }


    public function transformFromObject($object): Player
    {
        $request = json_decode($object->getContent(), true);
        $newPlayer = new Player();
        $arch = $this->archetypeRepository->findOneBy(array('name' => $request['archetypeName']));
        $newPlayer->setArchetype($arch);
        $newPlayer->setFirstName($request['firstName']);
        $newPlayer->setLastName($request['lastName']);
        $newPlayer->setPuttSkill($request['puttSkill']);
        $newPlayer->setThrowPowerSkill($request['throwPowerSkill']);
        $newPlayer->setThrowAccuracySkill($request['throwAccuracySkill']);
        $newPlayer->setScrambleSkill($request['scrambleSkill']);
        $newPlayer->setStartSeason($request['startSeason']);
        $newPlayer->setActive(true);
        $newPlayer->setBankedSkillPoints(0);

        return $newPlayer;
    }
}