<?php

namespace App\Tests\Controller;

use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class TeamControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $teamRepository;
    private string $path = '/team/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->teamRepository = $this->manager->getRepository(Team::class);

        foreach ($this->teamRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Team index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'team[name]' => 'Testing',
            'team[position]' => 'Testing',
            'team[current_enigma]' => 'Testing',
            'team[note]' => 'Testing',
            'team[avatar]' => 'Testing',
            'team[game]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->teamRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Team();
        $fixture->setName('My Title');
        $fixture->setPosition('My Title');
        $fixture->setCurrent_enigma('My Title');
        $fixture->setNote('My Title');
        $fixture->setAvatar('My Title');
        $fixture->setGame('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Team');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Team();
        $fixture->setName('Value');
        $fixture->setPosition('Value');
        $fixture->setCurrent_enigma('Value');
        $fixture->setNote('Value');
        $fixture->setAvatar('Value');
        $fixture->setGame('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'team[name]' => 'Something New',
            'team[position]' => 'Something New',
            'team[current_enigma]' => 'Something New',
            'team[note]' => 'Something New',
            'team[avatar]' => 'Something New',
            'team[game]' => 'Something New',
        ]);

        self::assertResponseRedirects('/team/');

        $fixture = $this->teamRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getPosition());
        self::assertSame('Something New', $fixture[0]->getCurrent_enigma());
        self::assertSame('Something New', $fixture[0]->getNote());
        self::assertSame('Something New', $fixture[0]->getAvatar());
        self::assertSame('Something New', $fixture[0]->getGame());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Team();
        $fixture->setName('Value');
        $fixture->setPosition('Value');
        $fixture->setCurrent_enigma('Value');
        $fixture->setNote('Value');
        $fixture->setAvatar('Value');
        $fixture->setGame('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/team/');
        self::assertSame(0, $this->teamRepository->count([]));
    }
}
