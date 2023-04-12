import React, { useEffect, useState } from 'react';
import { useAtom } from 'jotai/index';
import { loggedInUser } from '../jotai/Atoms';
import { useMutation, useQuery } from '@tanstack/react-query';
import { getPlayerByAuth } from '../services/PlayerApi';
import Loading from './Loading';
import { useAuth0 } from '@auth0/auth0-react';
import { CreateOrGetUser } from '../services/UserApi';
import { data } from 'autoprefixer';
import Error from './Error';

const Avatar = () => {
  const [user, setUser] = useAtom(loggedInUser);
  const { user: auth0User } = useAuth0();
  const [backgroundColor, setBackgroundColor] = useState('');
  const [textColor, setTextColor] = useState('');

  useEffect(() => {
    console.log('atom user changed', user);
    if (user) {
      console.log(user.avatarBackgroundColor, user.avatarTextColor);
      setBackgroundColor(user.avatarBackgroundColor);
      setTextColor(user.avatarTextColor);
    }
  }, [user]);

  const {
    isLoading: playerIsLoading,
    error: playerError,
    data: playerData,
  } = useQuery({
    queryKey: [`player`],
    //@ts-ignore
    queryFn: () => {
      // @ts-ignore
      getPlayerByAuth({ Auth0: auth0User.sub });
    },
  });

  if (playerIsLoading) {
    return <Loading />;
  }

  if (playerError) {
    return <Error />;
  }

  if (playerData) {
    // @ts-ignore
    const initials = playerData.firstName[0] + playerData.lastName[0];
    return (
      <div>
        <div
          className="h-12 w-12 rounded-3xl text-center text-3xl"
          style={{
            backgroundColor: backgroundColor,
            color: textColor,
          }}
        >
          {initials}
        </div>
      </div>
    );
  }

  return <div>error</div>;
};

export default Avatar;
