<?php

namespace App\Service;

use App\Dto\Incoming\CreateUserDto;
use App\Dto\Incoming\UpdateAvatarColors;
use App\Dto\Incoming\UpdateUserColors;
use App\Dto\Outgoing\UserResponseDto;
use App\Entity\User;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Exception\InvalidFieldNameException;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Promise\Create;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserService extends AbstractMultiTransformer
{
    private UserRepository $userRepository;
    private EntityManagerInterface $entityManager;
    private RoleService $roleService;

    /**
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $entityManager
     * @param RoleService $roleService
     */
    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager, RoleService $roleService)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->roleService = $roleService;
    }


    public function getAllUsers(): iterable
    {
        $allUsers = $this->userRepository->findAll();
        return $this->transformFromObjects($allUsers);
    }

    public function getUserById(int $id): User
    {
        return $this->userRepository->find($id);
    }

    public function deleteUser(int $id): String {
        $userToDelete = $this->userRepository->find($id);
        $this->entityManager->remove($userToDelete);
        $this->entityManager->flush();
        return "Deleted user with id of: {$id}";
    }

    public function getUserDtoById(int $id): UserResponseDto
    {
        $user = $this->userRepository->find($id);
        return $this->transformFromObject($user);
    }

    public function createNewUser(CreateUserDto $createUserDto): UserResponseDto
    {
        $newUser = new User();
        $newUser->setAuth0($createUserDto->getAuth0());
        $role = $this->roleService->getRole(2);
        $newUser->setRole($role);

        $this->entityManager->persist($newUser);
        $this->entityManager->flush();

        return $this->transformFromObject($newUser);
    }

    public function updateUserColors(UpdateUserColors $updateUserColors): UserResponseDto
    {
        $user = $this->userRepository->findOneBy(['auth0' => $updateUserColors->getAuth0()]);
        $user->setBackgroundColor($updateUserColors->getBackgroundColor());
        $user->setForegroundColor($updateUserColors->getForegroundColor());

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->transformFromObject($user);
    }

    public function updateAvatarColors(UpdateAvatarColors $updateAvatarColors): UserResponseDto
    {
        $user = $this->userRepository->findOneBy(['auth0' => $updateAvatarColors->getAuth0()]);
        $user->setAvatarBackgroundColor($updateAvatarColors->getAvatarBackgroundColor());
        $user->setAvatarTextColor($updateAvatarColors->getAvatarTextColor());

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->transformFromObject($user);
    }


    /**
     * @param User $object
     * @return UserResponseDto
     */
    public function transformFromObject($object): UserResponseDto
    {
        $dto = new UserResponseDto();
        $role = $this->roleService->getRoleDto($object->getRole()->getRoleId());
        $dto->setUserId($object->getUserId());
        $dto->setAuth0($object->getAuth0());
        $dto->setRole($role);
        $dto->setBackgroundColor($object->getBackgroundColor());
        $dto->setForegroundColor($object->getForegroundColor());
        $dto->setAvatarBackgroundColor($object->getAvatarBackgroundColor());
        $dto->setAvatarTextColor($object->getAvatarTextColor());
        return $dto;
    }

    public function getOrCreateUser( CreateUserDto $dto): UserResponseDto
    {
            $user =$this->userRepository->findOneBy(['auth0' => $dto->getAuth0()]);
            if ($user === null) {
                $user = $this->createNewUser($dto);
            }

        return $this->transformFromObject($user);
    }

    public function getUserByAuth0(string $auth0): User
    {
        return $this->userRepository->findOneBy(['auth0' => $auth0]);
    }

}