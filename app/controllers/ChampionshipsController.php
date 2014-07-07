<?php

use Champ\Repositories\ChampionshipRepositoryInterface;
use Moip\Moip;

class ChampionshipsController extends BaseController {

    /**
     * Championship Repository
     *
     * @var Champ\Repositories\ChampionshipRepositoryInterface
     */
    protected $champRepo;

    public function __construct(ChampionshipRepositoryInterface $champRepo)
    {
        $this->champRepo = $champRepo;
    }

    /**
     * Show a list of Championships in desc date order
     *
     * @return Response
     */
    public function index()
    {
        $championships = $this->champRepo->featured();

        return $this->view('championships.index', compact('championships'));
    }

    /**
     * Show all details about the championship
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $championship = $this->champRepo->find($id);

        return $this->view('championships.show', compact('championship'));

        /*$moip = new Moip();
        $moip->setEnvironment('test');
        $moip->setCredential(array(
            'key' => 'H980Q22VM3W6LC6LIQIA8JVQTUKF1E1ONH4VL3QC',
            'token' => 'ZOYXSPWPYR5ZEGYPGQVRKO9I58JA6CLU'
            ));
        $moip->setUniqueID(false);
        $moip->setValue('100.00');
        $moip->setReason('Teste do Moip-PHP');*/
        /*
        $moip->addComission(
            'Razão do Split',
            'diegoflx.oliveira@gmail.com',
            '98.00',
            true,
            true
        );

        $moip->validate('Basic');
        $moip->send();

        print_r($moip->getAnswer());
        */
    }
}