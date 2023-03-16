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
import { useAuth0 } from '@auth0/auth0-react';

const LastTournamentBlock = () => {
  const { user } = useAuth0();

  const {
    isLoading: playerTournamentisLoading,
    error: playerTournamentrror,
    data: playerTournamentData,
    refetch,
  } = useQuery({
    queryKey: [`lastTournament`],
    //@ts-ignore
    queryFn: () => getLastTournament(user.sub),
    enabled: false,
  });

  useEffect(() => {
    refetch();
  }, []);

  if (playerTournamentisLoading)
    return (
      <div>
        <Loading />
      </div>
    );

  if (playerTournamentrror) return <div>An error has occurred</div>;

  if (!playerTournamentData) {
    return (
      <WrapperBlock color="dgsecondary">
        <div className="text-center text-dgsoftwhite">No tournaments, yet!</div>
      </WrapperBlock>
    );
  }

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
