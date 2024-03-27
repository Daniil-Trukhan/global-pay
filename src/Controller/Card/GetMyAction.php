<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Controller\Card;

use Daniil\GlobalPay\Repository\CardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Class GetMyAction
 *
 * @package Daniil\GlobalPay\Controller
 */
#[AsController]
final class GetMyAction extends AbstractController
{

    #[Route('/cards/my', name: 'cards_my', methods: ['GET'])]
    public function __invoke(CardRepository $repository, Security $security): JsonResponse
    {
        $user = $security->getUser();
        return $user !== null ?
            new JsonResponse($repository->findMy($security->getUser())) :
            new JsonResponse([]);
    }
}
