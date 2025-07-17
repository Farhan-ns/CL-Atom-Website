<?php

namespace App\DTO;

class ContentTemplate
{
    public string $sid;
    public string $friendlyName;
    public array $types;
    public array $languages;
    public string $dateCreated;
    public ?string $body; 
    public ?array $variables; 

    public function __construct(array $attributes)
    {
        $this->sid = $attributes['sid'];
        $this->friendlyName = $attributes['friendlyName'];
        $this->types = $attributes['types'];
        $this->languages = $attributes['languages'];
        $this->dateCreated = $attributes['dateCreated'];
        $this->body = $attributes['body'] ?? null;
        $this->variables = $attributes['variables'] ?? null;
    }

    public static function fromTwilio($twilioObject): self
    {
        return new self([
            'sid' => $twilioObject->sid,
            'friendlyName' => $twilioObject->friendlyName,
            'types' => $twilioObject->types,
            'languages' => $twilioObject->languages,
            'dateCreated' => $twilioObject->dateCreated->format('Y-m-d H:i:s'),
            'body' => $twilioObject->body ?? null, 
            'variables' => $twilioObject->variables ?? null,
        ]);
    }

    public function toArray(): array
    {
        return [
            'sid' => $this->sid,
            'friendlyName' => $this->friendlyName,
            'types' => $this->types,
            'languages' => $this->languages,
            'dateCreated' => $this->dateCreated,
        ];
    }
}
