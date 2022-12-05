<?php

declare(strict_types=1);

namespace DeployHuman\fortnox\Dataclass\InvoicePayload;

use Exception;

/**
 * Payload for Invoice
 *
 * @documentation https://apps.fortnox.se/apidocs#operation/create_InvoicesResource
 */
class EmailInformation
{
    protected string $EmailAddressFrom;

    protected string $EmailAddressTo;

    protected string $EmailAddressCC;

    protected string $EmailAddressBCC;

    protected string $EmailSubject;

    protected string $EmailBody;

    public function getEmailBody(): string
    {
        return $this->protectedstringEmailBody ?? '';
    }

    public function setEmailBody(string $protectedstringEmailBody): self
    {
        if (mb_strlen($protectedstringEmailBody) > 20000) {
            throw new Exception('EmailBody must be less than 20000 characters');
        }
        $this->protectedstringEmailBody = $protectedstringEmailBody;

        return $this;
    }

    public function getEmailSubject(): string
    {
        return $this->protectedstringEmailSubject ?? '';
    }

    public function setEmailSubject(string $protectedstringEmailSubject): self
    {
        if (mb_strlen($protectedstringEmailSubject) > 100) {
            throw new Exception('EmailSubject must be less than 100 characters');
        }
        $this->protectedstringEmailSubject = $protectedstringEmailSubject;

        return $this;
    }

    public function getEmailAddressBCC(): string
    {
        return $this->protectedstringEmailAddressBCC ?? '';
    }

    public function setEmailAddressBCC(string $protectedstringEmailAddressBCC): self
    {
        $this->protectedstringEmailAddressBCC = $protectedstringEmailAddressBCC;

        return $this;
    }

    public function getEmailAddressCC(): string
    {
        return $this->protectedstringEmailAddressCC ?? '';
    }

    public function setEmailAddressCC(string $protectedstringEmailAddressCC): self
    {
        $this->protectedstringEmailAddressCC = $protectedstringEmailAddressCC;

        return $this;
    }

    public function getEmailAddressTo(): string
    {
        return $this->protectedstringEmailAddressTo ?? '';
    }

    public function setEmailAddressTo(string $protectedstringEmailAddressTo): self
    {
        $this->protectedstringEmailAddressTo = $protectedstringEmailAddressTo;

        return $this;
    }

    public function getEmailAddressFrom(): string
    {
        return $this->protectedstringEmailAddressFrom ?? '';
    }

    public function setEmailAddressFrom(string $protectedstringEmailAddressFrom): self
    {
        $this->protectedstringEmailAddressFrom = $protectedstringEmailAddressFrom;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'EmailAddressFrom' => $this->getEmailAddressFrom(),
            'EmailAddressTo' => $this->getEmailAddressTo(),
            'EmailAddressCC' => $this->getEmailAddressCC(),
            'EmailAddressBCC' => $this->getEmailAddressBCC(),
            'EmailSubject' => $this->getEmailSubject(),
            'EmailBody' => $this->getEmailBody(),
        ];
    }

    public function __toString()
    {
        return json_encode($this->toArray());
    }
}
