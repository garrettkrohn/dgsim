import React from 'react';
import { holeResultResource } from '../../services/DTOs';

const TournamentHoles = (props: { round: any }) => {
  const generateHoleResultColor = (hole: holeResultResource): string => {
    if (hole.score === 1) {
      return 'bg-ace';
    }
    const diff = hole.score - hole.par;
    switch (diff) {
      case -2:
        return 'bg-eagle';
      case -1:
        return 'bg-birdie';
      case 0:
        return '';
      case 1:
        return 'bg-bogie';
      case 2:
        return 'bg-doubleBogie';
      case 3:
        return 'bg-tripleBogie';
    }
    return '';
  };

  return (
    <div>
      <div className="flex flex-row">
        <div className="flex flex-col">
          <div>F9:</div>
          <div>B9:</div>
        </div>
        <div className="grid w-full grid-cols-9 grid-rows-2 text-center">
          {props.round.holeResults.map((hole: holeResultResource) => (
            <div className={' ' + generateHoleResultColor(hole)}>
              {hole.score}
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

export default TournamentHoles;
