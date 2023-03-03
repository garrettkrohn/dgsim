import React, { useEffect } from 'react';

const TournamentHoles = (props: { round: any }) => {
  console.log(props.round);

  const frontNine = [1, 2, 3, 4, 5, 6, 7, 8, 9];
  const backNine = [10, 11, 12, 13, 14, 15, 16, 17, 18];

  let frontNineResults: number[] = [];
  let backNineResults: number[] = [];
  useEffect(() => {
    console.log(props.round.holeresults);
    frontNineResults = props.round.holeresults.splice(0, 8);
    console.log(frontNineResults);
    backNineResults = props.round.holeresults.splice(-8);
    console.log(backNineResults);
  }, [props]);

  return (
    <div>
      <div className="flex flex-col">
        <div>Hole:</div>
        <div>Par:</div>
        <div>Score:</div>
      </div>
      <div className="grid grid-cols-9 grid-rows-3">
        {frontNine.map(number => (
          <div>{number}</div>
        ))}
        {frontNineResults.map((hole: any) => (
          <div>{hole.score}</div>
        ))}
      </div>
    </div>
  );
};

export default TournamentHoles;
