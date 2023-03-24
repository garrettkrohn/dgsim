import React from 'react';
import { allSeasonStandings } from '../../services/DTOs';
import Divider from '../../util/Divider';
import StandingsRow from './StandingsRow';

const StandingsTemplate = (props: {
  allSeasonStandings: allSeasonStandings | undefined;
}) => {
  if (!props.allSeasonStandings) {
    return <div>ope, there was an error</div>;
  }

  return (
    <div className="font-main text-lg">
      <div className="flex flex-col items-center bg-dgsecondary text-dgsoftwhite">
        <div className="text-lg capitalize">
          Season {props.allSeasonStandings.season} Standings
        </div>
      </div>
      <Divider color={'dgbackground'} />
      <div>
        <div className="flex justify-between px-36 text-dgsoftwhite">
          <div>Place</div>
          <div>Name</div>
          <div>Tour Points</div>
        </div>
        {props.allSeasonStandings.standings.map((standing, index) => (
          <StandingsRow seasonStanding={standing} key={index} />
        ))}
      </div>
    </div>
  );
};

export default StandingsTemplate;
