import React, { useEffect } from 'react';
import { useQuery } from '@tanstack/react-query';
import {
  getAllTournaments,
  getLastTournament,
} from '../../services/tournamentsApi';
import Loading from '../../util/Loading';
import TournamentRow from '../tournaments/TournamentRow';
import ThinDivider from '../../util/ThinDivider';
import WrapperBlock from '../../util/WrapperBlock';

const LastTournamentBlock = () => {
  //api call to bring in last playerTournament, as well as the course par

  const {
    isLoading: playerTournamentisLoading,
    error: playerTournamentrror,
    data: playerTournamentData,
    refetch,
  } = useQuery({
    queryKey: [`lastTournament`],
    queryFn: () => getLastTournament(1),
    enabled: false,
  });

  useEffect(() => {
    refetch();
  }, []);

  if (playerTournamentisLoading)
    return (
      <div>
        <div className="flex justify-center bg-dgsecondary text-dgsoftwhite">
          Last Tournament
        </div>
        <Loading />
      </div>
    );

  if (playerTournamentrror) return <div>An error has occurred</div>;

  if (playerTournamentData) {
    return (
      <WrapperBlock color="dgsecondary">
        <div className="flex justify-center bg-dgsecondary text-dgsoftwhite">
          Last Tournament
        </div>
        <TournamentRow
          playerTournament={playerTournamentData}
          roundsDisplay={true}
        />
        <ThinDivider />
      </WrapperBlock>
    );
  }

  return <div></div>;
};

export default LastTournamentBlock;
