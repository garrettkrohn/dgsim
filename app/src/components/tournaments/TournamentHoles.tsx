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

  const missOrMakeFormatting = (boolean: boolean) => {
    if (boolean) {
      return <div className="bg-green-900">X</div>;
    } else {
      return <div className="bg-red-900">O</div>;
    }
  };

  return (
    <div>
      <div className="flex flex-row lg:hidden">
        <div className="flex flex-col">
          <div>F9:</div>
          <div>B9:</div>
        </div>
        <div className="grid w-full grid-cols-9 grid-rows-2 text-center">
          {props.round.holeResults.map(
            (hole: holeResultResource, index: number) => (
              <div key={index} className={' ' + generateHoleResultColor(hole)}>
                {hole.score}
              </div>
            ),
          )}
        </div>
      </div>
      <div className="hidden px-2 lg:flex">
        <div className="flex-col">
          <div>Hole:</div>
          <div>Par:</div>
          <div>Score:</div>
          <div>C1P:</div>
          <div>C2P:</div>
          <div>Parked:</div>
          <div>C1Reg:</div>
          <div>C2Reg:</div>
          <div>Scramble: </div>
        </div>
        <div className="hidden w-full grid-flow-row grid-cols-18 text-center lg:grid">
          {props.round.holeResults.map(
            (hole: holeResultResource, index: number) => (
              <div key={index}>
                <div>{index + 1}</div>
                <div>{hole.par}</div>
                <div
                  key={index}
                  className={' ' + generateHoleResultColor(hole)}
                >
                  {hole.score}
                </div>
                <div>{hole.c1Putts}</div>
                <div>{hole.c2Putts}</div>
                <div>{missOrMakeFormatting(hole.parked)}</div>
                <div>{missOrMakeFormatting(hole.c1InRegulation)}</div>
                <div>{missOrMakeFormatting(hole.c2InRegulation)}</div>
                <div>{missOrMakeFormatting(hole.scramble)}</div>
              </div>
            ),
          )}
        </div>
      </div>
    </div>
  );
};

export default TournamentHoles;
