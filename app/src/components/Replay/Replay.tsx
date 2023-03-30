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
import Dropdown from '../../util/Dropdown';
import Button from '../../util/Button';
import TournamentTemplate from '../tournaments/TournamentTemplate';

const Replay = () => {
  const [roundIndex, setRoundIndex] = useState(0);
  const [holeIndex, setHoleIndex] = useState(-1);
  const [tournamentIndex, setTournamentIndex] = useState(2);
  const [tournamentComplete, setTournamentComplete] = useState(false);

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
    if (roundIndex > 0) {
      for (let i = roundIndex - 1; i > -1; i--) {
        if (playerTournament.rounds[i].roundType === 'tournament') {
          const roundTotal = playerTournament.rounds[i].roundTotal;
          const roundPar = playerTournament.coursePar;
          roundTotalSoFar += roundTotal - roundPar;
        }
      }
    }
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
          tournamentsData[tournamentIndex].playerTournaments[0].rounds.length -
            1 &&
        holeIndex + 1 ===
          tournamentsData[tournamentIndex].playerTournaments[0].rounds[
            roundIndex
          ].holeResults.length
      ) {
        setTournamentComplete(true);
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

  const decrementHoleIndex = () => {
    if (tournamentsData) {
      if (roundIndex === 0 && holeIndex === -1) {
        setHoleIndex(-1);
      } else {
        if (holeIndex === -1 && roundIndex !== 0) {
          setRoundIndex(roundIndex - 1);
          setHoleIndex(
            tournamentsData[tournamentIndex].playerTournaments[0].rounds[0]
              .holeResults.length - 1,
          );
        } else {
          setHoleIndex(holeIndex - 1);
        }
      }
    }
    // setHoleIndex(holeIndex - 1);
  };

  const selectNewTournament = (index: number) => {
    setTournamentIndex(index);
    setHoleIndex(-1);
    setRoundIndex(0);
  };

  if (tournamentsData) {
    tournamentsData[tournamentIndex].playerTournaments.sort(compareScore);
    const items = tournamentsData.map(item => {
      return item.season + ' - ' + item.tournamentName;
    });

    if (tournamentComplete) {
      return (
        <div>
          <TournamentTemplate tournament={tournamentsData[tournamentIndex]} />
          <Button
            label="back to replay"
            onClick={() => setTournamentComplete(false)}
            disable={false}
          />
        </div>
      );
    }

    return (
      <div className="flex justify-center">
        <div className="max-w-5xl text-dgsoftwhite ">
          <div className="flex h-16 flex-row justify-evenly bg-dgbackground py-2 text-dgsoftwhite">
            <Dropdown
              items={items}
              setIndex={selectNewTournament}
              title={'Select Tournament'}
            />
          </div>
          <div>Replay</div>
          <div>{tournamentsData[tournamentIndex].tournamentName}</div>
          <div className="text-center">Round: {roundIndex + 1}</div>
          <div className="grid grid-flow-col grid-cols-9 text-center">
            <div>Place:</div>
            <div className="col-span-2">Name:</div>
            <div>Tourny Score:</div>
            <div>Round Score:</div>
            <div>Hole: {holeIndex - 1 > 0 ? holeIndex - 1 : 'X'}</div>
            <div>Hole: {holeIndex > 0 ? holeIndex : 'X'}</div>
            <div>Hole: {holeIndex + 1}</div>
            <div>Through:</div>
          </div>
          {tournamentsData[tournamentIndex].playerTournaments.map(
            (pt, index) => (
              <div key={index} className="py-1 text-center">
                {pt.rounds[roundIndex] ? (
                  <div className="grid grid-flow-col grid-cols-9 pl-2">
                    <div>{index + 1}</div>
                    <div className="col-span-2 px-2">
                      {pt.playerResponseDto.firstName}{' '}
                      {pt.playerResponseDto.lastName}{' '}
                    </div>
                    <div>{calculateTournamentTotal(pt)}</div>
                    <div className="px-2">
                      {calculateTotal(pt.rounds[roundIndex])}
                    </div>
                    <div
                      className={
                        'px-2' +
                        pt.rounds[roundIndex].holeResults[holeIndex - 2]
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
                        'px-2' +
                        pt.rounds[roundIndex].holeResults[holeIndex - 1]
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
            ),
          )}
          <div className="flex flex-row justify-center">
            <Button
              onClick={decrementHoleIndex}
              disable={false}
              label="Rewind"
            />
            <Button
              onClick={() => {
                setHoleIndex(-1);
                setRoundIndex(0);
              }}
              label="Reset"
              disable={false}
            />
            <Button
              onClick={incrementHoleIndex}
              disable={false}
              label="Simulate Hole"
            />
          </div>
        </div>
      </div>
    );
  }
};

export default Replay;
