<?php

namespace DeployHuman\fortnox;

use DateInterval;
use DateTime;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Configuration
{
    protected string $Client_id = '';
    protected string $Client_secret = '';
    protected string $AppID = '';
    protected string $BaseUrl = 'https://apps.fortnox.se';
    protected string $userAgent = 'DeployHuman/fortnox-PHP-Client/1.0.0';
    protected string $storage_Default_name = 'fortnox_auth';
    protected string $storage_name = 'fortnox_auth';
    protected array $storage;
    protected bool $debug = false;
    protected logger $logstack;
    protected string $logpath = __DIR__ . '/../log/';
    protected bool $Storage_Is_Session = false;

    public function __construct(bool $StorageInSession = true)
    {
        $this->setStorageIsSession($StorageInSession);
    }

    /**
     * Making sure there is a Logger set.
     *
     * @return void
     */
    private function checkLogstack(): void
    {
        if (empty($this->logstack)) {
            $logger = new Logger(__CLASS__);
            $logger->pushHandler(new StreamHandler($this->getLogPath() . DIRECTORY_SEPARATOR . 'api.log', Logger::DEBUG));
            $this->logstack = $logger;
        }
    }

    public function getLogger(): Logger
    {
        $this->checkLogstack();
        return $this->logstack;
    }

    public function setLogger(Logger $logstack): self
    {
        $this->logstack = $logstack;
        return $this;
    }

    public function getDebugHandler(): ?HandlerStack
    {
        $level = $this->getDebug() ? Logger::DEBUG : Logger::WARNING;
        $stack = HandlerStack::create();
        $stack->push(
            Middleware::log(
                $this->getLogger(),
                new MessageFormatter('{code}:{method}:{uri}-"{req_body}"'),
                $level
            )
        );
        return $stack;
    }

    public function setLogPath(string $path): self
    {
        $this->logpath = $path;
        return $this;
    }

    public function getLogPath(): string
    {
        if (!realpath($this->logpath)) {
            mkdir($this->logpath);
        }

        return realpath($this->logpath);
    }

    public function setClient_secret(string $Client_secret): self
    {
        $this->Client_secret = $Client_secret;
        return $this;
    }

    public function getClient_secret(): string
    {
        return $this->Client_secret;
    }

    public function SetBaseUrl(string $BaseUrl): self
    {
        $this->BaseUrl = $BaseUrl;
        return $this;
    }

    public function getBaseUrl(): string
    {
        return $this->BaseUrl ?? '';
    }

    public function setUserAgent(string $userAgent): self
    {
        $this->userAgent = $userAgent ?? $this->userAgent;
        return $this;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function setDebug(bool $debug): self
    {
        $this->debug = $debug;
        return $this;
    }

    public function getDebug(): bool
    {
        return $this->debug ?? false;
    }


    /**
     * Important, this is predefined values you get from Fortnox directly, and is the Sites login, to request login for the user that you serve.
     * Not to be confused with the Client_id, which is the login you use to connect to the API, named AppID here in this SDK.
     * 
     * @param string $Client_id
     * @return self
     */
    public function setClient_id(string $Client_id): self
    {
        $this->Client_id = $Client_id ?? '';
        return $this;
    }

    /**
     * Important, this is predefined values you get from Fortnox directly, and is the Sites login, to request login for the user that you serve.
     * Not to be confused with the Client_id, which is the login you use to connect to the API, named AppID here in this SDK.
     * 
     * @return string 
     */
    public function getClient_id(): string
    {
        return $this->Client_id;
    }

    /**
     * As this token lasts 31 days you should have saved it from Fortnox, and then set in here next time you use the SDK.
     *
     * @param string $refresh_token
     * @return self
     */
    public function setRefresh_token(string $refresh_token): self
    {
        $this->saveToStorage(["refresh_token" => $refresh_token]);
        return $this;
    }

    public function getRefresh_token(): string
    {
        return $this->getStorage()["refresh_token"] ?? '';
    }

    /**
     * Which is documented as "client_id" in the Fortnox API documentation but there is two different, and this one is for which public app you are connecting to.
     *
     * @param string $AppID
     * @return self
     */
    public function setAppID(string $AppID): self
    {
        $this->AppID = $AppID ?? '';
        return $this;
    }

    public function getAppID(): string
    {
        return $this->AppID;
    }

    public function setStorageName(string $ArrayName = null): self
    {
        $this->storage_name = $ArrayName ?? $this->storage_Default_name;
        return $this;
    }

    public function saveToStorage(array $asocArray): self
    {
        $this->initateStorage();
        if ($this->getStorageIsSession()) {
            $_SESSION[$this->storage_name] = array_merge($_SESSION[$this->storage_name], $asocArray);
        } else {
            $this->storage[$this->storage_name] = array_merge($this->storage[$this->storage_name], $asocArray);
        }
        return $this;
    }

    public function unsetFromStorage(array $UnsetKeys): self
    {
        foreach ($UnsetKeys as $key) {
            if ($this->getStorageIsSession()) {
                unset($_SESSION[$this->storage_name][$key]);
            } else {
                unset($this->storage[$this->storage_name][$key]);
            }
        }
        return $this;
    }

    public function getStorageName(): string
    {
        return $this->storage_name;
    }

    public function getStorage(): array
    {
        $this->initateStorage();
        if ($this->getStorageIsSession()) {
            return $_SESSION[$this->storage_name] ?? [];
        }

        return $this->storage[$this->storage_name] ?? [];
    }

    public function getStorageIsSession(): bool
    {
        return $this->Storage_Is_Session ?? false;
    }

    public function setStorageIsSession(bool $UseSession = true): self
    {
        $this->Storage_Is_Session = $UseSession;
        return $this;
    }

    public function initateStorage(): bool
    {
        if (!isset($this->storage_name)) $this->storage_name = $this->storage_Default_name;

        if ($this->getStorageIsSession()) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION[$this->storage_name])) {
                $_SESSION[$this->storage_name] = [];
            }
            return true;
        }

        if (!$this->getStorageIsSession()) {
            if (!isset($this->storage[$this->storage_name])) {
                $this->storage[$this->storage_name] = [];
            }
            return true;
        }

        return false;
    }

    public function isClientAuthSet(): bool
    {
        if (empty($this->Client_id) || empty($this->Client_secret) || empty($this->BaseUrl) || empty($this->AppID)) {
            $this->getLogger()->debug("Client Auth not set, please set Client_id, Client_secret, BaseUrl and  AppID");
            return false;
        }
        return true;
    }


    public function setAllTokens(array $authBody): self
    {
        if (!isset($authBody['expires_in'])) $authBody['expires_in'] = 3600;
        $this->saveToStorage(
            [
                'expires_in' => $authBody['expires_in'],
                'access_token' => $authBody['access_token'] ?? '',
                'refresh_token' => $authBody['refresh_token'] ?? '',
                'scope' => $authBody['scope'] ?? '',
                'token_type' => $authBody['token_type'] ?? 'bearer',
                'expires_at' => (isset($authBody['expires_at']) ? (new DateTime($authBody['expires_at'])) : (new DateTime())->add(new DateInterval('PT' . $authBody['expires_in'] . 'S'))),
            ]
        );
        $this->setStorageExtraParams();
        return $this;
    }


    private function setStorageExtraParams()
    {
        $this->saveToStorage(
            [
                'baseurl' => $this->getBaseUrl(),
                'debug' => $this->getDebug()
            ]
        );
    }

    public function isTokenValid(): bool
    {
        if ($this->isSameBaseUrl() && !$this->isTokenExpired()) {
            return true;
        }
        return false;
    }

    protected function isTokenExpired(): bool
    {
        $auth = $this->getStorage();
        if (isset($auth['expires_at'])) {
            return $auth['expires_at'] <= (new DateTime());
        }
        return true;
    }

    protected function isSameBaseUrl(): bool
    {
        $auth = $this->getStorage();
        if (isset($auth['baseurl'])) {
            return $auth['baseurl'] === $this->getBaseUrl();
        }
        return false;
    }

    public function resetAccesToken()
    {
        $this->unsetFromStorage(['access_token', 'expires_at', 'scope', 'token_type', 'expires_in']);
    }

    public function resetAllTokens()
    {
        $this->unsetFromStorage(['refresh_token', 'access_token', 'expires_at', 'scope', 'token_type', 'expires_in']);
    }
}
