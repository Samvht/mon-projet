<?php

namespace App\Tests\Controller;

use App\Entity\Photo;
use App\Repository\PhotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PhotoControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $photoRepository;
    private string $path = '/photo/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->photoRepository = $this->manager->getRepository(Photo::class);

        foreach ($this->photoRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Photo index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'photo[titre]' => 'Testing',
            'photo[chemin]' => 'Testing',
            'photo[dateCreation]' => 'Testing',
            'photo[restaurant]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->photoRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Photo();
        $fixture->setTitre('My Title');
        $fixture->setChemin('My Title');
        $fixture->setDateCreation('My Title');
        $fixture->setRestaurant('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Photo');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Photo();
        $fixture->setTitre('Value');
        $fixture->setChemin('Value');
        $fixture->setDateCreation('Value');
        $fixture->setRestaurant('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'photo[titre]' => 'Something New',
            'photo[chemin]' => 'Something New',
            'photo[dateCreation]' => 'Something New',
            'photo[restaurant]' => 'Something New',
        ]);

        self::assertResponseRedirects('/photo/');

        $fixture = $this->photoRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitre());
        self::assertSame('Something New', $fixture[0]->getChemin());
        self::assertSame('Something New', $fixture[0]->getDateCreation());
        self::assertSame('Something New', $fixture[0]->getRestaurant());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Photo();
        $fixture->setTitre('Value');
        $fixture->setChemin('Value');
        $fixture->setDateCreation('Value');
        $fixture->setRestaurant('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/photo/');
        self::assertSame(0, $this->photoRepository->count([]));
    }
}
