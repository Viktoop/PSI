<?php
// Stefan Erakovic 3086/2016
namespace Psi\AppBundle\Serializer\Denormalizer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Psi\AppBundle\Serializer\NameConverter\MatchConverter;
use Psi\AppBundle\Entity\Match;
use Psi\AppBundle\Entity\Team;
use Psi\AppBundle\Entity\RunePage;
use Psi\AppBundle\Entity\MasteryPage;
use Psi\ApiBundle\Response\ActiveGameSpecResponse;
use Psi\AppBundle\Request\Helper;

class ActiveMatchDenormalizer extends AbstractResponseDenormalizer
{

    /**
     *
     * @var ServiceContainer
     */
    protected $serviceContainer;

    public function __construct(ObjectManager $manager, $serviceContainer)
    {
        parent::__construct($manager);
        $this->serviceContainer = $serviceContainer;
    }

    public function denormalizeResponse(\Psi\ApiBundle\Response\AbstractResponse $response)
    {
        $helper = $this->serviceContainer->get("psi.app.request.helper");
        
        $data = $response->getData();

        $normalizer = new ObjectNormalizer(null, new MatchConverter(), null, new ReflectionExtractor());
        $serializer = new Serializer([$normalizer, new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer()]);

        $match = new Match();
        $match->setArchived(0);

        $blueTeam = new Team();
        $redTeam = new Team();

        $match->addTeam($blueTeam);
        $match->addTeam($redTeam);

        $blueTeam->setMatch($match);
        $redTeam->setMatch($match);

        $serializer->denormalize($data, Match::class, 'json', ['object_to_populate' => $match]);

        // update creation date (api returned microtime)
        $timestamp = $match->getCreatedAt() / 1000;
        $gameCreation = new \DateTime();
        $gameCreation->setTimestamp($timestamp);
        $match->setCreatedAt($gameCreation);

        // update participant data , pull summoners runes and masteries if needed
        foreach ($match->getParticipants() as $index => $participant) {

            $summoner = $helper->getSummonerByName($data['participants'][$index]['summonerName']);

            $participant->setMatch($match);
            if ($data['participants'][$index]['teamId'] == 100) {
                $participant->setTeam($blueTeam);
            } else {
                $participant->setTeam($redTeam);
            }

            $summonerName = $data['participants'][$index]['summonerName'];
            $participant->setSummoner($summoner);

            $runesData = $helper->getSummonerRunes($summonerName);
            $masteriesData = $helper->getSummonerMasteries($summonerName);

            $currentRunePage = $this->manager->getRepository(RunePage::class)->findOneBy(['externalId' => $runesData['currentPageId']]);
            $currentMasteryPage = $this->manager->getRepository(MasteryPage::class)->findOneBy(['externalId' => $masteriesData['currentPageId']]);

            $participant->setRunepage($currentRunePage);
            $participant->setMasteryPage($currentMasteryPage);
            
            sleep(2);
        }

        return $match;
    }

    public function getResponseClass()
    {
        return ActiveGameSpecResponse::class;
    }
}
