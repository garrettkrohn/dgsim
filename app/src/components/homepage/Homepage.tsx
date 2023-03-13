import PlayerBlock from './PlayerBlock';
import Divider from '../../util/Divider';
import UpdateBlock from './UpdateBlock';
import React, { useEffect, useState } from 'react';
import UpdateConfirmModal from './UpdateConfirmModal';
import LastTournamentBlock from './LastTournamentBlock';
import { useQuery } from '@tanstack/react-query';
import { getAllTournaments } from '../../services/tournamentsApi';

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
    refetch,
  } = useQuery({
    queryKey: [`seasons/tournament/title`],
    queryFn: () => getAllTournaments(),
    enabled: false,
  });

  useEffect(() => {
    refetch();
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
