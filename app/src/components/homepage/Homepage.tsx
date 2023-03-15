import PlayerBlock from './PlayerBlock';
import Divider from '../../util/Divider';
import UpdateBlock from './UpdateBlock';
import React, { useEffect, useState } from 'react';
import UpdateConfirmModal from './UpdateConfirmModal';
import LastTournamentBlock from './LastTournamentBlock';
import { useMutation, useQuery } from '@tanstack/react-query';
import {
  createTournament,
  getAllTournaments,
} from '../../services/tournamentsApi';
import { getSeasonLeaderboards } from '../../services/standingsApi';
import { useAuth0 } from '@auth0/auth0-react';
import { createOrGetUser } from '../../services/UserApi';

function Homepage() {
  const [showConfirmModal, setShowConfirmModal] = useState(false);

  const { isAuthenticated, user } = useAuth0();

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

  const createOrGetUserCall: any = useMutation({
    mutationFn: () =>
      createOrGetUser({
        // @ts-ignore
        Auth0: user.sub,
      }),
    onMutate: () => console.log('mutate'),
    onError: (err, variables, context) => {
      console.log(err, variables, context);
    },
    onSettled: () => console.log('complete'),
  });

  useEffect(() => {
    if (isAuthenticated && user) {
      console.log(user.sub);
      createOrGetUserCall.mutate();
    }
  }, [isAuthenticated, user]);

  if (!isAuthenticated) {
    return (
      <div className="text-center text-2xl text-dgsoftwhite">
        Please log in.
      </div>
    );
  }

  try {
    //pulling the player from the user
  } catch {
    //reroute to create a player if the player doesn't exist
  }

  return (
    <div>
      {/*<PlayerBlock />*/}
      {/*<Divider color="dgbackground" />*/}
      {/*<UpdateBlock toggleUpdateModal={toggleConfirmModal} />*/}
      {/*{showConfirmModal ? (*/}
      {/*  <UpdateConfirmModal toggleModal={toggleConfirmModal} />*/}
      {/*) : (*/}
      {/*  ''*/}
      {/*)}*/}
      {/*<LastTournamentBlock />*/}
    </div>
  );
}

export default Homepage;
