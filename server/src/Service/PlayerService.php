<?php

namespace App\Service;

use App\Dto\Response\FloorCeilingDto;
use App\Dto\Response\PlayerResponseDto;
use App\Dto\Response\Transformer\ArchetypeResponseDtoTransformer;
use App\Dto\Response\Transformer\PlayerResponseDtoTransformer;
use App\Entity\Player;
use App\Repository\PlayerRepository;
use App\Service\Simulation\PlayerIngester;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class PlayerService extends AbstractMultiTransformer
{
    private PlayerRepository $playerRepository;
    private EntityManagerInterface $entityManager;
    private PlayerIngester $playerIngester;
    private ArchetypeResponseDtoTransformer $archetypeResponseDtoTransformer;

    public function __construct(PlayerRepository $playerRepository, EntityManagerInterface $entityManager, PlayerIngester $playerIngester, ArchetypeResponseDtoTransformer $archetypeResponseDtoTransformer)
    {
        $this->playerRepository = $playerRepository;
        $this->entityManager = $entityManager;
        $this->playerIngester = $playerIngester;
        $this->archetypeResponseDtoTransformer = $archetypeResponseDtoTransformer;
    }

    public function getAllPlayers(): iterable
    {
        $allPlayers = $this->playerRepository->findAll();
        return $this->transformFromObjects($allPlayers);
    }

    public function getAllPlayerNames(): array
    {
        $allPlayers = $this->playerRepository->findAll();
        $playerNamesArray = [];
        foreach ($allPlayers as $player) {
            $playerNamesArray[] = ['name' => $player->getFirstName() . " " . $player->getLastName()];
        }
        return $playerNamesArray;
    }

    public function createNewPlayer(Player $playerRequestDto): Response
    {
        $this->entityManager->persist($playerRequestDto);
        $this->entityManager->flush();

        $response = new Response();
        return $response->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function getPlayerById(int $id): PlayerResponseDto
    {
        $player = $this->playerRepository->findOneBy(array('player_id' => $id));
        return $this->transformFromObject($player);
    }

    public function getAllActivePlayerEntities(): iterable
    {
        return $this->playerRepository->findBy(array('active' => true));
    }

    public function getAllActivePlayers(): iterable
    {
        $allPlayers = $this->playerRepository->findBy(array('active' => true));
        return $this->transformFromObjects($allPlayers);
    }

    public function getActivePlayerSimObjects(): iterable
    {
        $allActivePlayers = $this->getAllActivePlayers();
        return $this->getPlayerSimObjects($allActivePlayers);
    }

    public function getPlayerSimObjects($playersArray): iterable
    {
        $FLOOR_CEILING = new FloorCeilingDto();
        $FLOOR_CEILING->c1xFloorCeiling = [0.55, 0.92];
        $FLOOR_CEILING->c2FloorCeiling = [0.01, 0.39];
        $FLOOR_CEILING->parkedFloorCeiling = [0.01, 0.16];
        $FLOOR_CEILING->c1RegFloorCeiling = [0.16, 0.46];
        $FLOOR_CEILING->c2RegFloorCeiling = [0.29, 0.73];
        $FLOOR_CEILING->scrambleFloorCeiling = [0.14, 0.64];

        $allPlayersConverted = array();

        foreach($playersArray as $player) {
            $allPlayersConverted[] = $this->playerIngester->convertPlayer($player,$FLOOR_CEILING);
        }

        return $allPlayersConverted;
    }

    /**
     * @param Player $object
     * @return PlayerResponseDto
     */
    public function transformFromObject($object): PlayerResponseDto
    {
        $dto = new PlayerResponseDto();
        $dto->player_id = $object->getPlayerId();
        $dto->first_name = $object->getFirstName();
        $dto->last_name = $object->getLastName();
        $dto->putt_skill = $object->getPuttSkill();
        $dto->throw_power_skill = $object->getThrowPowerSkill();
        $dto->throw_accuracy_skill = $object->getThrowAccuracySkill();
        $dto->scramble_skill = $object->getScrambleSkill();
        $dto->start_season = $object->getStartSeason();
        $dto->is_active = $object->isIsActive();
        $dto->banked_skill_points = $object->getBankedSkillPoints();
        $dto->archetype = $this->archetypeResponseDtoTransformer->transformFromObject($object->getArchetype());

        return $dto;
    }


}