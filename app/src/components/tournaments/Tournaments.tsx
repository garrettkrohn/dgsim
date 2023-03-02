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

  // const getTournaments = (tournamentId: number) => {
  //   const { isLoading, error, data } = useQuery({
  //     queryKey: [`tournaments/${tournamentId}`],
  //     queryFn: () => getTournament(),
  //   });
  // };

  return <div>{currentTournament.tournamentName}</div>;
};

export default Tournaments;
