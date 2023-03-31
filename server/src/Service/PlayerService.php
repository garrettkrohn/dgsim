<?php

namespace App\Service;

use App\Dto\Incoming\CreatePlayerDto;
use App\Dto\Incoming\CreateUserDto;
use App\Dto\Outgoing\FloorCeilingDto;
use App\Dto\Outgoing\PlayerDto;
use App\Entity\Player;
use App\Repository\ArchetypeRepository;
use App\Repository\PlayerRepository;
use App\Service\Simulation\PlayerIngester;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class PlayerService extends AbstractMultiTransformer
{
    private PlayerRepository $playerRepository;
    private EntityManagerInterface $entityManager;
    private PlayerIngester $playerIngester;
    private ArchetypeService $archetypeService;
    private UserService $userService;

    /**
     * @param PlayerRepository $playerRepository
     * @param EntityManagerInterface $entityManager
     * @param PlayerIngester $playerIngester
     * @param ArchetypeService $archetypeService
     * @param UserService $userService
     */
    public function __construct(PlayerRepository $playerRepository, EntityManagerInterface $entityManager, PlayerIngester $playerIngester, ArchetypeService $archetypeService, UserService $userService)
    {
        $this->playerRepository = $playerRepository;
        $this->entityManager = $entityManager;
        $this->playerIngester = $playerIngester;
        $this->archetypeService = $archetypeService;
        $this->userService = $userService;
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

    public function createNewPlayer(CreatePlayerDto $createPlayerDto): ?PlayerDto
    {
        //will eventually need to add a user look up
        $archetype = $this->archetypeService->getArchetype($createPlayerDto->archetypeId);
        if (!$archetype) {
            throw new BadRequestHttpException('Archetype not found');
        }

//        $user = $this->userService->getUserById($createPlayerDto->getAuth0());
        $user = $this->userService->getUserByAuth0($createPlayerDto->getAuth0());

        $player = new Player();
        $player->setArchetype($archetype);
        $player->setFirstName($createPlayerDto->getFirstName());
        $player->setLastName($createPlayerDto->getLastName());
        $player->setPuttSkill($createPlayerDto->getPuttSkill());
        $player->setThrowPowerSkill($createPlayerDto->getThrowPowerSkill());
        $player->setThrowAccuracySkill($createPlayerDto->getThrowAccuracySkill());
        $player->setScrambleSkill($createPlayerDto->getScrambleSkill());
        $player->setStartSeason($createPlayerDto->getStartSeason());
        $player->setActive(true);
        $player->setBankedSkillPoints($createPlayerDto->getBankedSkillPoints());
        $player->setPlayerUser($user);

        $this->entityManager->persist($player);
        $this->entityManager->flush();

        return $this->transformFromObject($player);
    }

    public function getPlayerByIdDto(int $id): PlayerDto
    {
        $player = $this->getPlayer($id);
        return $this->transformFromObject($player);
    }

    public function getPlayer(int $id): Player
    {
        return $this->playerRepository->findOneBy(array('player_id' => $id));
    }

    public function getPlayerByAuth(string $auth0): PlayerDto | null
    {
        $user = $this->userService->getUserByAuth0($auth0);
        $player = $this->playerRepository->findOneBy(['playerUser' => $user, 'active' => true]);

        if (!$player) {
            return null;
        }

        return $this->transformFromObject($player);
    }

    public function getPlayerByAuthPlayer(string $auth0): Player
    {
        $user = $this->userService->getUserByAuth0($auth0);
        return $this->playerRepository->findOneBy(['playerUser' => $user, 'active' => true]);
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

    /**
     * @param PlayerDto[] $playersArray
     * @return iterable
     */
    public function getPlayerSimObjects(iterable $playersArray): iterable
    {
        //saving the original here just in case
//        $FLOOR_CEILING = new FloorCeilingDto();
//        $FLOOR_CEILING->c1xFloorCeiling = [0.55, 0.92];
//        $FLOOR_CEILING->c2FloorCeiling = [0.01, 0.39];
//        $FLOOR_CEILING->parkedFloorCeiling = [0.01, 0.16];
//        $FLOOR_CEILING->c1RegFloorCeiling = [0.16, 0.46];
//        $FLOOR_CEILING->c2RegFloorCeiling = [0.29, 0.73];
//        $FLOOR_CEILING->scrambleFloorCeiling = [0.14, 0.64];

        $FLOOR_CEILING = new FloorCeilingDto();
        $FLOOR_CEILING->c1xFloorCeiling = [0.55, 0.92];
        $FLOOR_CEILING->c2FloorCeiling = [0.01, 0.39];
        $FLOOR_CEILING->parkedFloorCeiling = [0.01, 0.16];
        $FLOOR_CEILING->c1RegFloorCeiling = [0.15, 0.30];
        $FLOOR_CEILING->c2RegFloorCeiling = [0.14, 0.43];
        $FLOOR_CEILING->scrambleFloorCeiling = [0.14, 0.64];

        $allPlayersConverted = [];

        foreach($playersArray as $player) {
            $allPlayersConverted[] = $this->playerIngester->convertPlayer($player,$FLOOR_CEILING);
        }

        return $allPlayersConverted;
    }

    public function replenishBank(): iterable
    {
        /** @var Player[] $players */
        $players = $this->getAllActivePlayerEntities();
        foreach ($players as $player) {
            $player->setBankedSkillPoints($player->getBankedSkillPoints() + 30);
            $this->entityManager->persist($player);
        }
        $this->entityManager->flush();
        return $this->transformFromObjects($players);
    }

    /**
     * @param Player $object
     * @return PlayerDto
     */
    public function transformFromObject($object): PlayerDto
    {
        $dto = new PlayerDto();
        $dto->playerId = $object->getPlayerId();
        $dto->firstName = $object->getFirstName();
        $dto->lastName = $object->getLastName();
        $dto->puttSkill = $object->getPuttSkill();
        $dto->throwPowerSkill = $object->getThrowPowerSkill();
        $dto->throwAccuracySkill = $object->getThrowAccuracySkill();
        $dto->scrambleSkill = $object->getScrambleSkill();
        $dto->startSeason = $object->getStartSeason();
        $dto->isActive = $object->isIsActive();
        $dto->bankedSkillPoints = $object->getBankedSkillPoints();
        $dto->archetype = $this->archetypeService->transformFromObject($object->getArchetype());

        return $dto;
    }


}