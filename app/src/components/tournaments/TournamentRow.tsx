import React, { useState } from 'react';
import ThinDivider from '../../util/ThinDivider';
import TournamentHoles from './TournamentHoles';
import { playerTournamentResource, roundResource } from '../../services/DTOs';

const TournamentRow = (props: {
  playerTournament: playerTournamentResource;
  roundsDisplay: boolean;
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

  //course par multiplied is hard coded, have to figure out how to count rounds not including playoffs
  //I'll need to figure out this if I want to vary the number of rounds
  return (
    <>
      <div
        key={playerTournament.player_tournament_id}
        className="grid bg-dgbackground text-dgsoftwhite"
      >
        <ThinDivider />
        <div className="flex justify-between pt-2" onClick={toggleShowRounds}>
          <div className="pl-2">{props.playerTournament.place}</div>
          <div>
            {playerTournament.playerResponseDto.firstName}{' '}
            {playerTournament.playerResponseDto.lastName}
          </div>
          <div className="pr-2 pb-2">
            {playerTournament.totalScore - playerTournament.coursePar * 4}
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
