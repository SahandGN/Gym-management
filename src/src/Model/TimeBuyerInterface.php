<?php

namespace App\Model;

interface TimeBuyerInterface
{
    public function getShoppedAt(): \DateTimeImmutable;
    public function setShoppedAt(\DateTimeImmutable $shoppedAt): self;

}