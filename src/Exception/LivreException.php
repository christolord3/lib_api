<?php

namespace App\Exception;

use RuntimeException;
use Throwable;

final class LivreException extends RuntimeException
{
	private $errors;

	public function __construct(
		string $message,
		array $errors = [],
		int $code = 404,
		Throwable $previous = null
	){
		parent::__construct($message, $code, $previous);

		$this->errors = $errors;
	}

	public function getErrors(): array
	{
		return $this->errors;
	}
}
