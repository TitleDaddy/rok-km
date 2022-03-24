<?php

namespace App\DataFixtures;

use App\Common\CQRS\CommandBusInterface;
use App\Common\CQRS\QueryBusInterface;
use App\Domain\Commander\Command\Command\CreateCommanderCommand;
use App\Domain\Commander\Command\Command\CreateCommanderSkillCommand;
use App\Domain\Commander\Command\Command\CreateCommanderTalentTreeFromUrlCommand;
use App\Domain\Commander\Command\Command\UpdateCommanderCommand;
use App\Domain\Commander\Enum\CommanderObtainableFrom;
use App\Domain\Commander\Enum\CommanderRarity;
use App\Domain\Commander\Enum\CommanderSkillType;
use App\Domain\Commander\Query\Query\FindCommanderByNameQuery;
use App\Domain\Commander\Query\Query\FindCommanderSkillByNameQuery;
use App\Domain\Commander\Query\Query\FindCommanderTalentTreeByNameQuery;
use App\Entity\Commander\Commander;
use Doctrine\Persistence\ObjectManager;

class CommanderFixtures extends JSONDrivenDataFixture
{
    private CommandBusInterface $commandBus;
    private QueryBusInterface $queryBus;

    public function __construct(CommandBusInterface $commandBus, QueryBusInterface $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    public function load(ObjectManager $manager)
    {
        $commanders = $this->readAllFixtureFilesForType('commander');
        foreach ($commanders as $commanderData) {
            $commander = $this->processCommander($commanderData);
            $this->processCommanderSkills($commander, $commanderData);
            $this->processCommanderTalentTrees($commander, $commanderData);
        }
    }

    private function processCommander(array $data): Commander
    {
        /** @var ?Commander $obj */
        $obj = $this->queryBus->handle(new FindCommanderByNameQuery($data['name']));
        if (! $obj) {
            $this->commandBus->dispatch(new CreateCommanderCommand(
                name: $data['name'],
                features: $data['features'],
                rarity: CommanderRarity::tryFrom($data['rarity']),
                obtainableFrom: CommanderObtainableFrom::tryFrom($data['obtained_from']),
                kingdomAge: $data['kingdom_age']
            ));
        } else {
            $this->commandBus->dispatch(new UpdateCommanderCommand(
                name: $data['name'],
                features: $data['features'],
                rarity: CommanderRarity::tryFrom($data['rarity']),
                obtainableFrom: CommanderObtainableFrom::tryFrom($data['obtained_from']),
                kingdomAge: $data['kingdom_age']
            ));
        }

        return $this->queryBus->handle(new FindCommanderByNameQuery($data['name']));
    }

    private function processCommanderSkills(Commander $commander, array $data): void
    {
        if (! array_key_exists('skills', $data)) {
            return;
        }
        foreach ($data['skills'] as $skillData) {
            $skill = $this->queryBus->handle(new FindCommanderSkillByNameQuery($commander->getId(), $skillData['name']));
            if (! $skill) {
                $this->commandBus->dispatch(new CreateCommanderSkillCommand(
                    index: $skillData['index'],
                    name: $skillData['name'],
                    description: $skillData['description'],
                    upgrades: $skillData['upgrades'],
                    type: CommanderSkillType::tryFrom($skillData['type']),
                    commanderId: $commander->getId(),
                ));
            }
        }
    }

    private function processCommanderTalentTrees(Commander $commander, array $data): void
    {
        if (! array_key_exists('talent_trees', $data)) {
            return;
        }

        foreach ($data['talent_trees'] as $name => $url) {
            $talentTree = $this->queryBus->handle(new FindCommanderTalentTreeByNameQuery($commander->getId(), $name));
            if (! $talentTree) {
                $this->commandBus->dispatch(new CreateCommanderTalentTreeFromUrlCommand(
                    name: $name,
                    url: $url,
                    commanderId: $commander->getId(),
                ));
            }
        }
    }
}
