<?php

namespace App\Dto\Outgoing\Transformer;

use App\Dto\Outgoing\leaderboardDto;
use App\Entity\User;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;

class UserResponseDtoTransformer extends AbstractResponseDtoTransformer
{
    private RoleResponseDtoTransformer $roleResponseDtoTransformer;

    public function __construct(RoleResponseDtoTransformer $roleResponseDtoTransformer)
    {
        $this->roleResponseDtoTransformer = $roleResponseDtoTransformer;
    }
    /**
     * @param User $user
     * @return void
     */
    public function transformFromObject($user): leaderboardDto
    {
        $dto = new leaderboardDto();
        $dto->user_id = $user->getUserId();
        $dto->role = $this->roleResponseDtoTransformer->transformFromObject($user->getRole());
        $dto->username = $user->getUsername();
        $dto->password = $user->getPassword();

        return $dto;
    }

}