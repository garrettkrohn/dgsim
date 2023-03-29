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
  const [roundIndex, setRoundIndex] = useState(3);
  const [holeIndex, setHoleIndex] = useState(14);
  const [tournamentIndex, setTournamentIndex] = useState(0);

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

  const calculateTournamentTotal = (
    playerTournament: playerTournamentResource,
  ) => {
    let roundTotalSoFar = calculateTotal(playerTournament.rounds[roundIndex]);
    // console.log(playerTournament.playerResponseDto.lastName, roundTotalSoFar);
    if (roundIndex > 0) {
      for (let i = roundIndex - 1; i > -1; i--) {
        if (playerTournament.rounds[i].roundType === 'tournament') {
          const roundTotal = playerTournament.rounds[i].roundTotal;
          const roundPar = playerTournament.coursePar;
          console.log(roundPar);
          console.log(
            playerTournament.playerResponseDto.lastName,
            playerTournament.rounds[i].roundTotal,
            playerTournament.rounds[i].roundTotal - playerTournament.coursePar,
          );
          // console.log(
          //   playerTournament.playerResponseDto.lastName,
          //   roundTotal,
          //   roundPar,
          //   roundTotal - roundPar,
          // );
          roundTotalSoFar += roundTotal - roundPar;
        }
      }
    }
    // console.log(playerTournament.playerResponseDto.lastName, roundTotalSoFar);
    return roundTotalSoFar;
  };

  const calculateTotal = (round: roundResource) => {
    let totalSoFar = 0;
    let parSoFar = 0;

    for (let i = holeIndex; i >= 0; i--) {
      totalSoFar += round.holeResults[i].score;
      parSoFar += round.holeResults[i].par;
    }

    return totalSoFar - parSoFar;
  };

  const compareScore = (
    a: playerTournamentResource,
    b: playerTournamentResource,
  ) => {
    if (!a.rounds[roundIndex] || !b.rounds[roundIndex]) {
      return -1;
    }
    return calculateTournamentTotal(a) - calculateTournamentTotal(b);
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

  const incrementHoleIndex = () => {
    if (tournamentsData) {
      if (
        roundIndex ===
          tournamentsData[tournamentIndex].playerTournaments[0].rounds.length &&
        holeIndex + 1 ===
          tournamentsData[tournamentIndex].playerTournaments[0].rounds[
            roundIndex
          ].holeResults.length
      ) {
        console.log('done');
      } else {
        if (
          holeIndex + 1 ===
          tournamentsData[tournamentIndex].playerTournaments[0].rounds[
            roundIndex
          ].holeResults.length
        ) {
          setHoleIndex(-1);
          setRoundIndex(roundIndex + 1);
        } else {
          setHoleIndex(holeIndex + 1);
        }
      }
    }
  };

  if (tournamentsData) {
    tournamentsData[tournamentIndex].playerTournaments.sort(compareScore);
    return (
      <div className="text-dgsoftwhite">
        <div>Replay</div>
        <div>{tournamentsData[tournamentIndex].tournamentName}</div>
        <div className="text-center">Round: {roundIndex + 1}</div>
        <div className="grid grid-flow-col">
          <div>Place:</div>
          <div>Name:</div>
          <div>Tourny Score:</div>
          <div>Round Score:</div>
          <div>Hole: {holeIndex - 1 > 0 ? holeIndex - 1 : 'X'}</div>
          <div>Hole: {holeIndex > 0 ? holeIndex : 'X'}</div>
          <div>Hole: {holeIndex + 1}</div>
          <div>Through:</div>
        </div>
        {tournamentsData[tournamentIndex].playerTournaments.map((pt, index) => (
          <div key={index} className="py-1">
            {pt.rounds[roundIndex] ? (
              <div className="grid grid-flow-col pl-2">
                <div>{index + 1}</div>
                <div className="px-2">
                  {pt.playerResponseDto.firstName}{' '}
                  {pt.playerResponseDto.lastName}{' '}
                </div>
                <div>{calculateTournamentTotal(pt)}</div>
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
                      : 'X'
                  }
                >
                  {pt.rounds[roundIndex].holeResults[holeIndex]
                    ? pt.rounds[roundIndex].holeResults[holeIndex].score
                    : 'X'}
                </div>
                {holeIndex + 1} holes
              </div>
            ) : (
              ''
            )}

            <ThinDivider />
          </div>
        ))}
        <div>
          <button className="bg-dgtertiary" onClick={incrementHoleIndex}>
            increment
          </button>
        </div>
        <div>
          <button
            className="bg-dgtertiary"
            onClick={() => {
              setHoleIndex(-1);
              setRoundIndex(0);
            }}
          >
            reset
          </button>
        </div>
      </div>
    );
  }
};

export default Replay;
