import React, { useState } from 'react';
import ThinDivider from '../../util/ThinDivider';
import TournamentHoles from './TournamentHoles';

const TournamentRow = (props: {
  playerTournament: any;
  courseParMultiplied: number;
}) => {
  const [showRounds, setShowRounds] = useState(false);
  const [showHoles, setShowHoles] = useState(false);

  const toggleShowRounds = () => {
    setShowRounds(!showRounds);
  };

  const toggleShowHoles = () => {
    setShowHoles(!showHoles);
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

        {showRounds ? (
          <>
            <ThinDivider />
            <div className="grid grid-flow-col grid-cols-5 grid-rows-2 bg-black">
              {props.playerTournament.rounds.map((r, y: number) => (
                <>
                  <div>R{y + 1}</div>
                  <div>{r.roundTotal}</div>
                </>
              ))}
              <div> Total</div>
              {props.playerTournament.totalScore}
            </div>
            <TournamentHoles round={props.playerTournament.rounds[0]} />
          </>
        ) : (
          ''
        )}
      </div>
    </>
  );
};

export default TournamentRow;
