import { useQuery } from '@tanstack/react-query';
import { useEffect } from 'react';
import Loading from '../../util/Loading';
import { getPlayer } from '../../services/PlayerApi';

const PlayerBlock = () => {
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
      <div className="container bg-dgsecondary p-2 text-dgsoftwhite">
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
      </div>
    );
  }

  return <div></div>;
};

export default PlayerBlock;
