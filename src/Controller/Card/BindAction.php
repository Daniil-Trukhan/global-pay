<?php
declare(strict_types=1);

namespace Daniil\GlobalPay\Controller\Card;

use Daniil\GlobalPay\Component\Card\CardBindDto;
use Daniil\GlobalPay\Exception\GlobalPayException;
use Daniil\GlobalPay\Service\CardBindService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Class BindAction
 *
 * @package Daniil\GlobalPay\Controller\Card
 */
#[AsController]
final class BindAction extends AbstractController
{
    #[Route('/cards/bind', name: 'cards_bind', methods: ['POST'])]
    public function __invoke(CardBindDto $dto, CardBindService $service): JsonResponse
    {
        try {
            return new JsonResponse($service($dto));
        } catch (GlobalPayException) {
            return new JsonResponse('Something is wrong', Response::HTTP_BAD_REQUEST);
        }
    }
}
