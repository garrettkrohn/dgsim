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
import { CreateOrGetUser } from '../../services/UserApi';
import { getPlayerByAuth } from '../../services/PlayerApi';
import Loading from '../../util/Loading';
import CreatePlayer from '../CreatePlayer/CreatePlayer';
import Button from '../../util/Button';
import { Link } from '@tanstack/react-router';
import Error from '../../util/Error';
import { loggedInUser } from '../../jotai/Atoms';
import { useAtom } from 'jotai/index';

function Homepage() {
  const [showConfirmModal, setShowConfirmModal] = useState(false);
  const [user, setUser] = useAtom(loggedInUser);
  const { isAuthenticated, user: Auth0User } = useAuth0();

  const toggleConfirmModal = () => {
    setShowConfirmModal(!showConfirmModal);
  };

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
    queryFn: () => getPlayerByAuth({ Auth0: Auth0User.sub }),
    enabled: false,
  });

  useEffect(() => {
    refetchStandings();
    refetchTournaments();
  }, [refetchStandings, refetchTournaments]);

  useEffect(() => {
    if (Auth0User) {
      refetchPlayer();
    }
  }, [refetchPlayer, Auth0User]);

  // @ts-ignore
  const { mutate, data: userData } = useMutation({
    mutationFn: () =>
      CreateOrGetUser({
        // @ts-ignore
        Auth0: Auth0User.sub,
      }),
    onMutate: () => console.log('mutate user'),
    onError: (err, variables, context) => {
      console.log(err, variables, context);
    },
    onSettled: () => {
      console.log('user Data Received');
    },
  });

  useEffect(() => {
    if (isAuthenticated && user) {
      mutate();
    }
  }, [isAuthenticated, user]);

  useEffect(() => {
    if (userData) {
      if (userData.userId !== user.userId) {
        setUser(userData);
      }
    }
  }, [userData]);

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
    return <Error />;
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
      {Auth0User?.sub === 'google-oauth2|115993548271312276661' ? (
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
