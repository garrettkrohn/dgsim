import { useQuery } from '@tanstack/react-query';
import React, { useEffect, useState } from 'react';
import Loading from '../../util/Loading';
import { getPlayerByAuth } from '../../services/PlayerApi';
import WrapperBlock from '../../util/WrapperBlock';
import { useAuth0 } from '@auth0/auth0-react';
import { useAtom } from 'jotai/index';
import {
  currentPuttAtom,
  currentScrambleAtom,
  currentThrowAccuracyAtom,
  currentThrowPowerAtom,
  customColors,
  loggedInUser,
  updateAvailableSpAtom,
  updatePuttAtom,
  updateScrambleAtom,
  updateThrowAccuracyAtom,
  updateThrowPowerAtom,
} from '../../jotai/Atoms';
import Error from '../../util/Error';
import Avatar from '../../util/Avatar';

const PlayerBlock = () => {
  const { user: Auth0User } = useAuth0();
  const [putt, setPutt] = useAtom(updatePuttAtom);
  const [throwPower, setThrowPower] = useAtom(updateThrowPowerAtom);
  const [throwAccuracy, setThrowAccuracy] = useAtom(updateThrowAccuracyAtom);
  const [scramble, setScramble] = useAtom(updateScrambleAtom);
  const [currentPutt, setCurrentPutt] = useAtom(currentPuttAtom);
  const [currentPower, setCurrentPower] = useAtom(currentThrowPowerAtom);
  const [currentAccuracy, setCurrentAccuracy] = useAtom(
    currentThrowAccuracyAtom,
  );
  const [currentScramble, setCurrentScramble] = useAtom(currentScrambleAtom);
  const [availableSp, setAvailableSp] = useAtom(updateAvailableSpAtom);

  const [user, setUser] = useAtom(loggedInUser);
  const [backgroundColor, setBackroundColor] = useState('dgsecondary');
  const [displayCustomColors, setDisplayCustomColors] = useAtom(customColors);

  const {
    isLoading: playerIsLoading,
    error: playerError,
    data: playerData,
    refetch,
  } = useQuery({
    queryKey: [`player`],
    //@ts-ignore
    queryFn: () => getPlayerByAuth({ Auth0: Auth0User.sub }),
    enabled: false,
  });

  useEffect(() => {
    refetch();

    if (user && displayCustomColors) {
      setBackroundColor(user.backgroundColor);
      console.log(backgroundColor);
    } else {
      setBackroundColor('dgsecondary');
    }
  }, [user, displayCustomColors]);

  if (playerIsLoading)
    return (
      <div>
        <Loading />
      </div>
    );

  if (playerError) return <Error />;

  if (playerData) {
    if (putt === -1) {
      setPutt(playerData.puttSkill);
      setCurrentPutt(playerData.puttSkill);
      setThrowAccuracy(playerData.throwAccuracySkill);
      setCurrentAccuracy(playerData.throwAccuracySkill);
      setThrowPower(playerData.throwPowerSkill);
      setCurrentPower(playerData.throwPowerSkill);
      setScramble(playerData.scrambleSkill);
      setCurrentScramble(playerData.scrambleSkill);
      setAvailableSp(playerData.bankedSkillPoints);
    }

    const {
      firstName,
      lastName,
      puttSkill,
      throwPowerSkill,
      throwAccuracySkill,
      scrambleSkill,
    } = playerData;

    return (
      <WrapperBlock color={backgroundColor}>
        <div className="flex justify-center">
          <Avatar />
          <div className="flex justify-center px-4">
            {firstName + ' ' + lastName}
          </div>
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
      </WrapperBlock>
    );
  }

  return <div></div>;
};

export default PlayerBlock;
