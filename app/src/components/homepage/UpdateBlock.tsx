import React, { useEffect, useState } from 'react';
import Divider from '../../util/Divider';
import UpdateRow from './UpdateRow';
import Button from '../../util/Button';
import LastTournamentBlock from './LastTournamentBlock';
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
} from '../../jotai/Atoms';
import WrapperBlock from '../../util/WrapperBlock';
import { useQuery } from '@tanstack/react-query';
import { getPlayerByAuth } from '../../services/PlayerApi';
import { useAuth0 } from '@auth0/auth0-react';
import Loading from '../../util/Loading';

const UpdateBlock = (props: { toggleUpdateModal: Function }) => {
  const [putt, setPutt] = useState(-1);
  const [throwPower, setThrowPower] = useState(0);
  const [throwAccuracy, setThrowAccuracy] = useState(0);
  const [scramble, setScramble] = useState(0);
  const [currentPutt, setCurrentPutt] = useState(0);
  const [currentPower, setCurrentPower] = useState(0);
  const [currentAccuracy, setCurrentAccuracy] = useState(0);
  const [currentScramble, setCurrentScramble] = useState(0);
  const [availableSp, setAvailableSp] = useAtom(updateAvailableSpAtom);

  const [disableUpdate, setDisableUpdate] = useState(true);

  const [showUpdate, setShowUpdate] = useState(false);

  const toggleUpdate = () => {
    setShowUpdate(!showUpdate);
  };

  const { user } = useAuth0();

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

  if (playerIsLoading) {
    return <Loading />;
  }

  if (playerData && putt === -1) {
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

  return (
    <div>
      <WrapperBlock color="dgprimary" onClick={toggleUpdate}>
        <div className="container flex justify-center p-2 font-bold">
          Update Player
        </div>
        <div className="container flex flex-row justify-evenly p-1">
          <div>Bank: {playerData?.bankedSkillPoints}</div>
          <div>Total: {availableSp}</div>
        </div>
      </WrapperBlock>
      <Divider color="dgbackground" />
      {showUpdate ? (
        <>
          <WrapperBlock color="dgprimary">
            <div className="flex justify-evenly">
              <div>Skill:</div>
              <div>Update:</div>
              <div>Cost:</div>
            </div>
            <UpdateRow
              skillName="Putt"
              skillNumber={putt}
              setSkillNumber={setPutt}
              currentNumber={currentPutt}
            />
            <UpdateRow
              skillName="ThrowPwr"
              skillNumber={throwPower}
              setSkillNumber={setThrowPower}
              currentNumber={currentPower}
            />
            <UpdateRow
              skillName="ThrowAcc"
              skillNumber={throwAccuracy}
              setSkillNumber={setThrowAccuracy}
              currentNumber={currentAccuracy}
            />
            <UpdateRow
              skillName="Scramble"
              skillNumber={scramble}
              setSkillNumber={setScramble}
              currentNumber={currentScramble}
            />
            <Button
              label="Submit Player Update"
              onClick={props.toggleUpdateModal}
              disable={disableUpdate}
            />
          </WrapperBlock>
          <Divider color="dgbackground" />
        </>
      ) : (
        ''
      )}
    </div>
  );
};

export default UpdateBlock;
