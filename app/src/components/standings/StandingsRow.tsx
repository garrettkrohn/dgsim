import React from 'react';
import { seasonStandingsResource } from '../../services/DTOs';
import ThinDivider from '../../util/ThinDivider';

const StandingsRow = (props: { seasonStanding: seasonStandingsResource }) => {
  const { firstName, lastName } = props.seasonStanding.player;
  const { seasonTotal } = props.seasonStanding;

  return (
    <div className="grid bg-dgbackground text-dgsoftwhite">
      <div className="flex flex-row justify-between py-2">
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
