<?php

namespace DeployHuman\fortnox;

use DateInterval;
use DateTime;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Monolog\ErrorHandler;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Registry;

class Configuration
{
    protected string $Client_id = '';
    protected string $Client_secret = '';
    protected string $AppID = '';
    protected string $BaseUrl = 'https://apps.fortnox.se';
    protected string $userAgent = 'DeployHuman/fortnox-PHP-Client/1.0.0';
    protected string $tempFolderPath;
    protected string $storage_Default_name = 'fortnox_auth';
    protected string $storage_name;
    protected array $storage;
    protected bool $debug = false;
    protected logger $logstack;
    protected string $logpath = __DIR__ . '/../log/';
    protected bool $Storage_Is_Session = false;

    public function __construct(bool $StorageInSession = true)
    {
        $this->setStorageIsSession($StorageInSession);
        $this->tempFolderPath = sys_get_temp_dir();
    }

    private function setGlobalLogger(Logger $logger = null)
    {
        if ($logger == null) {
            $logger = new Logger(__CLASS__);
            $logger->pushHandler(new StreamHandler($this->getLogPath() . DIRECTORY_SEPARATOR . 'api.log', Logger::DEBUG));
            $logger->pushHandler(new FirePHPHandler());
        }
        $this->logstack = $logger;
        Registry::addLogger($logger, __CLASS__, true);
        ErrorHandler::register($logger);
    }


    public function getLogger(): Logger
    {
        if (!isset($this->logstack)) $this->setGlobalLogger();
        return $this->logstack;
    }

    public function setLogger(Logger $logstack): self
    {
        $this->logstack = $logstack;
        $this->setGlobalLogger($logstack);
        return $this;
    }



    public function getDebugHandler(): HandlerStack
    {
        $stack = HandlerStack::create();
        $stack->push(
            Middleware::log(
                $this->logstack,
                new MessageFormatter('{uri} - {code} -  request Headers: {req_headers} - Response Headers {res_headers}')
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
        if (empty($this->Client_id) || empty($this->Client_secret) || empty($this->BaseUrl) || empty($this->AppID) || empty($this->getRefresh_token())) {
            $this->getLogger()->debug("Client Auth not set, please set Client_id, Client_secret, BaseUrl, AppID and refresh_token");
            return false;
        }
        return true;
    }


    public function setAllTokens(array $authBody): self
    {
        if (!isset($authBody['expires_in'])) $authBody['expires_in'] = 0;
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

    public function hasScope(string $Scope): bool
    {
        return true;
        //Todo Fix this using regex or something
        $scopeMethod = substr($Scope, 0, strpos($Scope, ':'));
        $fromright = substr($Scope, strpos($Scope, ':'), strlen($Scope) - strpos($Scope, ':') -  strpos(strrev($Scope), '.'));
        $scopeUri = substr($Scope, strpos($Scope, ':') + 1,);

        $scopeArray = explode(" ", $this->getStorage()['scope']);
        foreach ($scopeArray as $key => $value) {
            $pos = strpos($value, ':');
            if ($pos === false) {
                //no : found
                if ($value == $Scope) {
                    return true;
                }
            } else {
                //: found
                $scope = substr($value, 0, $pos);
                if ($scope == $Scope) {
                    return true;
                }
            }
        }
        if (in_array($Scope, $scopeArray)) {
            return true;
        }
        return false;
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

    protected function basicTokenCheck(string $ScopeNeeded = null): bool|Exception
    {
        if (!$this->isClientAuthSet()) {
            throw new Exception("Error in Fortnox Settings");
        }
        if ($ScopeNeeded != null && !$this->hasScope($ScopeNeeded)) {
            throw new Exception("Error in fetching Access Token for basic APi CALL on Fortnox");
        }
        return true;
    }

    public function resetAccesToken()
    {
        $this->unsetFromStorage(['access_token', 'expires_at', 'scope', 'token_type', 'expires_in']);
    }
}
