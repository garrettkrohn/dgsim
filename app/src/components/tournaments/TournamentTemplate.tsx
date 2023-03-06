import React from 'react';
import Divider from '../../util/Divider';
import TournamentRow from './TournamentRow';
import { TournamentResource } from '../../services/DTOs';
import { useQuery } from '@tanstack/react-query';
import { getTournament } from '../../services/tournamentsApi';

const TournamentTemplate = (props: { tournamentId: number }) => {
  const tournamentId = props.tournamentId;
  const {
    isLoading,
    error,
    data: tournament,
  } = useQuery({
    queryKey: [`tournaments/${tournamentId}`],
    queryFn: () => getTournament(tournamentId),
  });

  if (isLoading) {
    return <div>Loading...</div>;
  }

  if (error) {
    return <div>ope, there was an error...</div>;
  }

  if (tournament === undefined) {
    return <div></div>;
  }

  function compare(a: any, b: any) {
    if (a.totalScore < b.totalScore) {
      return -1;
    } else if (a.totalScore > b.totalScore) {
      return 1;
    }
    return 0;
  }
  const playerTournaments = tournament.playerTournaments;

  playerTournaments.sort(compare);

  const coursePar = tournament.courseResponseDto.coursePar;
  const courseParMultiplied =
    coursePar *
    tournament.playerTournaments[playerTournaments.length - 1].rounds.length;

  return (
    <div className="font-main text-lg">
      <div className="flex flex-col items-center bg-dgsecondary text-dgsoftwhite">
        <div className="text-lg capitalize">
          {tournament.tournamentName} at {tournament.courseResponseDto.name}
        </div>
        <div>Season: {tournament.season}</div>
      </div>
      <Divider color={'dgbackground'} />
      <div className="flex flex-row justify-between bg-dgbackground text-dgsoftwhite">
        <div>Place:</div>
        <div>Name:</div>
        <div>Total:</div>
      </div>
      {playerTournaments.map(pt => (
        <TournamentRow
          playerTournament={pt}
          courseParMultiplied={courseParMultiplied}
        />
      ))}
    </div>
  );
};

export default TournamentTemplate;
