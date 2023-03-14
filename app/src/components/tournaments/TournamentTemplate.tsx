import React from 'react';
import Divider from '../../util/Divider';
import TournamentRow from './TournamentRow';
import {
  playerTournamentResource,
  tournamentResource,
} from '../../services/DTOs';

const TournamentTemplate = (props: {
  tournament: tournamentResource | undefined;
}) => {
  function compare(a: playerTournamentResource, b: playerTournamentResource) {
    if (a.totalScore < b.totalScore) {
      return -1;
    } else if (a.totalScore > b.totalScore) {
      return 1;
    }
    return 0;
  }

  if (!props.tournament) {
    return <div>ope, there was an error</div>;
  }

  const playerTournaments = props.tournament.playerTournaments;

  playerTournaments.sort(compare);

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
      {playerTournaments.map((pt, index) => (
        <TournamentRow
          key={index}
          playerTournament={pt}
          roundsDisplay={false}
        />
      ))}
    </div>
  );
};

export default TournamentTemplate;
