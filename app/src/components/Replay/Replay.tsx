import React, { useEffect, useState } from 'react';
import { useQuery } from '@tanstack/react-query';
import { getAllTournaments } from '../../services/tournamentsApi';
import Loading from '../../util/Loading';
import { playerTournamentResource, roundResource } from '../../services/DTOs';

const Replay = () => {
  const [roundIndex, setRoundIndex] = useState(0);
  const [holeIndex, setHoleIndex] = useState(0);

  const {
    isLoading: tournamentsAreLoading,
    error: tournamentsError,
    data: tournamentsData,
    refetch,
  } = useQuery({
    queryKey: [`seasons/tournament/title`],
    queryFn: () => getAllTournaments(),
    enabled: false,
  });

  useEffect(() => {
    refetch();
  }, []);

  const calculateTotal = (round: roundResource) => {
    let totalSoFar = 0;
    let parSoFar = 0;

    for (let i = holeIndex; i >= 0; i--) {
      totalSoFar += round.holeResults[i].score;
      parSoFar += round.holeResults[i].par;
    }

    return totalSoFar - parSoFar;
  };

  const sortLeaderboard = () => {};

  const incrementHoleIndex = () => {
    setHoleIndex(holeIndex + 1);
  };

  const compareScore = (
    a: playerTournamentResource,
    b: playerTournamentResource,
  ) => {
    return (
      calculateTotal(a.rounds[roundIndex]) -
      calculateTotal(b.rounds[roundIndex])
    );
  };

  // useEffect(() => {
  //   if (tournamentsData) {
  //     tournamentsData[0].playerTournaments.sort(compareScore);
  //   }
  // }, [holeIndex, roundIndex]);

  if (tournamentsAreLoading) return <Loading />;

  if (tournamentsError) return <div>An error has occurred</div>;

  if (tournamentsData) {
    tournamentsData[0].playerTournaments.sort(compareScore);
    return (
      <div className="text-dgsoftwhite">
        <div>Replay</div>
        <div>{tournamentsData[0].tournamentName}</div>
        {tournamentsData[0].playerTournaments.map((pt, index) => (
          <div key={index}>
            <span>
              {pt.rounds[roundIndex].holeResults[holeIndex - 2]
                ? pt.rounds[roundIndex].holeResults[holeIndex - 2].score
                : ''}
            </span>
            {pt.rounds[roundIndex].holeResults[holeIndex - 1]
              ? pt.rounds[roundIndex].holeResults[holeIndex - 1].score
              : ''}
            {pt.rounds[roundIndex].holeResults[holeIndex].score}
            {pt.playerResponseDto.lastName}{' '}
            {calculateTotal(pt.rounds[roundIndex])}
            through {holeIndex + 1} holes
          </div>
        ))}
        <div>
          <button className="bg-dgtertiary" onClick={incrementHoleIndex}>
            increment
          </button>
        </div>
        <div>
          <button className="bg-dgtertiary" onClick={() => setHoleIndex(0)}>
            reset
          </button>
        </div>
      </div>
    );
  }
};

export default Replay;
