import { QueryClient, useQuery } from '@tanstack/react-query';
import React, { useEffect, useState } from 'react';
import Loading from '../../util/Loading';
import { getPlayer, getPlayerByAuth } from '../../services/PlayerApi';
import WrapperBlock from '../../util/WrapperBlock';
import { useAuth0 } from '@auth0/auth0-react';
import { useAtom } from 'jotai/index';
import {
  currentPuttAtom,
  currentScrambleAtom,
  currentThrowAccuracyAtom,
  currentThrowPowerAtom,
  updateAvailableSpAtom,
  updatePuttAtom,
  updateScrambleAtom,
  updateThrowAccuracyAtom,
  updateThrowPowerAtom,
} from '../../jotai/Atoms';

const PlayerBlock = () => {
  const { user } = useAuth0();
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

  const {
    isLoading: playerIsLoading,
    error: playerError,
    data: playerData,
    refetch,
  } = useQuery({
    queryKey: [`player`],
    //@ts-ignore
    queryFn: () => getPlayerByAuth({ Auth0: user.sub }),
    enabled: false,
  });

  useEffect(() => {
    refetch();
  }, []);

  if (playerIsLoading)
    return (
      <div>
        <Loading />
      </div>
    );

  if (playerError) return <div>An error has occurred</div>;

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
      <WrapperBlock color="dgsecondary">
        <div className="flex justify-center">{firstName + ' ' + lastName}</div>
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
