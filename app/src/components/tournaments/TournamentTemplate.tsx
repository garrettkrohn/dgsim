import React from 'react';
import { TournamentResource } from '../../services/tournamentsApi';
import Divider from '../../util/Divider';
import ThinDivider from '../../util/ThinDivider';
import TournamentRow from './TournamentRow';

const TournamentTemplate = (props: {
  tournament: TournamentResource | undefined;
}) => {
  if (props.tournament === undefined) {
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
  const playerTournaments = props.tournament.playerTournament;

  playerTournaments.sort(compare);

  const coursePar = props.tournament.courseResponseDto.coursePar;
  const courseParMultiplied = coursePar * 4;

  return (
    <div className="font-main text-lg">
      <div className="flex flex-col items-center bg-dgsecondary text-dgsoftwhite">
        <div className="text-lg capitalize">
          {props.tournament.tournamentName} at{' '}
          {props.tournament.courseResponseDto.name}
        </div>
        <div>Season: {props.tournament.season}</div>
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
