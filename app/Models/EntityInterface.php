<?php

namespace App\Models;

interface EntityInterface
{
    public function getInitiative(): int;
    public function getHitChance(): int;
    public function getDodgeChance(): int;
    public function getBaseDamage(): int;
    public function getCritChance(): int;
    public function getType(): string;
    public function reduceHp(int $hp): void;
    public function isDead(): bool;
}
