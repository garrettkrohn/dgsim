import React from 'react';
import { seasonStandingsResource } from '../../services/DTOs';
import Divider from '../../util/Divider';
import StandingsRow from './StandingsRow';

const StandingsTemplate = (props: {
  standings: seasonStandingsResource[] | undefined;
}) => {
  if (!props.standings) {
    return <div>ope, there was an error</div>;
  }

  return (
    <div className="font-main text-lg">
      <div className="flex flex-col items-center bg-dgsecondary text-dgsoftwhite">
        <div className="text-lg capitalize">Season 1 Standings</div>
      </div>
      <Divider color={'dgbackground'} />
      <div>
        {props.standings.map((standing, index) => (
          <StandingsRow seasonStanding={standing} key={index} />
        ))}
      </div>
    </div>
  );
};

export default StandingsTemplate;
