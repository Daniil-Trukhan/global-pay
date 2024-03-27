<?php

declare(strict_types=1);

namespace Daniil\GlobalPay\Action\Auth;

/**
 * Class AuthResponse
 *
 * @package Daniil\GlobalPay\Action\Auth
 */
final readonly class AuthResponse
{
    /** Авторизационный токен */
    private string $accessToken;
    /** Срок «жизни» токена авторизации в секундах */
    private int $expiresIn;
    /** Идентификатор токена */
    private string $idToken;
    /** Параметр, определяющий политику not-before */
    private bool $notBeforePolicy;
    /** Срок «жизни» токена обновления в секундах */
    private int $refreshExpiresIn;
    /** Токен обновления - специальный токен, который используется для получения дополнительных токенов доступа. */
    private string $refreshToken;
    /** «Скоуп» */
    private string $scope;
    /** Идентификатор сессии */
    private string $sessionState;
    /** Тип токена (Bearer по умолчанию) */
    private string $tokenType;

    public function __construct(public array $data)
    {
        $this->accessToken = (string)$data['access_token'];
        $this->expiresIn = (int)$data['expires_in'];
        $this->refreshExpiresIn = (int)$data['refresh_expires_in'];
        $this->refreshToken = (string)$data['refresh_token'];
        $this->tokenType = (string)$data['token_type'];
        $this->idToken = (string)$data['id_token'];
        $this->notBeforePolicy = (bool)$data['not-before-policy'];
        $this->sessionState = (string)$data['session_state'];
        $this->scope = (string)$data['scope'];
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    public function getIdToken(): string
    {
        return $this->idToken;
    }

    public function getRefreshExpiresIn(): int
    {
        return $this->refreshExpiresIn;
    }

    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    public function getScope(): string
    {
        return $this->scope;
    }

    public function getSessionState(): string
    {
        return $this->sessionState;
    }

    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    public function isNotBeforePolicy(): bool
    {
        return $this->notBeforePolicy;
    }
}
