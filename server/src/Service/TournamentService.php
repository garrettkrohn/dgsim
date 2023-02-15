<?php

namespace App\Service;

use App\Repository\TournamentRepository;

class TournamentService
{
    private TournamentRepository $tournamentRepository;

    public function __construct(TournamentRepository $tournamentRepository)
    {
        $this->tournamentRepository = $tournamentRepository;
    }

    public function getAllTournaments(): iterable
    {
        return $this->tournamentRepository->findAll();
    }
}