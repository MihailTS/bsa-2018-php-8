<?php

namespace App\Http\Requests\Contracts;

interface CurrencyRequest
{
    public function getTitle(): ?string;

    public function getShortName(): ?string;

    public function getLogoUrl(): ?string;

    public function getPrice(): ?float;

}
