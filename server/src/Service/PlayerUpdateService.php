<?php

namespace App\Service;

use App\Dto\Incoming\UpdatePlayerDto;
use App\Dto\Outgoing\PlayerDto;
use App\Dto\Outgoing\PlayerUpdateLogResponseDto;
use App\Entity\Player;
use App\Entity\PlayerUpdateLog;
use App\Repository\PlayerRepository;
use App\Repository\PlayerUpdateLogsRepository;
use App\Service\Simulation\PlayerIngester;
use Doctrine\ORM\EntityManagerInterface;

class PlayerUpdateService extends PlayerService
{
    private PlayerRepository $playerRepository;
    private EntityManagerInterface $entityManager;
    private PlayerUpdateLogsRepository $playerUpdateLogsRepository;
    private PlayerIngester $playerIngester;
    private ArchetypeService $archetypeService;
    private UserService $userService;


    /**
     * @param PlayerRepository $playerRepository
     * @param EntityManagerInterface $entityManager
     * @param PlayerUpdateLogsRepository $playerUpdateLogsRepository
     * @param PlayerIngester $playerIngester
     * @param ArchetypeService $archetypeService
     * @param UserService $userService
     */
    public function __construct(PlayerRepository $playerRepository, EntityManagerInterface $entityManager, PlayerUpdateLogsRepository $playerUpdateLogsRepository, PlayerIngester $playerIngester, ArchetypeService $archetypeService, UserService $userService)
    {
        $this->playerRepository = $playerRepository;
        $this->entityManager = $entityManager;
        $this->playerUpdateLogsRepository = $playerUpdateLogsRepository;
        $this->playerIngester = $playerIngester;
        $this->archetypeService = $archetypeService;
        parent::__construct($playerRepository, $entityManager, $playerIngester, $archetypeService, $userService);

    }


    public function updatePlayer(UpdatePlayerDto $playerUpdateDto): PlayerDto
    {
        $updatedPlayer = $this->playerRepository->find($playerUpdateDto->getPlayerId());
        $playerUpdateLog = $this->playerUpdateLogBuilder($playerUpdateDto, $updatedPlayer);

        $this->entityManager->persist($playerUpdateLog);

        $updatedPlayer->setPuttSkill($playerUpdateDto->getPuttSkill());
        $updatedPlayer->setThrowPowerSkill($playerUpdateDto->getThrowPowerSkill());
        $updatedPlayer->setThrowAccuracySkill($playerUpdateDto->getThrowAccuracySkill());
        $updatedPlayer->setScrambleSkill($playerUpdateDto->getScrambleSkill());

        $this->entityManager->persist($updatedPlayer);
        $this->entityManager->flush();

        return $this->transformFromObject($updatedPlayer);
    }

    public function playerUpdateLogBuilder(UpdatePlayerDto $updatePlayer, Player $currentPlayer): PlayerUpdateLog
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

    public function getAllUpdatesByPlayerId(int $id): iterable
    {
        $playerUpdateLogs = $this->playerUpdateLogsRepository->findBy(['player_id' => $id]);
        return $this->transformFromUpdate($playerUpdateLogs);
    }

    /**
     * @param PlayerUpdateLog[] $playerUpdateLogs
     * @return iterable
     */
    public function transformFromUpdate(iterable $playerUpdateLogs): iterable
    {
        $updateLogs = [];
        foreach ($playerUpdateLogs as $playerUpdate) {
            $dto = new PlayerUpdateLogResponseDto();
            $dto->player_update_log_id = $playerUpdate->getPlayerupdatelogId();
            $dto->update_time = $playerUpdate->getUpdateTime();
            $dto->putt_increment = $playerUpdate->getPuttIncrement();
            $dto->throw_power_increment = $playerUpdate->getThrowPowerIncrement();
            $dto->throw_accuracy_increment = $playerUpdate->getThrowAccuracyIncrement();
            $dto->scramble_increment = $playerUpdate->getScrambleIncrement();
            $dto->previous_bank = $playerUpdate->getPreviousBank();
            $dto->post_bank = $playerUpdate->getPostBank();
            $updateLogs[] = $dto;
        }
        return $updateLogs;
    }

}