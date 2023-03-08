import { useQuery } from '@tanstack/react-query';
import { useEffect, useState } from 'react';
import Loading from '../../util/Loading';
import { getPlayer } from '../../services/PlayerApi';
import WrapperBlock from '../../util/WrapperBlock';
import { useAuth0 } from '@auth0/auth0-react';

const PlayerBlock = () => {
  const { user, isAuthenticated, getAccessTokenSilently } = useAuth0();
  const [userMetadata, setUserMetadata] = useState(null);

  useEffect(() => {
    const getUserMetadata = async () => {
      const domain = 'dev-mychhcrwjquf7khu.us.auth0.com';

      try {
        const accessToken = await getAccessTokenSilently({
          authorizationParams: {
            audience: `https://${domain}/api/v2/`,
            scope: 'read:current_user',
          },
        });

        const userDetailsByIdUrl = `https://${domain}/api/v2/users/${user.sub}`;

        const metadataResponse = await fetch(userDetailsByIdUrl, {
          headers: {
            Authorization: `Bearer ${accessToken}`,
          },
        });

        const { user_metadata } = await metadataResponse.json();

        setUserMetadata(user_metadata);
      } catch (e) {
        console.log(e.message);
      }
    };

    getUserMetadata();
  }, [getAccessTokenSilently, user?.sub]);
  const {
    isLoading: playerIsLoading,
    error: playerError,
    data: playerData,
    refetch,
  } = useQuery({
    queryKey: [`player`],
    queryFn: () => getPlayer(1),
    enabled: false,
  });

  useEffect(() => {
    refetch();
  }, []);

  if (playerIsLoading) return <Loading />;

  if (playerError) return <div>An error has occurred</div>;

  if (playerData) {
    const {
      firstName,
      lastName,
      puttSkill,
      throwPowerSkill,
      throwAccuracySkill,
      scrambleSkill,
    } = playerData;
    return (
      <WrapperBlock color="dgsecondary">
        <div>
          {userMetadata ? (
            <pre>{JSON.stringify(userMetadata, null, 2)}</pre>
          ) : (
            'No user metadata defined'
          )}
        </div>
        <div className="container flex justify-center">
          {firstName + ' ' + lastName}
        </div>
        <div className="flex justify-evenly">
          <div className="flex flex-col">
            <div>Putt: {puttSkill}</div>
            <div>scramble: {throwPowerSkill}</div>
          </div>
          <div className="flex flex-col">
            <div>Throw Pwr: {throwAccuracySkill}</div>
            <div>Throw Acc: {scrambleSkill}</div>
          </div>
        </div>
        <div></div>
      </WrapperBlock>
    );
  }

  return <div></div>;
};

export default PlayerBlock;
