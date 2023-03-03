import React, { useEffect, useState } from 'react';
import { getTournament } from '../../services/tournamentsApi';
import { useQuery } from '@tanstack/react-query';

const Tournaments = () => {
  const [currentTournament, setCurrentTournament] = useState({
    tournamentId: '',
    tournamentName: '',
    courseResponseDto: '',
    season: '',
    playerTournament: '',
  });

  return <div>{currentTournament.tournamentName}</div>;
};

export default Tournaments;
