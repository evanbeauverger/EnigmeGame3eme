<?php

namespace App\Tests\Controller;

use App\Entity\Enigma;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class EnigmaControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $enigmaRepository;
    private string $path = '/enigma/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->enigmaRepository = $this->manager->getRepository(Enigma::class);

        foreach ($this->enigmaRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Enigma index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first()->text());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'enigma[order_]' => 'Testing',
            'enigma[title]' => 'Testing',
            'enigma[instruction]' => 'Testing',
            'enigma[secretcode]' => 'Testing',
            'enigma[type]' => 'Testing',
            'enigma[thumbnail]' => 'Testing',
            'enigma[user]' => 'Testing',
            'enigma[game]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->enigmaRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Enigma();
        $fixture->setOrder_('My Title');
        $fixture->setTitle('My Title');
        $fixture->setInstruction('My Title');
        $fixture->setSecretcode('My Title');
        $fixture->setType('My Title');
        $fixture->setThumbnail('My Title');
        $fixture->setUser('My Title');
        $fixture->setGame('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Enigma');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Enigma();
        $fixture->setOrder_('Value');
        $fixture->setTitle('Value');
        $fixture->setInstruction('Value');
        $fixture->setSecretcode('Value');
        $fixture->setType('Value');
        $fixture->setThumbnail('Value');
        $fixture->setUser('Value');
        $fixture->setGame('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'enigma[order_]' => 'Something New',
            'enigma[title]' => 'Something New',
            'enigma[instruction]' => 'Something New',
            'enigma[secretcode]' => 'Something New',
            'enigma[type]' => 'Something New',
            'enigma[thumbnail]' => 'Something New',
            'enigma[user]' => 'Something New',
            'enigma[game]' => 'Something New',
        ]);

        self::assertResponseRedirects('/enigma/');

        $fixture = $this->enigmaRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getOrder_());
        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getInstruction());
        self::assertSame('Something New', $fixture[0]->getSecretcode());
        self::assertSame('Something New', $fixture[0]->getType());
        self::assertSame('Something New', $fixture[0]->getThumbnail());
        self::assertSame('Something New', $fixture[0]->getUser());
        self::assertSame('Something New', $fixture[0]->getGame());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Enigma();
        $fixture->setOrder_('Value');
        $fixture->setTitle('Value');
        $fixture->setInstruction('Value');
        $fixture->setSecretcode('Value');
        $fixture->setType('Value');
        $fixture->setThumbnail('Value');
        $fixture->setUser('Value');
        $fixture->setGame('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/enigma/');
        self::assertSame(0, $this->enigmaRepository->count([]));
    }
}
