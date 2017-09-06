<?php

namespace Champ\Championship\Mail;

use Champ\Championship\Campaign;
use Champ\Championship\Repositories\CampaignRepositoryInterface;
use Champ\Championship\Repositories\ChampionshipRepository;
use Champ\Newsletters\CampaignMaker;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class CreateCampaignCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    /**
     * Campaign Repository.
     *
     * @var CampaignRepositoryInterface
     */
    protected $campaigns;

    /**
     * Campaign Maker.
     *
     * @var CampaignMaker
     */
    protected $campaignMaker;

    /**
     * Championship Repository.
     *
     * @var ChampionshipRepository
     */
    protected $championships;

    public function __construct(
        CampaignRepositoryInterface $campaigns,
        CampaignMaker $campaignMaker,
        ChampionshipRepository $championships
    ) {
        $this->campaigns = $campaigns;
        $this->campaignMaker = $campaignMaker;
        $this->championships = $championships;
    }

    public function handle($command)
    {
        // find a championship with the id
        $championship = $this->championships->find($command->championshipId);

        // create a campaign
        $campaignId = $this->composeCampaign($championship, $command);

        // save to the database
        $campaign = $this->saveCampaignToDatabase($campaignId, $command);

        // if in the proccess was fired some event, dispatch them now!
        $this->dispatchEventsFor($campaign);

        return $campaign;
    }

    /**
     * Compose a new campaign.
     *
     * @param Championship          $championship
     * @param CreateCampaignCommand $command
     *
     * @return int campaign id
     */
    private function composeCampaign($championship, $command)
    {
        return $this->campaignMaker->composeForChampionship(
            $championship,
            $command->subject,
            $command->body
        );
    }

    /**
     * Save a campaign to the database.
     *
     * @param int                   $campaignId
     * @param CreateCampaignCommand $command
     *
     * @return Campaign
     */
    private function saveCampaignToDatabase($campaignId, $command)
    {
        $campaign = new Campaign();
        $campaign->compose($command->championshipId, $command->subject, $command->body, $campaignId);

        $this->campaigns->save($campaign);

        return $campaign;
    }
}
