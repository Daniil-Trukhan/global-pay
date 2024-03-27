<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Controller\Card;

use Daniil\GlobalPay\Component\Card\CardConfirmDto;
use Daniil\GlobalPay\Service\CardConfirmService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

/**
 * Class ConfirmAction
 *
 * @package Daniil\GlobalPay\Controller
 */
#[AsController]
final class ConfirmAction extends AbstractController
{
    /** Confirm card */
    #[Route('/cards/confirm', name: 'cards_confirm', methods: ['POST'])]
    public function __invoke(CardConfirmDto $dto, CardConfirmService $service): Response
    {
        try {
            return new JsonResponse($service($dto, $this->getUser()));
        } catch (Throwable) {
            return new JsonResponse('Code is wrong', Response::HTTP_BAD_REQUEST);
        }
    }
}
