import React from 'react';
import Divider from '../../util/Divider';
import TournamentRow from './TournamentRow';
import { tournamentResource } from '../../services/DTOs';

const TournamentTemplate = (props: { tournament: tournamentResource }) => {
  function compare(a: any, b: any) {
    if (a.totalScore < b.totalScore) {
      return -1;
    } else if (a.totalScore > b.totalScore) {
      return 1;
    }
    return 0;
  }
  const playerTournaments = props.tournament.playerTournaments;

  playerTournaments.sort(compare);

  const coursePar = props.tournament.courseResponseDto.coursePar;
  const courseParMultiplied =
    coursePar *
    props.tournament.playerTournaments[playerTournaments.length - 1].rounds
      .length;

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
