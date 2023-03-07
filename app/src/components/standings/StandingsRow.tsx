import React from 'react';
import { playerResource, seasonStandingsResource } from '../../services/DTOs';

const StandingsRow = (props: { seasonStanding: seasonStandingsResource }) => {
  const { firstName, lastName } = props.seasonStanding.player;
  const { seasonTotal } = props.seasonStanding;

  return (
    <div>
      <div>
        {firstName} {lastName}
      </div>
      <div>{seasonTotal}</div>
    </div>
  );
};

export default StandingsRow;
