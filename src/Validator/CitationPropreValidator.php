<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;


final class CitationPropreValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof CitationPropre) {
            throw new UnexpectedTypeException($constraint, CitationPropre::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!\is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        $texte = mb_strtolower($value);

        foreach ($constraint->motsInterdits as $mot) {
            $motif = '/\b'.preg_quote(mb_strtolower($mot), '/').'\b/u';

            if (preg_match($motif, $texte)) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ mot }}', $mot)
                    ->addViolation();

                return;
            }
        }
    }
}
