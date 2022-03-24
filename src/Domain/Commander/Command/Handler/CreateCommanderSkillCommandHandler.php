<?php

namespace App\Domain\Commander\Command\Handler;

use App\Common\CQRS\CommandHandlerInterface;
use App\Domain\Commander\Command\Command\CreateCommanderSkillCommand;
use App\Domain\Commander\Exception\CommanderNotFoundException;
use App\Domain\Commander\Exception\SkillAlreadyExistsException;
use App\Entity\Commander\Skill;
use App\Repository\Commander\CommanderRepositoryInterface;
use App\Repository\Commander\SkillRepositoryInterface;

class CreateCommanderSkillCommandHandler implements CommandHandlerInterface
{
    private SkillRepositoryInterface $skillRepository;
    private CommanderRepositoryInterface $commanderRepository;

    public function __construct(SkillRepositoryInterface $skillRepository, CommanderRepositoryInterface $commanderRepository)
    {
        $this->skillRepository = $skillRepository;
        $this->commanderRepository = $commanderRepository;
    }

    public function __invoke(CreateCommanderSkillCommand $command)
    {
        $skill = $this->skillRepository->forCommanderWithName($command->getCommanderId(), $command->getName());
        if ($skill) {
            throw new SkillAlreadyExistsException($command->getName());
        }

        $commander = $this->commanderRepository->findOneById($command->getCommanderId());
        if (! $commander) {
            throw new CommanderNotFoundException($command->getCommanderId());
        }

        $skill = new Skill(
            index: $command->getIndex(),
            name: $command->getName(),
            description: $command->getDescription(),
            upgrades: $command->getUpgrades(),
            type: $command->getType(),
            commander: $commander
        );
        $this->skillRepository->save($skill);
    }
}
