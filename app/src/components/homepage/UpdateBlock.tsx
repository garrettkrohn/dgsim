import React, { useEffect, useState } from 'react';
import UpdateRow from './UpdateRow';
import Button from '../../util/Button';
import { useAtom } from 'jotai';
import {
  updatePuttAtom,
  updateThrowAccuracyAtom,
  updateThrowPowerAtom,
  updateScrambleAtom,
  updateAvailableSpAtom,
  currentPuttAtom,
  currentThrowPowerAtom,
  currentThrowAccuracyAtom,
  currentScrambleAtom,
  loggedInUser,
  customColors,
} from '../../jotai/Atoms';
import WrapperBlock from '../../util/WrapperBlock';
import { useQuery } from '@tanstack/react-query';
import { getPlayerByAuth } from '../../services/PlayerApi';
import { useAuth0 } from '@auth0/auth0-react';
import Loading from '../../util/Loading';

const UpdateBlock = (props: { toggleUpdateModal: Function }) => {
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
  const [disableUpdate, setDisableUpdate] = useState(true);
  const [showUpdate, setShowUpdate] = useState(false);

  const [user, setUser] = useAtom(loggedInUser);
  const [backgroundColor, setBackroundColor] = useState('dgprimary');
  const [displayCustomColors, setDisplayCustomColors] = useAtom(customColors);

  const toggleUpdate = () => {
    setShowUpdate(!showUpdate);
  };

  const { user: auth0User } = useAuth0();

  const {
    isLoading: playerIsLoading,
    error: playerError,
    data: playerData,
    refetch,
  } = useQuery({
    queryKey: [`player`],
    //@ts-ignore
    queryFn: () => getPlayerByAuth({ Auth0: auth0User.sub }),
    enabled: false,
  });

  useEffect(() => {
    refetch();
    if (availableSp !== 0) {
      setShowUpdate(true);
    }
  }, []);

  useEffect(() => {
    if (
      putt + throwPower + throwAccuracy + scramble ===
      currentPutt + currentPower + currentAccuracy + currentScramble
    ) {
      setDisableUpdate(true);
    } else {
      setDisableUpdate(false);
    }
  }, [
    putt,
    throwPower,
    throwAccuracy,
    scramble,
    currentPutt,
    currentPower,
    currentAccuracy,
    currentScramble,
  ]);

  useEffect(() => {
    if (user && displayCustomColors) {
      setBackroundColor(user.foregroundColor);
    } else {
      setBackroundColor('dgprimary');
    }
  }, [user, displayCustomColors]);

  if (playerIsLoading) {
    return <Loading />;
  }

  if (playerData) {
    const {
      bankedSkillPoints,
      puttSkill,
      throwAccuracySkill,
      throwPowerSkill,
      scrambleSkill,
    } = playerData;
    return (
      <div>
        <WrapperBlock color={backgroundColor} onClick={toggleUpdate}>
          <div className="flex justify-center p-2 font-bold">Update Player</div>
          <div className="flex flex-row justify-evenly p-1">
            <div>Bank: {bankedSkillPoints}</div>
            <div>Total: {availableSp}</div>
          </div>
        </WrapperBlock>
        {showUpdate ? (
          <>
            <WrapperBlock color={backgroundColor}>
              <div className="flex justify-evenly">
                <div>Skill:</div>
                <div>Update:</div>
                <div>Cost:</div>
              </div>
              <UpdateRow
                skillName="Putt"
                skillNumber={putt}
                setSkillNumber={setPutt}
                currentNumber={puttSkill}
              />
              <UpdateRow
                skillName="ThrowPwr"
                skillNumber={throwPower}
                setSkillNumber={setThrowPower}
                currentNumber={throwPowerSkill}
              />
              <UpdateRow
                skillName="ThrowAcc"
                skillNumber={throwAccuracy}
                setSkillNumber={setThrowAccuracy}
                currentNumber={throwAccuracySkill}
              />
              <UpdateRow
                skillName="Scramble"
                skillNumber={scramble}
                setSkillNumber={setScramble}
                currentNumber={scrambleSkill}
              />
              <Button
                label="Submit Player Update"
                onClick={props.toggleUpdateModal}
                disable={disableUpdate}
              />
            </WrapperBlock>
          </>
        ) : (
          ''
        )}
      </div>
    );
  }

  return <div></div>;
};

export default UpdateBlock;
