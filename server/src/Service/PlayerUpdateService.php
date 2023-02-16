<?php

namespace App\Service;

use App\Dto\Request\Transformer\PlayerRequestDtoTransformer;
use App\Entity\Player;
use App\Entity\PlayerUpdateLog;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;

class PlayerUpdateService
{
    private PlayerRequestDtoTransformer $playerRequestDtoTransformer;
    private PlayerRepository $playerRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(PlayerRequestDtoTransformer $playerRequestDtoTransformer, PlayerRepository $playerRepository, EntityManagerInterface $entityManager)
    {
        $this->playerRequestDtoTransformer = $playerRequestDtoTransformer;
        $this->playerRepository = $playerRepository;
        $this->entityManager = $entityManager;
    }


    public function updatePlayer($request): Player
    {
        $updatePlayer = $this->playerRequestDtoTransformer->transformFromObject($request);
        $requestObject = json_decode($request->getContent(), true);
        $currentPlayer = $this->playerRepository->findOneBy(array('player_id' => $requestObject['player_id']));
        $playerUpdateLog = $this->playerUpdateLogBuilder($updatePlayer, $currentPlayer);

        $this->entityManager->persist($playerUpdateLog);

        $currentPlayer->setPuttSkill($updatePlayer->getPuttSkill());
        $currentPlayer->setThrowPowerSkill($updatePlayer->getThrowPowerSkill());
        $currentPlayer->setThrowAccuracySkill($updatePlayer->getThrowAccuracySkill());
        $currentPlayer->setScrambleSkill($updatePlayer->getScrambleSkill());
        $this->entityManager->persist($currentPlayer);

        $this->entityManager->flush();

        return $updatePlayer;
    }

    public function playerUpdateLogBuilder(Player $updatePlayer, Player $currentPlayer): PlayerUpdateLog
    {
        $playerUpdateLog = new PlayerUpdateLog();

        $playerUpdateLog->setUpdateTime();
        $playerUpdateLog->setPlayerId($currentPlayer->getPlayerId());
        $playerUpdateLog->setPuttIncrement($updatePlayer->getPuttSkill() - $currentPlayer->getPuttSkill());
        $playerUpdateLog->setThrowPowerIncrement($updatePlayer->getThrowPowerSkill() - $currentPlayer->getThrowPowerSkill());
        $playerUpdateLog->setThrowAccuracyIncrement($updatePlayer->getThrowAccuracySkill() - $currentPlayer->getThrowAccuracySkill());
        $playerUpdateLog->setScrambleIncrement($updatePlayer->getScrambleSkill() - $currentPlayer->getScrambleSkill());
        $playerUpdateLog->setPreviousBank(0);
        $playerUpdateLog->setPostBank(0);

        return $playerUpdateLog;
    }
}