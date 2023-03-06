import React, { useState } from 'react';
import ThinDivider from '../../util/ThinDivider';
import TournamentHoles from './TournamentHoles';
import { roundResource } from '../../services/DTOs';

const TournamentRow = (props: {
  playerTournament: any;
  courseParMultiplied: number;
}) => {
  const [showRounds, setShowRounds] = useState(false);
  const [selectedRound, setSelectedRound] = useState(0);

  const toggleShowRounds = () => {
    setShowRounds(!showRounds);
  };

  const handleRoundSelect = (id: number) => {
    setSelectedRound(id);
  };

  const colorSelected = (index: number): string => {
    if (index === selectedRound) {
      return 'bg-dgblack';
    } else {
      return 'dg-primary';
    }
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
            <div className="grid grid-flow-col grid-cols-5 grid-rows-2 bg-black text-center">
              {props.playerTournament.rounds.map(
                (r: roundResource, y: number) => (
                  <>
                    <div
                      key={r.roundId}
                      className={colorSelected(y)}
                      onClick={() => handleRoundSelect(y)}
                    >
                      R{y + 1}
                    </div>
                    <div key={y} className={colorSelected(y)}>
                      {r.roundTotal}
                    </div>
                  </>
                ),
              )}
              <div> Total</div>
              {props.playerTournament.totalScore}
            </div>
            <TournamentHoles
              round={props.playerTournament.rounds[selectedRound]}
            />
          </>
        ) : (
          ''
        )}
      </div>
    </>
  );
};

export default TournamentRow;
