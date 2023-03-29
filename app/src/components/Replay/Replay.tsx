import React, { useEffect, useState } from 'react';
import { useQuery } from '@tanstack/react-query';
import { getAllTournaments } from '../../services/tournamentsApi';
import Loading from '../../util/Loading';
import {
  holeResultResource,
  playerTournamentResource,
  roundResource,
} from '../../services/DTOs';
import ThinDivider from '../../util/ThinDivider';

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

  const generateHoleResultColor = (hole: holeResultResource): string => {
    if (hole) {
      if (hole.score === 1) {
        return 'bg-ace';
      }
      const diff = hole.score - hole.par;
      switch (diff) {
        case -2:
          return 'bg-eagle';
        case -1:
          return 'bg-birdie';
        case 0:
          return '';
        case 1:
          return 'bg-bogie';
        case 2:
          return 'bg-doubleBogie';
        case 3:
          return 'bg-tripleBogie';
      }
      return '';
    }
    return '';
  };

  if (tournamentsAreLoading) return <Loading />;

  if (tournamentsError) return <div>An error has occurred</div>;

  if (tournamentsData) {
    tournamentsData[0].playerTournaments.sort(compareScore);
    return (
      <div className="text-dgsoftwhite">
        <div>Replay</div>
        <div>{tournamentsData[0].tournamentName}</div>
        <div className="grid grid-flow-col">
          <div>Place:</div>
          <div>Name:</div>
          <div>Score:</div>
          <div>Hole: {holeIndex - 1 > 0 ? holeIndex - 1 : 'X'}</div>
          <div>Hole: {holeIndex > 0 ? holeIndex : 'X'}</div>
          <div>Hole: {holeIndex + 1}</div>
          <div>Through:</div>
        </div>
        {tournamentsData[0].playerTournaments.map((pt, index) => (
          <div key={index} className="py-1">
            <div className="grid grid-flow-col pl-2">
              <div>{index + 1}</div>
              <div className="px-2">
                {pt.playerResponseDto.firstName} {pt.playerResponseDto.lastName}{' '}
              </div>
              <div className="px-2">
                {calculateTotal(pt.rounds[roundIndex])}
              </div>
              <div
                className={
                  'px-2' + pt.rounds[roundIndex].holeResults[holeIndex - 2]
                    ? generateHoleResultColor(
                        pt.rounds[roundIndex].holeResults[holeIndex - 2],
                      )
                    : ''
                }
              >
                {pt.rounds[roundIndex].holeResults[holeIndex - 2]
                  ? pt.rounds[roundIndex].holeResults[holeIndex - 2].score
                  : 'X'}
              </div>
              <div
                className={
                  'px-2' + pt.rounds[roundIndex].holeResults[holeIndex - 1]
                    ? generateHoleResultColor(
                        pt.rounds[roundIndex].holeResults[holeIndex - 1],
                      )
                    : ''
                }
              >
                {pt.rounds[roundIndex].holeResults[holeIndex - 1]
                  ? pt.rounds[roundIndex].holeResults[holeIndex - 1].score
                  : 'X'}
              </div>
              <div
                className={
                  'px-2' + pt.rounds[roundIndex].holeResults[holeIndex]
                    ? generateHoleResultColor(
                        pt.rounds[roundIndex].holeResults[holeIndex],
                      )
                    : ''
                }
              >
                {pt.rounds[roundIndex].holeResults[holeIndex].score}
              </div>
              {holeIndex + 1} holes
            </div>

            <ThinDivider />
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
