import PlayerBlock from './PlayerBlock';
import Divider from '../../util/Divider';
import UpdateBlock from './UpdateBlock';
import React, { useEffect, useState } from 'react';
import UpdateConfirmModal from './UpdateConfirmModal';
import LastTournamentBlock from './LastTournamentBlock';
import { useQuery } from '@tanstack/react-query';
import { getAllTournaments } from '../../services/tournamentsApi';
import { getSeasonLeaderboards } from '../../services/standingsApi';

const Homepage = () => {
  const [showConfirmModal, setShowConfirmModal] = useState(false);

  const toggleConfirmModal = () => {
    setShowConfirmModal(!showConfirmModal);
  };

  //calls the tournaments call when the homepage is loaded!
  const {
    isLoading: tournamentsAreLoading,
    error: tournamentsError,
    data: tournamentsData,
    refetch: refetchTournaments,
  } = useQuery({
    queryKey: [`seasons/tournament/title`],
    queryFn: () => getAllTournaments(),
    enabled: false,
  });

  const {
    isLoading: standingsAreLoading,
    error: standingsError,
    data: standingsData,
    refetch: refetchStandings,
  } = useQuery({
    queryKey: [`standings/season`],
    queryFn: () => getSeasonLeaderboards(),
    enabled: false,
  });

  useEffect(() => {
    refetchStandings();
    refetchTournaments();
  }, []);

  return (
    <div>
      <PlayerBlock />
      <Divider color="dgbackground" />
      <UpdateBlock toggleUpdateModal={toggleConfirmModal} />
      {showConfirmModal ? (
        <UpdateConfirmModal toggleModal={toggleConfirmModal} />
      ) : (
        ''
      )}
      <LastTournamentBlock />
    </div>
  );
};

export default Homepage;
