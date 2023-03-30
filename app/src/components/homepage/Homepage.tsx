import PlayerBlock from './PlayerBlock';
import Divider from '../../util/Divider';
import UpdateBlock from './UpdateBlock';
import React, { useEffect, useState } from 'react';
import UpdateConfirmModal from './UpdateConfirmModal';
import LastTournamentBlock from './LastTournamentBlock';
import { useMutation, useQuery } from '@tanstack/react-query';
import { getAllTournaments } from '../../services/tournamentsApi';
import { getSeasonLeaderboards } from '../../services/standingsApi';
import { useAuth0 } from '@auth0/auth0-react';
import { createOrGetUser } from '../../services/UserApi';
import { getPlayerByAuth } from '../../services/PlayerApi';
import Loading from '../../util/Loading';
import CreatePlayer from '../CreatePlayer/CreatePlayer';
import Button from '../../util/Button';
import { Link } from '@tanstack/react-router';

function Homepage() {
  const [showConfirmModal, setShowConfirmModal] = useState(false);

  const { isAuthenticated, user } = useAuth0();

  const toggleConfirmModal = () => {
    setShowConfirmModal(!showConfirmModal);
  };

  //calls the tournaments call when the homepage is loaded!
  const { refetch: refetchTournaments } = useQuery({
    queryKey: [`seasons/tournament/title`],
    queryFn: () => getAllTournaments(),
    enabled: false,
  });

  const { refetch: refetchStandings } = useQuery({
    queryKey: [`standings/season`],
    queryFn: () => getSeasonLeaderboards(),
    enabled: false,
  });

  const {
    isLoading: playerIsLoading,
    error: playerError,
    data: playerData,
    refetch: refetchPlayer,
  } = useQuery({
    queryKey: [`player`],
    //@ts-ignore
    queryFn: () => getPlayerByAuth({ Auth0: user.sub }),
    enabled: false,
  });

  useEffect(() => {
    refetchStandings();
    refetchTournaments();
  }, [refetchStandings, refetchTournaments]);

  useEffect(() => {
    if (user) {
      refetchPlayer();
    }
  }, [refetchPlayer, user]);

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

  if (playerIsLoading) {
    return <Loading />;
  }

  if (playerError) {
    return <div>Ope, there was an error</div>;
  }

  if (!playerData) {
    return (
      <div className="text-center text-dgsoftwhite">
        No active player found, please create one.
        <CreatePlayer />
      </div>
    );
  }

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
      {user?.sub === 'google-oauth2|115993548271312276661' ? (
        <div>
          <Link
            to={'/admin'}
            search={{}}
            params={{}}
            onError={() => console.log('error')}
          >
            <Button
              disable={false}
              onClick={() => console.log('clicked')}
              label="Admin Page"
            />
          </Link>
        </div>
      ) : (
        ''
      )}
    </div>
  );
}

export default Homepage;
