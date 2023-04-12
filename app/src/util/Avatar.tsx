import React, { useEffect } from 'react';
import { useAtom } from 'jotai/index';
import { loggedInUser } from '../jotai/Atoms';
import { useMutation, useQuery } from '@tanstack/react-query';
import { getPlayerByAuth } from '../services/PlayerApi';
import Loading from './Loading';
import { useAuth0 } from '@auth0/auth0-react';
import { CreateOrGetUser } from '../services/UserApi';
import { data } from 'autoprefixer';

const Avatar = () => {
  const [user, setUser] = useAtom(loggedInUser);
  const { user: auth0User } = useAuth0();

  const {
    isLoading: playerIsLoading,
    error: playerError,
    data: playerData,
    refetch,
  } = useQuery({
    queryKey: [`player`],
    //@ts-ignore
    queryFn: () => {
      // @ts-ignore
      getPlayerByAuth({ Auth0: auth0User.sub });
    },
    enabled: false,
  });

  const { mutate, data: userResource } = useMutation({
    // @ts-ignore
    mutationFn: () => CreateOrGetUser({ Auth0: auth0User.sub }),
    // @ts-ignore
    onSuccess: () => setUser(data),
  });

  useEffect(() => {
    console.log('avatar user changed');
    if (auth0User) {
      refetch();
    }
  }, [user, auth0User]);

  if (playerIsLoading) {
    return <Loading />;
  }

  if (playerError) {
    return <div></div>;
  }

  if (playerData) {
    // @ts-ignore
    const initials = playerData.firstName[0] + playerData.lastName[0];
    if (!user) {
      return <div></div>;
    }
    return (
      <div>
        <div
          className="h-12 w-12 rounded-3xl text-center text-3xl"
          style={{
            backgroundColor: user.avatarBackgroundColor,
            color: user.avatarTextColor,
          }}
        >
          {initials}
        </div>
      </div>
    );
  }

  return <div></div>;
};

export default Avatar;
