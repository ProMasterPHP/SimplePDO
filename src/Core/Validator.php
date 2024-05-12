<?php
namespace TurgunboyevUz\SPDO\Core;

class Validator
{
    protected $value;
    protected $errors = [];

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function required(): self
    {
        if (empty($this->value)) {
            $this->errors[] = 'required';
        }

        return $this;
    }

    public function string(): self
    {
        if (!is_string($this->value)) {
            $this->errors[] = 'string';
        }

        return $this;
    }

    public function email(): self
    {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'email';
        }

        return $this;
    }

    public function numeric(): self
    {
        if (!is_numeric($this->value)) {
            $this->errors[] = 'numeric';
        }

        return $this;
    }

    public function integer(): self
    {
        if (!filter_var($this->value, FILTER_VALIDATE_INT)) {
            $this->errors[] = 'integer';
        }

        return $this;
    }

    public function boolean(): self
    {
        if (!filter_var($this->value, FILTER_VALIDATE_BOOLEAN)) {
            $this->errors[] = 'boolean';
        }

        return $this;
    }

    public function array(): self
    {
        if (!is_array($this->value)) {
            $this->errors[] = 'array';
        }

        return $this;
    }

    public function date(): self
    {
        if(!strtotime($this->value)) {
            $this->errors[] = 'date';
        }

        return $this;
    }

    public function before($date): self
    {
        if (strtotime($this->value) >= strtotime($date)) {
            $this->errors[] = 'before';
        }

        return $this;
    }

    public function after($date): self
    {
        if (strtotime($this->value) <= strtotime($date)) {
            $this->errors[] = 'after';
        }

        return $this;
    }

    public function min($min): self
    {
        if (strlen($this->value) < $min) {
            $this->errors[] = 'min';
        }

        return $this;
    }

    public function max($max): self
    {
        if (strlen($this->value) > $max) {
            $this->errors[] = 'max';
        }

        return $this;
    }

    public function between($min, $max): self
    {
        if (strlen($this->value) < $min || strlen($this->value) > $max) {
            $this->errors[] = 'between';
        }

        return $this;
    }

    public function regex($regex): self
    {
        if (!preg_match($regex, $this->value)) {
            $this->errors[] = 'regex';
        }

        return $this;
    }

    public function url(): self
    {
        if (!filter_var($this->value, FILTER_VALIDATE_URL)) {
            $this->errors[] = 'url';
        }

        return $this;
    }

    public function in($options): self
    {
        if (!in_array($this->value, $options)) {
            $this->errors[] = 'in';
        }

        return $this;
    }

    public function notIn($options): self
    {
        if (in_array($this->value, $options)) {
            $this->errors[] = 'notIn';
        }

        return $this;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function isValid(): bool
    {
        return empty($this->errors);
    }
}
