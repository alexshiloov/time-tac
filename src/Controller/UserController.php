<?php
declare(strict_types=1);

namespace App\Controller;


use App\Filter\UserFilter;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return Response
     */
    public function index(): Response
    {
        $filter = (new UserFilter())
            ->setActive(true)
        ;

        return $this->render('user.html.twig', [
            'users' => $this->userService->getUsers($filter),
        ]);
    }
}