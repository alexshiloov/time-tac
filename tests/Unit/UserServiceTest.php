<?php
declare(strict_types=1);

namespace App\Tests\Unit;


use App\Filter\UserFilter;
use App\Service\TimeTacClient;
use App\Service\UserService;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testGetUsers(TimeTacClient $client): void
    {
        $filter = (new UserFilter())
            ->setActive(true)
        ;

        $userDtos = (new UserService($client))
            ->getUsers($filter)
        ;

        $this->assertCount(2, $userDtos);
        foreach ($userDtos as $dto) {
            $this->assertTrue($dto->isActive());
            $this->assertNotEmpty($dto->getId());
            $this->assertNotEmpty($dto->getFirstName());
            $this->assertNotEmpty($dto->getLastName());
        }
    }

    public function dataProvider(): iterable
    {
        $timeTacClientMock = $this->createMock(TimeTacClient::class);
        $timeTacClientMock
            ->expects(self::once())
            ->method('getUsers')
            ->willReturn([
                'Success' => true,
                'Results' => [[
                    'id' => 1,
                    'firstname' => 'alex',
                    'lastname' => 'alex',
                    'active' => true,
                ],  [
                    'id' => 2,
                    'firstname' => 'alex1',
                    'lastname' => 'alex2',
                    'active' => false,
                ],  [
                    'id' => 3,
                    'firstname' => 'alex2',
                    'lastname' => 'alex3',
                    'active' => true,
                ]]
            ])
        ;

        return [
            [
                $timeTacClientMock,
            ]
        ];
    }
}