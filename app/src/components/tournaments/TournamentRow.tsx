import React, { useState } from 'react';
import ThinDivider from '../../util/ThinDivider';

const TournamentRow = (props: {
  playerTournament: any;
  courseParMultiplied: number;
}) => {
  const [showRounds, setShowRounds] = useState(false);

  const toggleShowRounds = () => {
    setShowRounds(!showRounds);
  };

  return (
    <>
      <div
        key={props.playerTournament.player_tournament_id}
        className="grid bg-dgbackground text-dgsoftwhite"
      >
        <ThinDivider />
        <div className="flex justify-between pt-2" onClick={toggleShowRounds}>
          <div className="pl-2">{props.playerTournament.place}</div>
          <div>
            {props.playerTournament.playerResponseDto.first_name}{' '}
            {props.playerTournament.playerResponseDto.last_name}
          </div>
          <div className="pr-2 pb-2">
            {props.playerTournament.totalScore - props.courseParMultiplied}
          </div>
        </div>
        <ThinDivider />
        {showRounds ? (
          <div className="grid grid-flow-col grid-cols-5 grid-rows-2 bg-black">
            {props.playerTournament.rounds.map(r => (
              <>
                <div>R1</div>
                <div>{r.roundTotal}</div>
              </>
            ))}
            <div> Total</div>
            {props.playerTournament.totalScore}
          </div>
        ) : (
          ''
        )}
      </div>
    </>
  );
};

export default TournamentRow;
