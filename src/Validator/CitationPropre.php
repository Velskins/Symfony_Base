<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD)]
final class CitationPropre extends Constraint
{
    public string $message = 'La citation contient un mot interdit : "{{ mot }}".';

    /** @var string[] */
    public array $motsInterdits = ['lol', 'mdr', 'ptdr', 'xd'];

    public function __construct(
        ?array $motsInterdits = null,
        ?string $message = null,
        ?array $groups = null,
        mixed $payload = null,
    ) {
        parent::__construct([], $groups, $payload);

        if (null !== $motsInterdits) {
            $this->motsInterdits = $motsInterdits;
        }
        if (null !== $message) {
            $this->message = $message;
        }
    }
}
