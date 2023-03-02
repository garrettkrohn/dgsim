import React from 'react';
import { TournamentResource } from '../../services/tournamentsApi';
import Divider from '../homepage/Divider';

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
    <div>
      <div className="flex flex-col items-center bg-dgsecondary text-dgsoftwhite">
        <div className="text-lg capitalize">
          {props.tournament.tournamentName} at{' '}
          {props.tournament.courseResponseDto.name}
        </div>
        <div>Season: {props.tournament.season}</div>
      </div>
      <Divider color={'dgbackground'} />
      <div className="flex flex-row justify-between bg-dgbackground text-dgsoftwhite">
        <div>Place</div>
        <div>Name</div>
        <div>Total</div>
      </div>
      {props.tournament.playerTournament.map(pt => (
        <div key={pt.player_tournament_id} className="flex flex-row">
          <div>{pt.place}</div>
          <div>
            {pt.playerResponseDto.first_name} {pt.playerResponseDto.last_name}
          </div>
          <div>{pt.totalScore - courseParMultiplied}</div>
          {pt.rounds.map(r => (
            <div>{r.roundTotal}</div>
          ))}
        </div>
      ))}
    </div>
  );
};

export default TournamentTemplate;
