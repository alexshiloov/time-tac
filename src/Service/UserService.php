<?php
declare(strict_types=1);

namespace App\Service;


use App\Dto\UserDto;
use App\Filter\UserFilter;

class UserService
{
    /** @var TimeTacClient  */
    private $timeTacClient;

    public function __construct(TimeTacClient $client)
    {
        $this->timeTacClient = $client;
    }

    /**
     * @param UserFilter $filter
     * @return UserDto[]
     * @throws \Exception
     */
    public function getUsers(UserFilter $filter): array
    {
        $users = $this->timeTacClient->getUsers()['Results'];
        $userDtos = array_map(function (array $userItem) {
            return new UserDto($userItem['id'], $userItem['firstname'], $userItem['lastname'], $userItem['active']);
        }, $users);

        if ($filter->isActive() !== null) {
            $userDtos = array_values(array_filter($userDtos, function (UserDto $dto) use ($filter) {
                return $dto->isActive() === $filter->isActive();
            }));
        }

        return $userDtos;
    }
}