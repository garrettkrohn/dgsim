import React from 'react';
import {
  allSeasonStandings,
  seasonStandingResource,
} from '../../services/DTOs';
import ThinDivider from '../../util/ThinDivider';

const StandingsRow = (props: { seasonStanding: seasonStandingResource }) => {
  const { firstName, lastName } = props.seasonStanding.player;
  const { seasonTotal, rank } = props.seasonStanding;

  return (
    <div className="grid bg-dgbackground text-dgsoftwhite">
      <div className="flex flex-row justify-between py-2">
        <div className="px-4">{rank}</div>
        <div className="px-4">
          {firstName} {lastName}
        </div>
        <div className="px-4">{seasonTotal}</div>
      </div>
      <ThinDivider />
    </div>
  );
};

export default StandingsRow;
