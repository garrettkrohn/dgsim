import React, { useState } from 'react';
import ThinDivider from '../../util/ThinDivider';
import TournamentHoles from './TournamentHoles';
import { playerTournamentResource, roundResource } from '../../services/DTOs';

const TournamentRow = (props: {
  playerTournament: playerTournamentResource;
  roundsDisplay: boolean;
  courseParMultiplied: number;
}) => {
  const { playerTournament, roundsDisplay } = props;
  const [showRounds, setShowRounds] = useState(roundsDisplay);
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
        key={playerTournament.player_tournament_id}
        className="grid bg-dgbackground text-dgsoftwhite"
      >
        <ThinDivider />
        <div
          className="lg: flex justify-between px-36 pt-2"
          onClick={toggleShowRounds}
        >
          <div className="pl-2">{props.playerTournament.place}</div>
          <div>
            {playerTournament.playerResponseDto.firstName}{' '}
            {playerTournament.playerResponseDto.lastName}
          </div>
          <div className="pr-2 pb-2">
            {playerTournament.totalScore - props.courseParMultiplied}
          </div>
        </div>

        {showRounds ? (
          <>
            <ThinDivider />
            <div className="grid grid-flow-col grid-rows-1 bg-black text-center">
              {props.playerTournament.rounds.map(
                (r: roundResource, y: number) => (
                  <div
                    key={y}
                    className="hover:cursor-pointer"
                    onClick={() => handleRoundSelect(y)}
                  >
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
                  </div>
                ),
              )}
              <div>
                <div> Total</div>
                {props.playerTournament.totalScore}
              </div>
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
